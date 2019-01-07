<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->library('datatables');
    }
    

    public function get_products() {
        $this->datatables->select('products.id, products.sku, products.name, categories.category, products.description, products.initial_price, products.price');
        $this->datatables->from('products');
        $this->datatables->join('categories','products.category_id = categories.id');
        $this->datatables->add_column('action', '<button class="btn btn-sm btn-danger product-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info product-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');

        return $this->datatables->generate();
    }

    public function get_all_categories(){
        $query = $this->db->get('categories');
        return $query->result();
    }

   
    public function add_product($data){
        $this->db->where('sku', $data['sku']);
        $query = $this->db->get('products');
        if($query->num_rows() === 0){
            return $this->db->insert('products', $data);
        }else{
            return "SKU has been assigned in other product";
        }

    }

    public function delete_product($id){
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    public function update_product($id, $data){
        $this->db->where(array('id'=>$id, 'sku'=>$data['sku']));
        return $this->db->update('products', $data);
    }

    public function get_product_data($id){
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->result();
    }

    public function get_categories(){
         $this->datatables->select('id, category');
        $this->datatables->from('categories');
        $this->datatables->add_column('action', '<button class="btn btn-sm btn-danger category-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info category-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');

        return $this->datatables->generate();
    }

    public function add_category($data){
        $this->db->where($data);
        $query = $this->db->get('categories');
        if($query->num_rows() === 0){
            return $this->db->insert('categories', $data);
        }else{
            return "Category is already in data";
        }
    }


    public function delete_category($id){
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }

    public function get_category_data($id){
        $this->db->where('id', $id);
        $query = $this->db->get('categories');
        return $query->result();
    }
    
}