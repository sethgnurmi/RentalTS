<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fulfillment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('fulfillment_model', 'fulfillment_model');
		$this->load->model('order_model', 'order_model');

	}

	///////////////////////
	/*  Local Functions  */
	///////////////////////

	private function getStockItemPresets($data=false)
	{
		if(!$data)
		{
			$StockItem = array();
			$StockItem['StockItemId'] = "-1";
			$StockItem['StockItemProductType'] = "1";
			$StockItem['StockItemProductName'] = "1";
			$StockItem['StockItemStatus'] = "1";
			$StockItem['StockItemCondition'] = "1";
			$StockItem['StockItemQuantity'] = "1";

			$measurementList = $this->stock_model->getMeasurementColumns();
			foreach($measurementList as $key=>$val)
			{
				$StockItem['Measurement'.$val] = "";
			}

		}
		else
		{
			$StockItem = array();
			$StockItem['StockItemId'] = $data['stock_item_id'];
			$StockItem['StockItemProductType'] = $data['product_type'];
			$StockItem['StockItemProductName'] = $data['product_id'];
			$StockItem['StockItemStatus'] = $data['status'];
			$StockItem['StockItemCondition'] = $data['condition'];
			$StockItem['StockItemQuantity'] = "1";

			
			$measurementList = $this->stock_model->getMeasurementColumns();
			foreach($measurementList as $key=>$val)
			{
				$StockItem['Measurement'.$val] = $data[$key];
			}

		}

		return $StockItem;
	}

	//////////////////////
	/*  AJAX Functions  */
	//////////////////////

	public function getProductsByType()
	{
		if($this->input->post() && $this->input->post('product_type'))
		{
			$productList = $this->stock_model->getProductsByType($this->input->post('product_type'));
			$productList['MeasurementDefaults'] = $this->stock_model->getMeasurementDefaultsFromProductType($this->input->post('product_type'));
			echo json_encode($productList);
		}
	}

	//////////////////////
	/*  View Functions  */
	//////////////////////

	public function index()
	{
		$orderList = $this->order_model->getOrderList();

		foreach($orderList as $key => $order)
		{
			$orderList[$key]['Emptor'] = $this->order_model->getContact($order['emptor_contact']);
			$orderList[$key]['Contact'] = $this->order_model->getContact($order['contact_contact']);
			$orderList[$key]['LineItemList'] = $this->order_model->getLineItemsList($order['actor_id']);
			$itemListTotal = 0;
			foreach($orderList[$key]['LineItemList'] as $lineItemKey => $lineItem)
			{
				if($lineItem['purchase'] == 1)
					$orderList[$key]['LineItemList'][$lineItemKey]['LineItemTotal'] = $lineItem['purchase_price'];
				else
				$orderList[$key]['LineItemList'][$lineItemKey]['LineItemTotal'] = $lineItem['rental_price'];


			}
		}
		$this->data['OrderList'] = $orderList;

		$this->load->view('Fulfillment/orders_overview', $this->data);
	}

	
	public function Order()
	{
		if($this->uri->segment(3) && is_numeric($this->uri->segment(3)) && $this->order_model->getActor($this->uri->segment(3)))
		{
			$actor = $this->order_model->getActor($this->uri->segment(3));
			$event = $this->order_model->getEvent($actor['event_id']);
			$measurements = $this->order_model->getMeasurements($actor['measurements']);

			if($this->input->post())
			{

				$data = $this->input->post();
				if(isset($data['DeleteLineItemInput']))
				{
					//$this->order_model->deleteLineItem($data['DeleteLineItemInput']);
				}	
				else
				{
					$measurements = array();

					$measurementList = $this->order_model->getMeasurementColumns();
					foreach($measurementList as $key=>$val)
					{
						$measurements[$key] = $data['Measurement'.$val];
					}

					$measurements['alterations'] = $data['MeasurementAlterations'];
		
					$measurements_id = $this->order_model->update_measurements($measurements);

					$lineItem = array();
					$lineItem['product'] = $data['LineItemProduct'];
					$lineItem['measurements'] = $measurements_id;
					$lineItem['actor'] = $actor['actor_id'];
					$lineItem['order_id'] = $actor['actor_id'];
					$lineItem['event_id'] = $actor['event_id'];
					if(isset($data['LineItemPurchase']))
						$lineItem['purchase'] = 1;
					else
						$lineItem['purchase'] = 0;

					$line_item_id = $this->order_model->update_line_item($lineItem);
				}
				$this->data['POST'] = true;
			}
	
			$this->data['Actor'] = $actor;
			$this->data['Event'] = $event;
			$this->data['Measurements'] = $measurements;
			$this->data['ProductTypes'] = $this->order_model->getProductTypeList();
			$this->data['LineItemsList'] = $this->order_model->getLineItemsList($actor['actor_id']);
			$this->data['MeasurementList'] = $this->order_model->getMeasurementColumns();

		}


		$this->load->view('Fulfillment/order_form', $this->data);
	}
}
