<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pets_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->library('datatables');
	}

	public function get_pet_owners(){
		$this->db->select('id,lastname,firstname,mi');
		$query = $this->db->get('clients');
		return $query->result();
	}

	public function get_pets(){
		$this->datatables->select('pets.id,pets.name, CONCAT(clients.lastname,",",clients.firstname," ", clients.mi) as owner,pets.breed,pets.sex,pets.birthday');
		$this->datatables->from('pets');
		$this->datatables->join('clients', 'pets.client_id = clients.id');
		$this->datatables->add_column('action', '<button class="btn btn-sm btn-danger pet-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info pet-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');
		return $this->datatables->generate();
	}

	public function add_pet($data){
		return $this->db->insert('pets', $data);
	}

	public function delete_pet($id){
		$this->db->where('id', $id);
		return $this->db->delete('pets');
	}

	public function get_pet_data($id){
		$this->db->where('id', $id);
		return $this->db->get('pets')->result();
	}

	public function update_pet($id,$data){
		$this->db->where('id', $id);
		return $this->db->update('pets',$data);
	}

	public function get_owner_pets($client_id){
		$this->db->where('client_id', $client_id);
		return $this->db->get('pets')->result();
	}

	public function admit($data){
		$this->db->where('id',$data['pet_id']);
		$this->db->where('date_release','0000-00-00');
		$query = $this->db->get('health_services');
		if($query->num_rows() > 0){
			return 'Pet already admitted and not yet release';
		}else{
			return $this->db->insert('health_services',$data);
		}
	}

	public function get_admitted(){
		$this->datatables->select('hs.id,pets.name, CONCAT(clients.lastname,",",clients.firstname," ", clients.mi), hs.complaint, hs.service, hs.date_admit');
		$this->datatables->from('health_services as hs');
		$this->datatables->join('clients', 'hs.client_id = clients.id');
		$this->datatables->join('pets', 'hs.pet_id = pets.id');
		$this->datatables->where('hs.date_release','0000-00-00');
		$this->datatables->add_column('action', '<button class="btn btn-sm btn-danger admission-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info admission-lab-update" data-id="$1" ><span class="fa fa-medkit"></span></button><button class="btn btn-sm btn-info admission-med-update" data-id="$1" ><span class="fa fa-stethoscope"></span></button>', 'id');
		return $this->datatables->generate();
	}

	public function get_pet_lab_data($id){
		$this->db->select('blood,
			distemper, parvo, ehrlichia, heartworm, ultrasound, urine, vaginal_smear, xrays, skin_scrapping, ear_swabbing, stool , other_test');
		return $this->db->get_where('health_services',['id'=>$id])->result();
	}

	public function update_lab_test($id, $data){
		$this->db->where('id',$id);
		return $this->db->update('health_services', $data);
	}

	public function update_medical_record($id, $data){
		$this->db->where('id', $id);
		return $this->db->update('health_services', $data);
	}

	public function get_last_release($id){
		$this->db->select('client_id, pet_id');
		$this->db->where('id',$id);
		return $this->db->get('health_services')->result();
	}

	public function new_schedule($data){
		return $this->db->insert('schedules',$data);
	}

	public function get_history(){
		$this->datatables->select('hs.id,CONCAT(clients.lastname,",",clients.firstname," ", clients.mi) as owner,pets.name as pet, hs.service, hs.complaint, hs.diagnosis,hs.recommendation,hs.medication,hs.prescribe,hs.date_admit,hs.date_release,hs.blood,hs.distemper,hs.parvo,hs.ehrlichia,hs.heartworm,hs.ultrasound,hs.urine,hs.vaginal_smear,hs.xrays,hs.skin_scrapping,hs.ear_swabbing,hs.stool,hs.other_test');
		$this->datatables->from('health_services as hs');
		$this->datatables->join('clients', 'hs.client_id = clients.id');
		$this->datatables->join('pets', 'hs.pet_id = pets.id');
		$this->datatables->add_column('action', '<button class="btn btn-sm btn-danger sched-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info sched-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');
		return $this->datatables->generate();
	}

	public function get_today_schedule(){
		$this->datatables->select('sched.id, CONCAT(clients.lastname,",",clients.firstname," ", clients.mi) as owner, pets.name as pet, sched.type,clients.contact, sched.schedule');
		$this->datatables->from('schedules as sched');
		$this->datatables->join('clients', 'sched.client_id = clients.id');
		$this->datatables->join('pets', 'sched.pet_id = pets.id');
		$this->datatables->where('sched.schedule',date('Y-m-d'));
		$this->datatables->add_column('action', '<button class="btn btn-sm btn-danger sched-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info sched-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');
		return $this->datatables->generate();
	}

	public function get_schedules(){
		$this->datatables->select('sched.id, CONCAT(clients.lastname,",",clients.firstname," ", clients.mi) as owner, pets.name as pet, sched.type,clients.contact, sched.schedule');
		$this->datatables->from('schedules as sched');
		$this->datatables->join('clients', 'sched.client_id = clients.id');
		$this->datatables->join('pets', 'sched.pet_id = pets.id');
		$this->datatables->where('sched.schedule >= ',date('Y-m-d'));
		$this->datatables->add_column('action', '<button class="btn btn-sm btn-danger sched-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info sched-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');
		return $this->datatables->generate();
	}

	public function get_revenue(){
		$this->datatables->select('hs.date_release,CONCAT(clients.lastname,",",clients.firstname," ", clients.mi),pets.name as pet, hs.service, hs.fee');
		$this->datatables->from('health_services as hs');
		$this->datatables->join('clients', 'hs.client_id = clients.id');
		$this->datatables->join('pets', 'hs.pet_id = pets.id');
		$this->datatables->where('hs.date_release !=','0000-00-00');
		$data = (array)json_decode($this->datatables->generate());
        $total = (array)$this->get_total_revenue()[0];
        return array_merge($data, $total);
	}

	private function get_total_revenue(){
		$this->db->select('SUM(fee) as total');
		return $this->db->get('health_services')->result();
	}
}