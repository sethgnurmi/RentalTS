<?php
class product_model extends CI_Model {

    /////////////////////
    /*  Get Functions  */
    /////////////////////

    public function getProduct($id)
    {
        return $this->db->where('product_id', $id)->get('products')->result_array()[0];
    }

    public function getProductType($id)
    {
        return $this->db->select('*')->from('product_types')
            ->where('product_type_id', $id)
            ->join('measurement_defaults', 'measurement_defaults.measurement_defaults_id = product_types.measurement_defaults_id')
            ->get()->result_array()[0];
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

    public function getMeasurementDefaults($id)
    {
        return $this->db->where('measurement_defaults_id', $id)->get('measurement_defaults')->result_array()[0];
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

    ////////////////////////
    /*  Update Functions  */
    ////////////////////////

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

    public function updateMeasurementDefaults($data)
    {
        $measurement_defaults_id = -1;

        if(isset($data['measurement_defaults_id']))
        {
            $measurement_defaults_id = $data['measurement_defaults_id'];
            unset($data['measurement_defaults_id']);
        }

        if($measurement_defaults_id > 0)
        {
            $this->db->where('measurement_defaults_id', $measurement_defaults_id);
            $this->db->update('measurement_defaults', $data);
            return $measurement_defaults_id;
        }
        else
        {
            $this->db->insert('measurement_defaults', $data);
            return $this->db->insert_id();
        }

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