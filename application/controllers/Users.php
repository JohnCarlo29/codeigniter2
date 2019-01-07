<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
	}

	public function login(){
		$this->load->view('layout/header');
		$this->load->view('login');
		$this->load->view('layout/footer');
	}


	public function login_user(){
		/*autoload first the form_validation in config[libraries]*/

		$this->form_validation->set_rules('uname','Username', 'required|trim');
		$this->form_validation->set_rules('pword','Password', 'required|trim');
		if ($this->form_validation->run() == FALSE){
			$data = ['login_validation' => validation_errors()];
			$this->session->set_flashdata($data);
			redirect('login');
		}else{
			$uname = $this->input->post('uname');
			$pword = $this->input->post('pword');
			$granted = $this->Users_model->login($uname, $pword);
			if($granted){
				$this->session->set_userdata('username', $uname);
				redirect('pets/today_schedules');
			}else{
				$data = ['login_validation' => 'Username or Password is Incorrect'];
				$this->session->set_flashdata($data);
				redirect('login');
			}
		}
	}

}
