<?php
class order_model extends CI_Model {

    /////////////////////
    /*  Get Functions  */
    /////////////////////

    public function getEvent($id)
    {
        $result = $this->db->where('event_id', $id)->get('order_events')->result_array();

        if(count($result) > 0)
        {
            return $result[0];
        }
        else
        {
            return false;
        }

    }

    public function getEventList()
    {
        return $this->db->get('order_events')->result_array();
    }

    public function getContact($id)
    {
        $result = $this->db->where('contact_id', $id)->get('contacts')->result_array();

        if(count($result) > 0)
        {
            return $result[0];
        }
        else
        {
            return false;
        }
    }

    public function getAddress($id)
    {
        $result = $this->db->where('address_id', $id)->get('addresses')->result_array();

        if(count($result) > 0)
        {
            return $result[0];
        }
        else
        {
            return false;
        }
    }

    public function getActorsList($event)
    {
        return $this->db->select('*')->from('actors')
            ->join('measurements', 'measurements.measurement_id = actors.measurements', 'inner')
            ->where('event_id', $event)->get()->result_array();
    }

    public function getActor($id)
    {
        $result = $this->db->select('*')->from('actors')
            ->join('measurements', 'measurements.measurement_id = actors.measurements', 'inner')
            ->where('actor_id', $id)->get()->result_array();

        if(count($result) > 0)
        {
            return $result[0];
        }
        else
        {
            return false;
        }
    }

    public function getMeasurements($id)
    {
        $result = $this->db->where('measurement_id', $id)->get('measurements')->result_array();

        if(count($result) > 0)
        {
            return $result[0];
        }
        else
        {
            return false;
        }
    }

    public function getOrderList($event=false)
    {
        if(!$event)
        {
            return $this->db->select('*')->from('actors')
                ->join('order_events', 'order_events.event_id = actors.event_id', 'inner')
                ->get()->result_array();
        }
        else
        {
            return $this->db->select('*')->from('actors')
                ->where('event_id', $event)
                ->join('order_events', 'order_events.event_id = actors.event_id', 'inner')
                ->get()->result_array();
        }
    }

    public function getProductTypeList()
    {
        return $this->db->get('product_types')->result_array();
    }

    public function getProductList()
    {
        return $this->db->select('*')->from('products')
            ->join('product_types', 'product_types.product_type_id = products.product_type')
            ->get()->result_array();
    }

    public function getProductsByType($type)
    {
        return $this->db->where('product_type', $type)->get('products')->result_array();
    }

    public function getLineItem($id)
    {
        return $this->db->select('*')->from('line_items')
            ->join('products', 'products.product_id = line_items.product', 'inner')
            ->join('product_types', 'product_types.product_type_id = products.product_type', 'inner')
            ->join('measurements', 'measurements.measurement_id = line_items.measurements', 'inner')
            ->where('line_item_id', $id)->get()->result_array()[0];

    }

    public function getLineItemsList($order)
    {
        return $this->db->select('*')->from('line_items')
            ->join('products', 'products.product_id = line_items.product', 'inner')
            ->join('product_types', 'product_types.product_type_id = products.product_type', 'inner')
            ->join('measurements', 'measurements.measurement_id = line_items.measurements', 'inner')
            ->where('order_id', $order)->get()->result_array();
    }

    public function getMeasurementColumns()
    {
        $measurementColumns = $this->db->field_data('measurements');
        $measurementList = array();
        foreach($measurementColumns as $key=>$val)
        {
            if(!$val->primary_key && !strcasecmp($val->name, 'alterations') == 0)
                $measurementList[$val->name] = ucwords($val->name);
        }
        return $measurementList;
    }

    public function getMeasurementDefaultsFromProductType($product_type_id)
    {
        $measurement_defaults_id = $this->db->where('product_type_id', $product_type_id)->get('product_types')->result_array()[0]['measurement_defaults_id'];

        return $this->db->where('measurement_defaults_id', $measurement_defaults_id)->get('measurement_defaults')->result_array()[0];
    }

    ////////////////////////
    /*  Update Functions  */
    ////////////////////////

    public function update_order($data)
    {
        $order_id = -1;

        if(isset($data['order_id']))
        {
            $order_id = $data['order_id'];
            unset($data['order_id']);
        }

        if($order_id > 0)
        {
            $this->db->where('order_id', $order_id);
            $this->db->update('orders', $data);
            return $order_id;
        }
        else
        {
            $this->db->insert('orders', $data);
            return $this->db->insert_id();
        }
    }

    public function update_contact($data)
    {
        $contact_id = -1;

        if(isset($data['contact_id']))
        {
            $contact_id = $data['contact_id'];
            unset($data['contact_id']);
        }

        if($contact_id > 0)
        {
            $this->db->where('contact_id', $contact_id);
            $this->db->update('contacts', $data);
            return $contact_id;
        }
        else
        {
            $this->db->insert('contacts', $data);
            return $this->db->insert_id();
        }
    }

    public function update_address($data)
    {
        $address_id = -1;

        if(isset($data['address_id']))
        {
            $address_id = $data['address_id'];
            unset($data['address_id']);
        }

        if($address_id > 0)
        {
            $this->db->where('address_id', $address_id);
            $this->db->update('addresses', $data);
            return $address_id;
        }
        else
        {
            $this->db->insert('addresses', $data);
            return $this->db->insert_id();
        }
    }

    public function update_event($data)
    {
        $event_id = -1;

        if(isset($data['event_id']))
        {
            $event_id = $data['event_id'];
            unset($data['event_id']);
        }

        if($event_id > 0)
        {
            $this->db->where('event_id', $event_id);
            $this->db->update('order_events', $data);
            return $event_id;
        }
        else
        {
            $this->db->insert('order_events', $data);
            return $this->db->insert_id();
        }
    }

    public function update_actor($data)
    {
        $actor_id = -1;

        if(isset($data['actor_id']))
        {
            $actor_id = $data['actor_id'];
            unset($data['actor_id']);
        }

        if($actor_id > 0)
        {
            $this->db->where('actor_id', $actor_id);
            $this->db->update('actors', $data);
            return $actor_id;
        }
        else
        {
            $this->db->insert('actors', $data);
            return $this->db->insert_id();
        }
    }

    public function update_measurements($data)
    {
        $measurements_id = -1;

        if(isset($data['measurements_id']))
        {
            $measurements_id = $data['measurements_id'];
            unset($data['measurements_id']);
        }

        if($measurements_id > 0)
        {
            $this->db->where('measurements_id', $measurements_id);
            $this->db->update('measurements', $data);
            return $measurements_id;
        }
        else
        {
            $this->db->insert('measurements', $data);
            return $this->db->insert_id();
        }
    }

    public function update_line_item($data)
    {
        $line_item_id = -1;

        if(isset($data['line_item_id']))
        {
            $line_item_id = $data['line_item_id'];
            unset($data['line_item_id']);
        }

        if($line_item_id > 0)
        {
            $this->db->where('line_item_id', $line_item_id);
            $this->db->update('line_items', $data);
            return $line_item_id;
        }
        else
        {
            $this->db->insert('line_items', $data);
            return $this->db->insert_id();
        }
    }

    ////////////////////////
    /*  Delete Functions  */
    ////////////////////////
    
    public function deleteActor($id)
    {
        $this->db->where('actor_id', $id)->delete('actors');
    }
    
    public function deleteLineItem($id)
    {
        $this->db->where('line_item_id', $id)->delete('line_items');
    }

}

?>