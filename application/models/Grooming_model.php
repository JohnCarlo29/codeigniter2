<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grooming_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->library('datatables');
	}

	public function get_services(){
		$this->datatables->select('id, type, description, price');
        $this->datatables->from('grooming_services');
        $this->datatables->add_column('action', '<button class="btn btn-sm btn-danger grooming-service-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info grooming-service-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');

        return $this->datatables->generate();
	}

	public function add_groom_type($data){
		return $this->db->insert('grooming_services', $data);
	}

	public function delete_groom_type($id){
		$this->db->where('id',$id);
		return $this->db->delete('grooming_services');
	}

	public function get_groom_type_data($id){
		return $this->db->get_where('grooming_services', ['id'=>$id])->result();
	}

	public function update_groom_type($id, $data){
		$this->db->where('id', $id);
		return $this->db->update('grooming_services', $data);
	}

	public function get_groom_type(){
		$this->db->select('id, type');
		return $this->db->get('grooming_services')->result();
	}

	public function get_service_data($id){
		return $this->db->get_where('grooming_services',['id'=>$id])->result();
	}

	public function get_pet_owners(){
		$this->db->select('id,lastname,firstname,mi');
		$query = $this->db->get('clients');
		return $query->result();
	}

	public function get_last_invoice($invoice){
		$this->db->like('invoice_no',$invoice,'after');
		$this->db->select('RIGHT(MAX(invoice_no),1) as id');
		return $this->db->get('grooming_revenue')->result();
	}

	public function avail_grooming($data){
		$result = $this->db->insert_batch('grooming_revenue',$data);
		if($result > 0){
			return true;
		}else{
			return false;
		}
	}

	public function get_revenue(){
		$this->datatables->select('gr.date_availed,gr.invoice_no,CONCAT(c.lastname,",",c.firstname," ", c.mi) as owner,pets.name as pet, gs.type, gr.groomer, gs.price');
		$this->datatables->from('grooming_revenue as gr');
		$this->datatables->join('clients as c', 'gr.owner = c.id');
		$this->datatables->join('pets', 'gr.pet = pets.id');
		$this->datatables->join('grooming_services as gs', 'gr.grooming_id = gs.id');
		$data = (array)json_decode($this->datatables->generate());
        $total = (array)$this->get_total_revenue()[0];
        return array_merge($data, $total);
	}

	private function get_total_revenue(){
		$query = $this->db->query('SELECT SUM(grooming_services.price) as total FROM grooming_revenue, grooming_services WHERE grooming_revenue.grooming_id = grooming_services.id');
		return $query->result();
	}
}