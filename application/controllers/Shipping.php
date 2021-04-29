<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('shipping_model', 'shipping_model');
		$this->load->model('order_model', 'order_model');

	}

	///////////////////////
	/*  Local Functions  */
	///////////////////////

	//////////////////////
	/*  AJAX Functions  */
	//////////////////////

	//////////////////////
	/*  View Functions  */
	//////////////////////

	public function index()
	{
		$orderList = $this->order_model->getOrderList();
		$finalOrderList = array();

		foreach($orderList as $key => $order)
		{
			$orderList[$key]['LineItemList'] = $this->order_model->getLineItemsList($order['actor_id']);
			$fulfilled = true;

			foreach($orderList[$key]['LineItemList'] as $lineItem)
			{
				if($lineItem['fulfillment_status'] != 1)
				{
					$fulfilled = false;
				}
			}

			if($fulfilled && !$order['order_status'] > 0)
			{
				$orderList[$key]['Emptor'] = $this->order_model->getContact($order['emptor_contact']);
				$orderList[$key]['Contact'] = $this->order_model->getContact($order['contact_contact']);
				$itemListTotal = 0;
				foreach($orderList[$key]['LineItemList'] as $lineItemKey => $lineItem)
				{
					if($lineItem['purchase'] == 1)
						$orderList[$key]['LineItemList'][$lineItemKey]['LineItemTotal'] = $lineItem['purchase_price'];
					else
					$orderList[$key]['LineItemList'][$lineItemKey]['LineItemTotal'] = $lineItem['rental_price'];
				}
				$finalOrderList[] = $orderList[$key];
			}
		}
		$this->data['OrderList'] = $finalOrderList;

		$this->load->view('Shipping/orders_overview', $this->data);
	}

	
	public function Order()
	{
		if($this->uri->segment(3) && is_numeric($this->uri->segment(3)) && $this->order_model->getActor($this->uri->segment(3)))
		{
			$actor = $this->order_model->getActor($this->uri->segment(3));
			$event = $this->order_model->getEvent($actor['event_id']);
			$measurements = $this->order_model->getMeasurements($actor['measurements']);
			

			if($this->input->post() && isset($this->input->post()['ConfirmOrderShipping']))
			{
				$lineItemList = $this->order_model->getLineItemsList($actor['actor_id']);
				foreach($lineItemList as $line_item)
				{
					$stockItemData = array('stock_item_id' => $line_item['stock_item'], 'status' => 4);
					$this->shipping_model->updateStockItem($stockItemData);
				}

				$actorData = array('actor_id' => $this->uri->segment(3), 'order_status' => 1);
				$this->shipping_model->updateActor($actorData);
				
				redirect('/Shipping', 'refresh');
			}
	
			$this->data['Actor'] = $actor;
			$this->data['Event'] = $event;
			$this->data['Measurements'] = $measurements;
			$this->data['ProductTypes'] = $this->order_model->getProductTypeList();
			$this->data['LineItemsList'] = $this->order_model->getLineItemsList($actor['actor_id']);
			$this->data['MeasurementList'] = $this->order_model->getMeasurementColumns();

		}


		$this->load->view('Shipping/order_form', $this->data);
	}
}
