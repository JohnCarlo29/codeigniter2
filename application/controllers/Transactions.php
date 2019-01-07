<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function index(){

        if($this->session->has_userdata('username')){
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('layout/footer');
        }else{
            redirect('login');
        }
    }
}