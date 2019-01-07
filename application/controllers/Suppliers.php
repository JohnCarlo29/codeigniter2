<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Suppliers_model');

    }

    public function index(){
    	$this->load->view('layout/header');
    	$this->load->view('layout/sidebar');
    	$this->load->view('supplier');
    	$this->load->view('layout/footer');
    }

    public function get_suppliers(){ 
        header('Content-type:application/json');
        echo $this->Suppliers_model->get_suppliers();
    }

    public function insert_supplier(){
    	$rules = array(
    		array(
    			'field' => 'name',
	    		'label' => 'Supplier Name',
	    		'rules' => 'required'
			),
			array(
    			'field' => 'st_address',
	    		'label' => 'Street Address',
	    		'rules' => 'required'
			),
			array(
    			'field' => 'barangay',
	    		'label' => 'Barangay',
	    		'rules' => 'required'
			),
			array(
    			'field' => 'city',
	    		'label' => 'City',
	    		'rules' => 'required'
			),
			array(
    			'field' => 'phone',
	    		'label' => 'Phone No.',
	    		'rules' => 'required'
			),
			array(
    			'field' => 'person',
	    		'label' => 'Contact Person',
	    		'rules' => 'required'
			)
     	);

     	$this->form_validation->set_rules($rules);
        if($this->form_validation->run() == false){
            echo strip_tags(validation_errors());
        }else{
            $data = [
                'name' => $this->input->post('name'),
                'address' => $this->input->post('st_address').", ".$this->input->post('barangay').", ".$this->input->post('city'),
                'phone' => $this->input->post('phone'),
                'contact_person' => $this->input->post('person')
            ];
            echo $this->Suppliers_model->add_supplier($data);
        }
    }

    public function delete_supplier(){
    	$id = $this->input->get('id');
    	return $this->Suppliers_model->delete_supplier($id);
    }


    public function get_supplier_data(){
    	$id = $this->input->post('id');
    	$data = $this->Suppliers_model->get_supplier_data($id);
    	echo json_encode($data);
    }

    public function update_supplier(){
    	$id = $this->input->post('id');
    	$data = [
    		'name' => $this->input->post('name'),
            'address' => $this->input->post('st_address').", ".$this->input->post('barangay').", ".$this->input->post('city'),
            'phone' => $this->input->post('phone'),
            'contact_person' => $this->input->post('person')
    	];

    	echo $this->Suppliers_model->update_supplier($id,$data);
    }

}