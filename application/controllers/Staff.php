<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->model('order_model', 'order_model');

	}

	///////////////////////
	/*  Local Functions  */
	///////////////////////

	private function getEventPresets($data = false)
	{
		if(!$data)
		{
			$Event = array();
			$Event['EventId'] = "-1";

			$Event['EmptorFirstName'] = "";
			$Event['EmptorLastName'] = "";
			$Event['EmptorEmailAddress'] = "";
			$Event['EmptorPhoneNumber'] = "";
			$Event['EmptorStreetAddressShipping'] = "";
			$Event['EmptorCityShipping'] = "";
			$Event['EmptorStateShipping'] = "-1";
			$Event['EmptorZIPCodeShipping'] = "";
			$Event['EmptorStreetAddressBilling'] = "";
			$Event['EmptorCityBilling'] = "";
			$Event['EmptorStateBilling'] = "-1";
			$Event['EmptorZIPCodeBilling'] = "";
	
			$Event['ContactFirstName'] = "";
			$Event['ContactLastName'] = "";
			$Event['ContactEmailAddress'] = "";
			$Event['ContactPhoneNumber'] = "";
			$Event['ContactStreetAddressShipping'] = "";
			$Event['ContactCityShipping'] = "";
			$Event['ContactStateShipping'] = "-1";
			$Event['ContactZIPCodeShipping'] = "";
			$Event['ContactStreetAddressBilling'] = "";
			$Event['ContactCityBilling'] = "";
			$Event['ContactStateBilling'] = "-1";
			$Event['ContactZIPCodeBilling'] = "";
	
			$Event['EventName'] = "";
			$Event['EventType'] = "";
			$Event['EventProductionDate'] = date('Y-m-d', time());
			$Event['EventFulfillmentDeadlineDate'] = date('Y-m-d', time());
			$Event['EventDescription'] = "";
		}
		else
		{
			$Event = array();
			$Event['EventId'] = $data['event_id'];

			$emptor_contact = $this->order_model->getContact($data['emptor_contact']);
			$Event['EmptorFirstName'] = $emptor_contact['first_name'];
			$Event['EmptorLastName'] = $emptor_contact['last_name'];
			$Event['EmptorEmailAddress'] = $emptor_contact['email_address'];
			$Event['EmptorPhoneNumber'] = $emptor_contact['phone_number'];

			$emptor_shipping_address = $this->order_model->getAddress($emptor_contact['shipping_address']);
			$Event['EmptorStreetAddressShipping'] = $emptor_shipping_address['address_street'];
			$Event['EmptorCityShipping'] = $emptor_shipping_address['city'];
			$Event['EmptorStateShipping'] = $emptor_shipping_address['state'];
			$Event['EmptorZIPCodeShipping'] = $emptor_shipping_address['zip_code'];
			
			$emptor_billing_address = $this->order_model->getAddress($emptor_contact['billing_address']);
			$Event['EmptorStreetAddressBilling'] = $emptor_billing_address['address_street'];
			$Event['EmptorCityBilling'] = $emptor_billing_address['city'];
			$Event['EmptorStateBilling'] = $emptor_billing_address['state'];
			$Event['EmptorZIPCodeBilling'] = $emptor_billing_address['zip_code'];
	
			$contact_contact = $this->order_model->getContact($data['contact_contact']);
			$Event['ContactFirstName'] = $contact_contact['first_name'];
			$Event['ContactLastName'] = $contact_contact['last_name'];
			$Event['ContactEmailAddress'] = $contact_contact['email_address'];
			$Event['ContactPhoneNumber'] = $contact_contact['phone_number'];

			$contact_shipping_address = $this->order_model->getAddress($contact_contact['shipping_address']);
			$Event['ContactStreetAddressShipping'] = $contact_shipping_address['address_street'];
			$Event['ContactCityShipping'] = $contact_shipping_address['city'];
			$Event['ContactStateShipping'] = $contact_shipping_address['state'];
			$Event['ContactZIPCodeShipping'] = $contact_shipping_address['zip_code'];

			$contact_billing_address = $this->order_model->getAddress($contact_contact['billing_address']);
			$Event['ContactStreetAddressBilling'] = $contact_billing_address['state'];
			$Event['ContactCityBilling'] = $contact_billing_address['city'];
			$Event['ContactStateBilling'] = $contact_billing_address['state'];
			$Event['ContactZIPCodeBilling'] = $contact_billing_address['zip_code'];
	
			$Event['EventName'] = $data['event_name'];
			$Event['EventType'] = $data['event_type'];
			$Event['EventProductionDate'] = $data['production_date'];
			$Event['EventFulfillmentDeadlineDate'] = $data['fulfillment_deadline'];
			$Event['EventDescription'] = $data['event_description'];
		}

		return $Event;
	}

	//////////////////////
	/*  AJAX Functions  */
	//////////////////////

	public function getProductsByType()
	{
		if($this->input->post() && $this->input->post('product_type'))
		{
			$productList = $this->order_model->getProductsByType($this->input->post('product_type'));
			$productList['MeasurementDefaults'] = $this->order_model->getMeasurementDefaultsFromProductType($this->input->post('product_type'));
			echo json_encode($productList);
		}
	}

	public function getLineItemDetails()
	{
		if($this->input->post() && $this->input->post('line_item_id'))
		{
			$lineItem = $this->order_model->getLineItem($this->input->post('line_item_id'));
			$lineItem['MeasurementDefaults'] = $this->order_model->getMeasurementDefaultsFromProductType($lineItem['product_type_id']);
			echo json_encode($lineItem);
		}

	}

	public function getActor()
	{
		if($this->input->post() && $this->input->post('actor_id'))
		{
			$actor = $this->order_model->getActor($this->input->post('actor_id'));
			echo json_encode($actor);
		}

	}

	//////////////////////
	/*  View Functions  */
	//////////////////////

	public function index()
	{
		$this->load->view('Staff/staff_dashboard');
	}
	
	public function Events()
	{
		$eventList = $this->order_model->getEventList();
		foreach($eventList as $key => $event)
		{
			$eventList[$key]['Emptor'] = $this->order_model->getContact($event['emptor_contact']);
			$eventList[$key]['Contact'] = $this->order_model->getContact($event['contact_contact']);
			$eventList[$key]['ActorsList'] = $this->order_model->getActorsList($event['event_id']);
			foreach($eventList[$key]['ActorsList'] as $actorKey => $actor)
			{
				$itemList = $this->order_model->getLineItemsList($actor['actor_id']);
				$itemListTotal = 0;

				foreach($itemList as $itemKey => $item)
				{
					if($item['purchase'] == 1)
						$itemListTotal += $item['purchase_price'];
					else
						$itemListTotal += $item['rental_price'];
				}

				$eventList[$key]['ActorsList'][$actorKey]['LineItemCount'] = count($itemList);
				$eventList[$key]['ActorsList'][$actorKey]['LineItemTotal'] = $itemListTotal;
			}
		}
		$this->data['EventList'] = $eventList;

		$this->load->view('Staff/events_overview', $this->data);
	}
	
	public function New()
	{
		$this->load->helper('url');

		if($this->input->post())
		{
			$data = $this->input->post();
			echo "<pre>";
			echo print_r($this->input->post());
			echo "</pre>";
			
			///////////////////
			/*  Emptor Data  */
			///////////////////

			$emptor_address = array();
			$emptor_address['address_name'] = $data['EmptorFirstName'].' '.$data['EmptorLastName'];
			$emptor_address['address_street'] = $data['EmptorStreetAddressShipping'];
			$emptor_address['city'] = $data['EmptorCityShipping'];
			$emptor_address['state'] = $data['EmptorStateShipping'];
			$emptor_address['zip_code'] = $data['EmptorZIPCodeShipping'];
			$emptor_address['address_type'] = 1;

			$emptor_address_id = $this->order_model->update_address($emptor_address);
			$emptor_billing_id = $emptor_address_id;
			
			if(!isset($data['EmptorBillingIsSame']))
			{
				$emptor_billing = array();
				$emptor_billing['address_name'] = $data['EmptorFirstName'].' '.$data['EmptorLastName'];
				$emptor_billing['address_street'] = $data['EmptorStreetAddressBilling'];
				$emptor_billing['city'] = $data['EmptorCityBilling'];
				$emptor_billing['state'] = $data['EmptorStateBilling'];
				$emptor_billing['zip_code'] = $data['EmptorZIPCodeBilling'];
				$emptor_billing['address_type'] = 2;

				$emptor_billing_id = $this->order_model->update_address($emptor_billing);
			}


			$emptor_contact = array();
			$emptor_contact['first_name'] = $data['EmptorFirstName'];
			$emptor_contact['last_name'] = $data['EmptorLastName'];
			$emptor_contact['email_address'] = $data['EmptorEmailAddress'];
			$emptor_contact['phone_number'] = $data['EmptorPhoneNumber'];
			$emptor_contact['shipping_address'] = $emptor_address_id;
			$emptor_contact['billing_address'] = $emptor_billing_id;
			$emptor_contact['contact_type'] = 1;

			$emptor_contact_id = $this->order_model->update_contact($emptor_contact);

			////////////////////
			/*  Contact Data  */
			////////////////////

			$contact_address = array();
			$contact_address['address_name'] = $data['ContactFirstName'].' '.$data['ContactLastName'];
			$contact_address['address_street'] = $data['ContactStreetAddressShipping'];
			$contact_address['city'] = $data['ContactCityShipping'];
			$contact_address['state'] = $data['ContactStateShipping'];
			$contact_address['zip_code'] = $data['ContactZIPCodeShipping'];
			$contact_address['address_type'] = 1;

			$contact_address_id = $this->order_model->update_address($contact_address);
			$contact_billing_id = $contact_address_id;
			
			if(!isset($data['ContactBillingIsSame']))
			{
				$contact_billing = array();
				$contact_billing['address_name'] = $data['ContactFirstName'].' '.$data['ContactLastName'];
				$contact_billing['address_street'] = $data['ContactStreetAddressBilling'];
				$contact_billing['city'] = $data['ContactCityBilling'];
				$contact_billing['state'] = $data['ContactStateBilling'];
				$contact_billing['zip_code'] = $data['ContactZIPCodeBilling'];
				$contact_billing['address_type'] = 2;

				$contact_billing_id = $this->order_model->update_address($contact_billing);
			}


			$contact_contact = array();
			$contact_contact['first_name'] = $data['ContactFirstName'];
			$contact_contact['last_name'] = $data['ContactLastName'];
			$contact_contact['email_address'] = $data['ContactEmailAddress'];
			$contact_contact['phone_number'] = $data['ContactPhoneNumber'];
			$contact_contact['shipping_address'] = $contact_address_id;
			$contact_contact['billing_address'] = $contact_billing_id;
			$contact_contact['contact_type'] = 1;

			$contact_contact_id = $this->order_model->update_contact($contact_contact);

			//////////////////
			/*  Event Data  */
			//////////////////

			$event = array();
			$event['event_id'] = $data['EventId'];
			$event['event_name'] = $data['EventName'];
			$event['event_type'] = $data['EventType'];
			$event['production_date'] = $data['EventProductionDate'];
			$event['fulfillment_deadline'] = $data['EventFulfillmentDeadlineDate'];
			$event['event_description'] = $data['EventDescription'];
			$event['emptor_contact'] = $emptor_contact_id;
			$event['contact_contact'] = $contact_contact_id;

			$event_id = $this->order_model->update_event($event);

			redirect('/Staff/Actors/'.$event_id, 'refresh');

		}
		$this->data['Event'] = $this->getEventPresets();


		$this->load->view('Staff/event_form', $this->data);
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
					$this->order_model->deleteLineItem($data['DeleteLineItemInput']);
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


		$this->load->view('Staff/order_form', $this->data);
	}

	public function Actors()
	{
		if($this->uri->segment(3) && is_numeric($this->uri->segment(3)) && $this->order_model->getEvent($this->uri->segment(3)))
		{
			$EVENT_ID = $this->uri->segment(3);

			if($this->input->post())
			{

				$data = $this->input->post();
				if(isset($data['DeleteActorInput']))
				{
					$this->order_model->deleteActor($data['DeleteActorInput']);
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
		
					$actor = array();
					$actor['actor_name'] = $data['ActorName'];
					$actor['actor_role'] = $data['ActorRole'];
					$actor['event_id'] = $EVENT_ID;
					$actor['measurements'] = $measurements_id;
	
					$actor_id = $this->order_model->update_actor($actor);
				}
				$this->data['POST'] = true;
			}

			$this->data['Event'] = $this->order_model->getEvent($EVENT_ID);
			$this->data['ActorsList'] = $this->order_model->getActorsList($EVENT_ID);
			$this->data['MeasurementList'] = $this->order_model->getMeasurementColumns();
		}


		$this->load->view('Staff/event_actor_form', $this->data);
	}

	public function Event()
	{
		if($this->uri->segment(3) && is_numeric($this->uri->segment(3)) && $this->order_model->getEvent($this->uri->segment(3)))
		{
			if($this->input->post())
			{

			}

			$Event = $this->order_model->getEvent($this->uri->segment(3));
			$this->data['EventDetails'] = $Event;
			$this->data['Event'] = $this->getEventPresets($Event);
		}

		$this->load->view('Staff/event_form', $this->data);
	}

	public function Orders()
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

		$this->load->view('Staff/orders_overview', $this->data);
	}

	public function Products()
	{
		$productList = $this->order_model->getProductList();
		$this->data['ProductList'] = $productList;

		$this->load->view('Staff/products_overview', $this->data);
		
	}
}
