<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pets extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Pets_model');
	}

	// register pet modules

	public function index(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
			$this->load->view('layout/sidebar');
			$data = ['owners' => $this->get_pet_owners()];
			$this->load->view('pets',$data);
			$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}


	public function get_pets(){
		header('Content-type:application/json');
		echo $this->Pets_model->get_pets();
	}

	public function add_pet(){
		$rules=[
			array(
				'field' => 'pet',
				'label' => 'Pet Name',
				'rules'	=> 'trim|required'
			),
			array(
				'field' => 'owner',
				'label' => 'Owner',
				'rules'	=> 'trim|required'
			),
			array(
				'field' => 'breed',
				'label' => 'Breed',
				'rules'	=> 'trim'
			),
			array(
				'field' => 'sex',
				'label' => 'Sex',
				'rules'	=> 'trim'
			),
			array(
				'field' => 'birthday',
				'label' => 'Birthday',
				'rules'	=> 'trim'
			)
		];
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == false){
            echo strip_tags(validation_errors());
        }else{
        	$data = [
        		'name' => $this->security->xss_clean($this->input->post('pet')),
        		'client_id' => $this->security->xss_clean($this->input->post('owner')),
        		'breed' => $this->security->xss_clean($this->input->post('breed')),
        		'sex' => $this->security->xss_clean($this->input->post('gender')),
        		'birthday' => $this->security->xss_clean($this->input->post('bday'))
        	];
        	echo $this->Pets_model->add_pet($data);
        }
	}

	public function delete_pet(){
		$id = $this->input->get('id');
		echo $this->Pets_model->delete_pet($id);
	}

	public function get_pet_data(){
		$id = $this->input->post('id');
		header('Content-type:application/json');
		echo json_encode($this->Pets_model->get_pet_data($id));
	}

	public function update_pet(){
		$id = $this->input->post('id');
		$data = [
			'client_id' => $this->input->post('owner'),
			'name' =>  $this->input->post('pet'),
			'breed' =>  $this->input->post('breed'),
			'sex' =>  $this->input->post('gender'),
			'birthday' =>  $this->input->post('bday')
		];

		echo $this->Pets_model->update_pet($id, $data);
	}

	// admission pet module

	public function admission(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
			$this->load->view('layout/sidebar');
			$data = ['owners' => $this->get_pet_owners()];
			$this->load->view('admission',$data);
			$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function admit(){
		$rules=[
			array(
				'field'=>'owner',
				'label'=>'Owner',
				'rules'=>'trim|required'
			),
			array(
				'field'=>'pet',
				'label'=>'Pet',
				'rules'=>'trim|required'
			),
			array(
				'field'=>'complaint',
				'label'=>'Complaint',
				'rules'=>'trim|required'
			),
			array(
				'field'=>'service',
				'label'=>'Service',
				'rules'=>'trim|required'
			),
			array(
				'field'=>'dateAdmit',
				'label'=>'Date Admit',
				'rules'=>'trim|required'
			),
		];

		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() === FALSE){
			echo strip_tags(validation_errors());
		}else{
			$data = [
				'client_id' => $this->security->xss_clean($this->input->post('owner')),
				'pet_id' => $this->security->xss_clean($this->input->post('pet')),
				'service' => $this->security->xss_clean($this->input->post('service')),
				'complaint' => $this->security->xss_clean($this->input->post('complaint')),
				'date_admit' => $this->security->xss_clean($this->input->post('dateAdmit')),
			];

			echo $this->Pets_model->admit($data);
		}
	}

	public function get_admitted(){
		header('Content-type:application/json');
		echo $this->Pets_model->get_admitted();
	}

	public function get_pet_lab_data(){
		$id = $this->input->get('id');
		header('Content-type:application/json');
		echo json_encode($this->Pets_model->get_pet_lab_data($id));
	}

	public function update_lab_test(){
		$data = [];
		$id = $this->input->post('id');
		$blood = $this->input->post('blood');
		$distemper = $this->input->post('distemper');
		$parvo = $this->input->post('parvo');
		$ehrlichia = $this->input->post('ehrlichia');
		$heartworm = $this->input->post('heartworm');
		$ultrasound = $this->input->post('ultrasound');
		$other = $this->input->post('other');
		$vaginal = $this->input->post('vaginal');
		$xrays = $this->input->post('xrays');
		$scrapping = $this->input->post('scrapping');
		$swabbing = $this->input->post('swabbing');
		$urine = $this->input->post('urine');
		$stool = $this->input->post('stool');

		if($blood != "") {
		    $data['blood'] = $this->security->xss_clean($blood);
		}
		if($distemper != "") {
		    $data['distemper'] = $this->security->xss_clean($distemper);
		}
		if($parvo != "") {
		    $data['parvo'] = $this->security->xss_clean($parvo);
		}
		if($ehrlichia != "") {
		    $data['ehrlichia'] = $this->security->xss_clean($ehrlichia);
		}
		if($heartworm != "") {
		    $data['heartworm'] = $this->security->xss_clean($heartworm);
		}
		if($ultrasound != "") {
		    $data['ultrasound'] = $this->security->xss_clean($ultrasound);
		}
		if($urine != "") {
		    $data['urine'] = $this->security->xss_clean($urine);
		}
		if($vaginal != "") {
		    $data['vaginal_smear'] = $this->security->xss_clean($vaginal);
		}
		if($xrays != "") {
		    $data['xrays'] = $this->security->xss_clean($xrays);
		}
		if($scrapping != "") {
		    $data['skin_scrapping'] = $this->security->xss_clean($scrapping);
		}
		if($swabbing != "") {
		    $data['ear_swabbing'] = $this->security->xss_clean($swabbing);
		}
		if($stool != "") {
		    $data['stool'] = $this->security->xss_clean($stool);
		}
		if($other != "") {
		    $data['other_test'] = $this->security->xss_clean($other);
		}

		echo $this->Pets_model->update_lab_test($id, $data);
	}

	public function release_pet(){
		$id = $this->input->post('id');
		$data=[
			'diagnosis'=>$this->security->xss_clean($this->input->post('findings')),
			'recommendation'=>$this->security->xss_clean($this->input->post('recommendation')),
			'medication'=>$this->security->xss_clean($this->input->post('medication')),
			'prescribe'=>$this->security->xss_clean($this->input->post('prescription')),
			'date_release'=>$this->security->xss_clean($this->input->post('releasedate')),
			'fee'=>$this->security->xss_clean($this->input->post('fee'))
		];
		if($this->input->post('follow-up') == 'no'){
			echo $this->Pets_model->update_medical_record($id, $data);
		}else{
			$is_updated = $this->Pets_model->update_medical_record($id, $data);
			if($is_updated){
				$get_last_release = $this->Pets_model->get_last_release($id);
				$for = '';
				$schedFor = $this->input->post('schedfor');
				if($schedFor != ""){
					$i = 1;
					foreach ($schedFor as $for) {
						if($i == 1){
							$for .= ucwords($for);
						}else{
							$for .= ', '.ucwords($for);
						}
						$i++;
					}
				}

				if($this->input->post('specific') != ""){
					if($for != ""){
						$for .= ', '.ucwords($this->input->post('specific'));
					}else{
						$for .= ucwords($this->input->post('specific'));
					}
				}
				$data=[
					'client_id' => $get_last_release[0]->client_id,
					'pet_id' => $get_last_release[0]->pet_id,
					'type' => trim($for),
					'schedule' => $this->input->post('nextsched')
				];
				echo $this->Pets_model->new_schedule($data);
			}else{
				echo false;
			}
		}
		//var_dump($_POST);
	}

	// fetching owner and pet

	private function get_pet_owners(){
		$pet_owners = [];
		$pet_owners[0] = 'Choose Owner';

		$owners = $this->Pets_model->get_pet_owners();
		foreach ($owners as $owner) {
			$pet_owners[$owner->id] = $owner->lastname.', '.$owner->firstname.' '.$owner->mi;
		}

		return $pet_owners;
	}

	public function get_owner_pets(){
		$client_id = $this->input->post('id');
		$pets_names = [];

		$pets = $this->Pets_model->get_owner_pets($client_id);
		if(count($pets) > 0){
			$pets_names[0] = 'Choose Pet';
			foreach ($pets as $pet) {
				$pets_names[$pet->id] = $pet->name;
			}
		}else{
			$pets_names[0] = 'No pets';
		}

		echo json_encode($pets_names);
	}

	//history

	public function history(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
			$this->load->view('layout/sidebar');
			$this->load->view('history');
			$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}


	public function get_history(){
		header("Content-type:application/json");
		echo $this->Pets_model->get_history();
	}

	//schedules

	public function schedules(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
			$this->load->view('layout/sidebar');
			$this->load->view('schedules');
			$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function today_schedules(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
			$this->load->view('layout/sidebar');
			$this->load->view('today_schedule');
			$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function get_today_schedule(){
		header("Content-type:application/json");
		echo $this->Pets_model->get_today_schedule();
	}

	public function get_schedules(){
		header("Content-type:application/json");
		echo $this->Pets_model->get_schedules();
	}

	//revenue
	public function revenue(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
			$this->load->view('layout/sidebar');
			$this->load->view('revenue');
			$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function get_revenue(){
		header("Content-type:application/json");
		echo json_encode($this->Pets_model->get_revenue());
	}
}