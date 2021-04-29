<?php
class shipping_model extends CI_Model {

    /////////////////////
    /*  Get Functions  */
    /////////////////////

    public function getStockItem($id)
    {
        return $this->db->select('*')->from('stock_items')
            ->where('stock_item_id', $id)
            ->join('products', 'products.product_id = stock_items.product_id', 'inner')
            ->join('measurements', 'measurements.measurement_id = stock_items.measurement_id', 'inner')
            ->get()->result_array()[0];
    }

    public function getStockItemList()
    {
        return $this->db->select('*')->from('stock_items')
            ->join('products', 'products.product_id = stock_items.product_id', 'inner')
            ->join('measurements', 'measurements.measurement_id = stock_items.measurement_id', 'inner')
            ->get()->result_array();
    }

    public function getProduct($id)
    {
        return $this->db->where('product_id', $id)->get('products')->result_array()[0];
    }

    public function getProductType($id)
    {
        return $this->db->where('product_type_id', $id)->get('product_types')->result_array()[0];
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

    public function getStatusList()
    {
        return $this->db->get('statuses')->result_array();
    }

    public function getConditionList()
    {
        return $this->db->get('conditions')->result_array();
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

    public function getApplicableStockItems($product_id)
    {        
        $condition = array('stock_items.product_id' => $product_id, 'stock_items.status' => 1);
        
        return $this->db->select('*')->from('stock_items')
            ->where($condition)
            ->join('measurements', 'measurements.measurement_id = stock_items.measurement_id', 'inner')
            ->join('products', 'products.product_id = stock_items.product_id', 'inner')
            ->get()->result_array();
    }

    ////////////////////////
    /*  Update Functions  */
    ////////////////////////

    public function updateActor($data)
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

    public function updateProduct($data)
    {
        $product_id = -1;

        if(isset($data['product_id']))
        {
            $product_id = $data['product_id'];
            unset($data['product_id']);
        }

        if($product_id > 0)
        {
            $this->db->where('product_id', $product_id);
            $this->db->update('products', $data);
            return $product_id;
        }
        else
        {
            $this->db->insert('products', $data);
            return $this->db->insert_id();
        }
    }

    public function updateProductType($data)
    {
        $product_type_id = -1;

        if(isset($data['product_type_id']))
        {
            $product_type_id = $data['product_type_id'];
            unset($data['product_type_id']);
        }

        if($product_type_id > 0)
        {
            $this->db->where('product_type_id', $product_type_id);
            $this->db->update('product_types', $data);
            return $product_type_id;
        }
        else
        {
            $this->db->insert('product_types', $data);
            return $this->db->insert_id();
        }
    }

    public function updateMeasurements($data)
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

    public function updateStockItem($data)
    {
        $stock_item_id = -1;

        if(isset($data['stock_item_id']))
        {
            $stock_item_id = $data['stock_item_id'];
            unset($data['stock_item_id']);
        }

        if($stock_item_id > 0)
        {
            $this->db->where('stock_item_id', $stock_item_id);
            $this->db->update('stock_items', $data);
            return $stock_item_id;
        }
        else
        {
            $this->db->insert('stock_items', $data);
            return $this->db->insert_id();
        }
    }

    public function fulfillLineItem($line_item_id, $stock_item_id)
    {
        $data = array('stock_item' => $stock_item_id, 'fulfillment_status' => 1);
        $this->db->where('line_item_id', $line_item_id)->update('line_items', $data);

        $data = array('status' => 7);
        $this->db->where('stock_item_id', $stock_item_id)->update('stock_items', $data);
    }

    public function requestAlterations($line_item_id, $stock_item_id)
    {
        $data = array('stock_item' => $stock_item_id, 'fulfillment_status' => 2);
        $this->db->where('line_item_id', $line_item_id)->update('line_items', $data);

        $data = array('status' => 6);
        $this->db->where('stock_item_id', $stock_item_id)->update('stock_items', $data);
    }

    public function undoFulfillment($line_item_id)
    {
        $stock_item_id = $this->db->where('line_item_id', $line_item_id)->get('line_items')->result_array()[0]['stock_item'];

        $lineItemData = array('stock_item' => null, 'fulfillment_status' => null);
        $stockItemData = array('status' => 1);

        $this->db->where('line_item_id', $line_item_id)->update('line_items', $lineItemData);
        $this->db->where('stock_item_id', $stock_item_id)->update('stock_items',$stockItemData);
    }

    public function cancelAlterationsRequest($line_item_id)
    {
        $stock_item_id = $this->db->where('line_item_id', $line_item_id)->get('line_items')->result_array()[0]['stock_item'];

        $lineItemData = array('stock_item' => null, 'fulfillment_status' => null);
        $stockItemData = array('status' => 1);

        $this->db->where('line_item_id', $line_item_id)->update('line_items', $lineItemData);
        $this->db->where('stock_item_id', $stock_item_id)->update('stock_items',$stockItemData);
    }

    ////////////////////////
    /*  Delete Functions  */
    ////////////////////////
    
    public function deleteProduct($id)
    {
        $this->db->where('product_id', $id)->delete('products');
    }

}

?>