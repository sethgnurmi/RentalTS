<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alterations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('order_model', 'order_model');
		$this->load->model('stock_model', 'stock_model');
		$this->load->model('alterations_model', 'alterations_model');

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

	//////////////////////
	/*  View Functions  */
	//////////////////////

	public function index()
	{
		$stockItemList = $this->alterations_model->getAlterationsRequestsList();
		$this->data['AlterationsRequestsList'] = $stockItemList;

		$this->load->view('Alterations/request_overview', $this->data);
	}

	public function Request()
	{
		if($this->input->post())
		{
			$data = $this->input->post();
			
			$lineItem = $this->alterations_model->getLineItem($data['LineItemInput']);
			$stockItem = $this->alterations_model->getStockItem($data['StockItemInput']);
			
			$requestedMeasurements = $this->alterations_model->getMeasurements($lineItem['measurements']);
			unset($requestedMeasurements['measurement_id']);

			$measurement_id = $this->alterations_model->updateMeasurements($requestedMeasurements);

			$this->alterations_model->updateStockItem(array('stock_item_id' => $stockItem['stock_item_id'], 'measurement_id' => $measurement_id));

			$this->alterations_model->fulfillLineItem($lineItem['line_item_id'], $stockItem['stock_item_id']);
			
			redirect('/Alterations', 'refresh');
		}

		if($this->uri->segment(3) && is_numeric($this->uri->segment(3)))
		{
			$stock_item = $this->alterations_model->getStockItem($this->uri->segment(3));
			$this->data['StockItem'] = $this->getStockItemPresets($stock_item);
			$this->data['LineItem'] = $this->alterations_model->getLineItemFromStockItem($this->uri->segment(3));
			$this->data['StockItemProductName'] = $stock_item['product_name'];
			$this->data['StockItemProductType'] = $this->alterations_model->getProductType($stock_item['product_type'])['product_type'];
			$this->data['StatusList'] = $this->alterations_model->getStatusList();
			$this->data['ConditionList'] = $this->alterations_model->getConditionList();
			$this->data['MeasurementDefaults'] = $this->alterations_model->getMeasurementDefaultsFromProductType($stock_item['product_type']);
			$this->data['MeasurementList'] = $this->alterations_model->getMeasurementColumns();
			$this->load->view('Alterations/request_form', $this->data);
		}
	}
}
