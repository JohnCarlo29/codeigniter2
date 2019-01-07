<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->library('datatables');
	}

	public function get_clients(){
		$this->datatables->select('id,lastname,firstname,mi,address,contact');
        $this->datatables->from('clients');
        $this->db->order_by("id", "desc");
        $this->datatables->add_column('action', '<button class="btn btn-sm btn-danger client-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info client-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');

        return $this->datatables->generate();
	}

	public function register($data){
		return $this->db->insert('clients',$data);
	}

	public function delete_client($id){
        $this->db->where('id', $id);
        return $this->db->delete('clients');
    }

    public function get_client_data($id){
    	$this->db->where('id', $id);
        return $this->db->get('clients')->result();
    }

    public function update_client($id, $data){
    	$this->db->where('id',$id);
    	return $this->db->update('clients', $data);
    }
}