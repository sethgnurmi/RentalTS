<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('stock_model', 'stock_model');

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
		$stockItemList = $this->stock_model->getStockItemList();
		$this->data['StockItemList'] = $stockItemList;

		$this->load->view('Stock/stock_overview', $this->data);
	}

	public function New()
	{
		if($this->input->post())
		{
			$data = $this->input->post();

			$measurements = array();

			$measurementList = $this->stock_model->getMeasurementColumns();
			foreach($measurementList as $key=>$val)
			{
				$measurements[$key] = $data['Measurement'.$val];
			}

			$measurements_id = $this->stock_model->updateMeasurements($measurements);

			$stock_item = array();

			$stock_item['stock_item_id'] = $data['StockItemId'];
			$stock_item['product_id'] = $data['StockItemProductName'];
			$stock_item['measurement_id'] = $measurements_id;
			$stock_item['status'] = (isset($data['StockItemStatus'])) ? $data['StockItemStatus'] : 1;
			$stock_item['condition'] = (isset($data['StockItemCondition'])) ? $data['StockItemCondition'] : 1;
		
			$quantity = (isset($data['StockItemQuantity']) && $data['StockItemQuantity'] > 0) ? $data['StockItemQuantity'] : 1;
			for($i = 0; $i < $quantity; $i++)
			{
				$stock_item_id = $this->stock_model->updateStockItem($stock_item);
			}

			redirect('/Stock');
		}
		else
		{
	
			$this->data['StockItem'] = $this->getStockItemPresets();
			$this->data['ProductTypeList'] = $this->stock_model->getProductTypeList();
			$this->data['StatusList'] = $this->stock_model->getStatusList();
			$this->data['ConditionList'] = $this->stock_model->getConditionList();
			$this->data['MeasurementList'] = $this->stock_model->getMeasurementColumns();
	
			$this->load->view('Stock/stock_item_form', $this->data);
		}
	}

	public function Item()
	{
		if($this->uri->segment(3) && is_numeric($this->uri->segment(3)))
		{
			$this->data['StockItem'] = $this->getStockItemPresets($this->stock_model->getStockItem($this->uri->segment(3)));
			$this->data['ProductTypeList'] = $this->stock_model->getProductTypeList();
			$this->data['StatusList'] = $this->stock_model->getStatusList();
			$this->data['ConditionList'] = $this->stock_model->getConditionList();
			$this->data['MeasurementList'] = $this->stock_model->getMeasurementColumns();
			$this->load->view('Stock/stock_item_form', $this->data);
		}
	}

	public function Product()
	{
		if($this->uri->segment(3) && is_numeric($this->uri->segment(3)))
		{
			$this->data['Product'] = $this->getProductPresets($this->product_model->getProduct($this->uri->segment(3)));
			$this->data['ProductTypeList'] = $this->product_model->getProductTypeList();
	
			$this->load->view('Product/product_form', $this->data);

		}
	}
}
