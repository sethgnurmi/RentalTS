<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('product_model', 'product_model');

	}

	///////////////////////
	/*  Local Functions  */
	///////////////////////

	private function getProductPresets($data=false)
	{
		if(!$data)
		{
			$Product = array();
			$Product['ProductId'] = "-1";
			$Product['ProductName'] = "";
			$Product['ProductType'] = "";
			$Product['ProductPurchasePrice'] = "";
			$Product['ProductRentalPrice'] = "";
		}
		else
		{
			$Product = array();
			$Product['ProductId'] = $data['product_id'];
			$Product['ProductName'] = $data['product_name'];
			$Product['ProductType'] = $data['product_type'];
			$Product['ProductPurchasePrice'] = $data['purchase_price'];
			$Product['ProductRentalPrice'] = $data['rental_price'];
		}

		return $Product;
	}
	
	private function getProductTypePresets($data=false)
	{
		if(!$data)
		{
			$Product = array();
			$Product['ProductTypeId'] = "-1";
			$Product['ProductTypeName'] = "";
			$Product['MeasurementDefaultsId'] = "-1";
			$Product['MeasurementHeight'] = "";
			$Product['MeasurementWaist'] = "";
			$Product['MeasurementChest'] = "";
			$Product['MeasurementLength'] = "";
			$Product['MeasurementInseam'] = "";
			$Product['MeasurementOutseam'] = "";
		}
		else
		{
			$Product = array();
			$Product['ProductTypeId'] = $data['product_type_id'];
			$Product['ProductTypeName'] = $data['product_type'];
			$Product['MeasurementDefaultsId'] = $data['measurement_defaults_id'];
			$Product['MeasurementHeight'] = $data['height'];
			$Product['MeasurementWaist'] = $data['waist'];
			$Product['MeasurementChest'] = $data['chest'];
			$Product['MeasurementLength'] = $data['length'];
			$Product['MeasurementInseam'] = $data['inseam'];
			$Product['MeasurementOutseam'] = $data['outseam'];
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
		$productList = $this->product_model->getProductList();
		$this->data['ProductList'] = $productList;

		$this->load->view('Product/products_overview', $this->data);
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

	public function Types()
	{
		$productTypeList = $this->product_model->getProductTypeList();
		
		foreach($productTypeList as $key=>$productType)
		{
			$productTypeList[$key]['ProductList'] = $this->product_model->getProductsByType($productType['product_type_id']);
		}

		$this->data['ProductTypeList'] = $productTypeList;

		$this->load->view('Product/product_types_overview', $this->data);
	}

	public function Type()
	{
		if($this->input->post())
		{
			$data = $this->input->post();

			$measurement_defaults = array();
			$measurement_defaults['measurement_defaults_id'] = $data['MeasurementDefaultsId'];
			$measurement_defaults['height'] = isset($data['MeasurementHeight']);
			$measurement_defaults['waist'] = isset($data['MeasurementWaist']);
			$measurement_defaults['chest'] = isset($data['MeasurementChest']);
			$measurement_defaults['length'] = isset($data['MeasurementLength']);
			$measurement_defaults['inseam'] = isset($data['MeasurementInseam']);
			$measurement_defaults['outseam'] = isset($data['MeasurementOutseam']);

			$measurement_defaults_id = $this->product_model->updateMeasurementDefaults($measurement_defaults);

			$product_type = array();
			$product_type['product_type_id'] = $data['ProductTypeId'];
			$product_type['product_type'] = $data['ProductTypeName'];
			$product_type['measurement_defaults_id'] = $measurement_defaults_id;

			$product_type_id = $this->product_model->updateProductType($product_type);

			redirect('/Products/Type/'.$product_type_id);
		}
		if($this->uri->segment(3) && is_numeric($this->uri->segment(3)))
		{
			$this->data['ProductType'] = $this->getProductTypePresets($this->product_model->getProductType($this->uri->segment(3)));
	
			$this->load->view('Product/product_type_form', $this->data);

		}
		else
		{
			$this->data['ProductType'] = $this->getProductTypePresets();
	
			$this->load->view('Product/product_type_form', $this->data);

		}
	}
}
