<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grooming extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Grooming_model');
	}

	public function grooming_list(){
		$this->load->view('layout/header');
    	$this->load->view('layout/sidebar');
    	$this->load->view('grooming_list');
    	$this->load->view('layout/footer');
	}

	public function avail(){
		$this->load->view('layout/header');
    	$this->load->view('layout/sidebar');
    	$data = ['groom_type'=>$this->get_groom_type(), 'owners'=>$this->get_pet_owners()];
    	$this->load->view('avail_grooming',$data);
    	$this->load->view('layout/footer');
	}

	public function revenue(){
		$this->load->view('layout/header');
    	$this->load->view('layout/sidebar');
    	$this->load->view('grooming_revenue');
    	$this->load->view('layout/footer');
	}

	public function get_services(){
		header('Content-type:application/json');
		echo $this->Grooming_model->get_services();
	}

	public function add_groom_type(){
		$rules = [
            array(
                'field' => 'groomType',
                'label' => 'Groom Type',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ),
            array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required|decimal'
            )
        ];

       	$this->form_validation->set_rules($rules);
       	if($this->form_validation->run() == false){
            echo strip_tags(validation_errors());
	    }else{
	    	$data = [
	    		'type' => $this->input->post('groomType'),
	    		'description' => $this->input->post('description'),
	    		'price' => $this->input->post('price'),
	    	];

	    	echo $this->Grooming_model->add_groom_type($data);
	    }
	}

	public function delete_groom_type(){
		$id = $this->input->get('id');
		echo $this->Grooming_model->delete_groom_type($id);
	}

	public function get_groom_type_data(){
		$id = $this->input->post('id');
		header('Content-type:application/json');
		echo json_encode($this->Grooming_model->get_groom_type_data($id));
	}

	public function update_groom_type(){
		$id = $this->input->post('id');
		$data = [
			'type' => $this->input->post('groomType'),
			'description' => $this->input->post('description'),
			'price' => $this->input->post('price'),
		];

		echo $this->Grooming_model->update_groom_type($id,$data);
	}

	private function get_groom_type(){
		$grooms = $this->Grooming_model->get_groom_type();
		$data = [];
		$data['0'] = 'Choose Groom Type';
		foreach($grooms as $groom){
			$data[$groom->id] =  $groom->type;
		}
		return $data;
	}

	public function get_service_data(){
		$id = $this->input->post('id');
		echo json_encode($this->Grooming_model->get_service_data($id));
	}

	private function get_pet_owners(){
		$pet_owners = [];
		$pet_owners[0] = 'Choose Owner';

		$owners = $this->Grooming_model->get_pet_owners();
		foreach ($owners as $owner) {
			$pet_owners[$owner->id] = $owner->lastname.', '.$owner->firstname.' '.$owner->mi;
		}

		return $pet_owners;
	}

	public function get_last_invoice(){
		$invoice = $this->input->post('invoice');
		$result = $this->Grooming_model->get_last_invoice($invoice);
		echo $result[0]->id;
	}

	public function avail_grooming(){
		$data = $this->input->post('service');
		echo $this->Grooming_model->avail_grooming($data);
	}

	public function get_revenue(){
		header("Content-type:application/json");
		echo json_encode($this->Grooming_model->get_revenue());
	}

}