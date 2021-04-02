<?php
class stock_model extends CI_Model {

    /////////////////////
    /*  Get Functions  */
    /////////////////////

    public function getStockItem($id)
    {
        return $this->db->select('*')->from('stock_items')
            ->where('stock_item_id', $id)
            ->join('products', 'products.product_id = stock_items.product_id', 'inner')
            ->join('measurements', 'measurements.measurement_id = stock_items.measurement_id', 'inner')
            ->get()->result_array();
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

    ////////////////////////
    /*  Delete Functions  */
    ////////////////////////
    
    public function deleteProduct($id)
    {
        $this->db->where('product_id', $id)->delete('products');
    }

}

?>