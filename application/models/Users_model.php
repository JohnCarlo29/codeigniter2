<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

    public function login($uname, $pword){
        $this->db->where('username',$uname);
        $this->db->where('password',$pword);
        $result = $this->db->get('users');
        if($result->num_rows() === 0){
            return false; 
        }else{
            return true;
        }

    }
}