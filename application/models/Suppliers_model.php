<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->library('datatables');
    }
    

    public function get_suppliers() {
        $this->datatables->select('id, name,address,phone,contact_person');
        $this->datatables->from('suppliers');
        $this->datatables->add_column('action', '<button class="btn btn-sm btn-danger supplier-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info supplier-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');

        return $this->datatables->generate();
    }
    

    public function add_supplier($data){
    	$this->db->where('name', $data['name']);
        $query = $this->db->get('suppliers');
        if($query->num_rows() === 0){
            return $this->db->insert('suppliers', $data);
        }else{
            return "Supplier Name already have a data";
        }
    }

    public function delete_supplier($id){
    	$this->db->where('id', $id);
    	echo $this->db->delete('suppliers');
    }

    public function get_supplier_data($id){
 		$this->db->where('id', $id);
        $query = $this->db->get('suppliers');
        return $query->result();
    }

    public function update_supplier($id,$data){
    	$this->db->where('id',$id);
    	echo $this->db->update('suppliers',$data);
    }
}