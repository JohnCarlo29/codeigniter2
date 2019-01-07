<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Products_model');
    }

    public function index(){
        if($this->session->userdata('username') == 'admin'){
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $data = ['categories' => $this->get_all_categories()];
    		$this->load->view('product',$data);
    		$this->load->view('layout/footer');
        }else{
            redirect('login');
        }
    }

    public function category(){
        if($this->session->userdata('username') == 'admin'){
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('category');
            $this->load->view('layout/footer');
        }else{
            redirect('login');
        }
    }

    public function get_products(){ 
        header('Content-type:application/json');
        echo $this->Products_model->get_products();
    }

    public function get_all_categories(){
        $categories = $this->Products_model->get_all_categories();
        $data = [];
        $data['0'] = 'Choose Category';
        foreach($categories as $category){
            $data[$category->id] =  $category->category;
        }

        return $data;
    }

    public function insert_product(){
        $rules = [
            array(
                'field' => 'sku',
                'label' => 'SKU No.',
                'rules' => 'required'
            ),
            array(
                'field' => 'product_name',
                'label' => 'Product Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ),
            array(
                'field' => 'initial_price',
                'label' => 'Initial Price',
                'rules' => 'required'
            ),
            array(
                'field' => 'srp',
                'label' => 'SRP ',
                'rules' => 'required'
            )
        ];
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == false){
            echo strip_tags(validation_errors());
        }else{
            $data = [
                'sku' => $this->input->post('sku'),
                'name' => $this->input->post('product_name'),
                'category_id' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'initial_price' => $this->input->post('initial_price'),
                'price' => $this->input->post('srp')
            ];
            echo $this->Products_model->add_product($data);
        }
    }

    public function delete_product(){
        $id = $this->input->get('id');
        echo $this->Products_model->delete_product($id);
    }

    public function get_product_data(){
        $id = $this->input->post('id');
        $data = $this->Products_model->get_product_data($id);
        echo json_encode($data);
    }

    public function update_product(){
        $id = $this->input->post('id');
        $data = [
                'sku' => $this->input->post('sku'),
                'name' => $this->input->post('product_name'),
                'category_id' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'initial_price' => $this->input->post('initial_price'),
                'price' => $this->input->post('srp')
            ];
        echo $this->Products_model->update_product($id, $data);
    }


    public function get_categories(){
        header('Content-type:application/json');
        echo $this->Products_model->get_categories();
    }
    
    public function add_category(){
        $category = ucwords($this->input->post('category'));
        $data = ['category' => $this->security->xss_clean($category)];
        echo $this->Products_model->add_category($data);
    }

    public function delete_category(){
        $id = $this->input->get('id');
        echo $this->Products_model->delete_category($id);
    }

    public function get_category_data(){
        $id = $this->input->post('id');
        $data = $this->Products_model->get_category_data($id);
        header('Content-type:application/json');
        echo json_encode($data);
    }
}