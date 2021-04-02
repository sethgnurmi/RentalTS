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

	private function getProductTypePresets($data=false)
	{
		if(!$data)
		{
			$Product = array();
			$Product['ProductTypeId'] = "-1";
			$Product['ProductTypeName'] = "";
		}
		else
		{
			$Product = array();
			$Product['ProductTypeId'] = $data['product_type_id'];
			$Product['ProductTypeName'] = $data['product_type'];
		}

		return $Product;
	}

	//////////////////////
	/*  AJAX Functions  */
	//////////////////////

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

			$product = array();

			$product['product_id'] = $data['ProductId'];
			$product['product_name'] = $data['ProductName'];
			$product['product_type'] = $data['ProductType'];
			$product['purchase_price'] = $data['ProductPurchasePrice'];
			$product['rental_price'] = $data['ProductRentalPrice'];

			$product_id = $this->product_model->updateProduct($product);

			redirect('/Products/Product/'.$product_id);
		}
		else
		{
	
			$this->data['Product'] = $this->getProductPresets();
			$this->data['ProductTypeList'] = $this->product_model->getProductTypeList();
	
			$this->load->view('Product/product_form', $this->data);
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
