<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Clients_model');
		//$this->load->helper('htmlpurifier');
	}

	public function index(){
        if($this->session->userdata('username') == 'admin'){
    		$this->load->view('layout/header');
    		$this->load->view('layout/sidebar');
    		$this->load->view('clients');
    		$this->load->view('layout/footer');
        }else{
            redirect('login');
        }
	}

	public function get_clients(){
		header('Content-type:application/json');
		echo $this->Clients_model->get_clients();
	}

	public function register(){
		$rules = [
			array(
                'field' => 'lastname',
                'label' => 'Last Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'firstname',
                'label' => 'First Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'mi',
                'label' => 'Middle Initial',
                'rules' => 'max_length[1]'
            ),
            array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required'
            ),
		];

		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == false){
            echo strip_tags(validation_errors());
        }else{
            $data = [
                'lastname' => $this->security->xss_clean(ucwords($this->input->post('lastname'))),
                'firstname' => $this->security->xss_clean(ucwords($this->input->post('firstname'))),
                'mi' => $this->security->xss_clean(ucwords($this->input->post('mi'))),
                'address' => $this->security->xss_clean(ucwords($this->input->post('address'))),
                'contact' => $this->security->xss_clean(ucwords($this->input->post('contact')))
            ];

            echo $this->Clients_model->register($data);
        }
	}

    public function delete_client(){
        $id = $this->input->get('id');
        echo $this->Clients_model->delete_client($id);
    }

    public function get_client_data(){
        $id = $this->input->get('id');
        $data =  $this->Clients_model->get_client_data($id);
        header('Content-type:application/json');
        echo json_encode($data);
    }

    public function update_client(){
        $id = $this->input->post('id');
        $data = [
            'lastname' => $this->input->post('lastname'),
            'firstname' => $this->input->post('firstname'),
            'mi' => $this->input->post('mi'),
            'address' => $this->input->post('address'),
            'contact' => $this->input->post('contact'),
        ];

        echo $this->Clients_model->update_client($id,$data);
    }
}