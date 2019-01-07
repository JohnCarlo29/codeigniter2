<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Items_model');
	}

	public function order(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
	    	$this->load->view('layout/sidebar');
	    	$data = ['products' => $this->get_products(), 'suppliers' =>$this->get_suppliers()];
	    	$this->load->view('order',$data);
	    	$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function incoming(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
	    	$this->load->view('layout/sidebar');
	    	$this->load->view('incoming');
	    	$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function delivered(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
	    	$this->load->view('layout/sidebar');
	    	$this->load->view('delivered');
	    	$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function stocks(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
	    	$this->load->view('layout/sidebar');
	    	$this->load->view('stock');
	    	$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function retail(){
		if($this->session->userdata('username') == 'admin'){
			$data = ['products' => $this->get_products()];
			$this->load->view('layout/header');
	    	$this->load->view('layout/sidebar');
	    	$this->load->view('retail',$data);
	    	$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function sold_items(){
		if($this->session->userdata('username') == 'admin'){
			$this->load->view('layout/header');
	    	$this->load->view('layout/sidebar');
	    	$this->load->view('sold_items');
	    	$this->load->view('layout/footer');
		}else{
			redirect('login');
		}
	}

	public function order_items(){
		header('Content-type:application/json');
        echo $this->Items_model->order_items();
	}

	public function incoming_items(){
		header('Content-type:application/json');
        echo $this->Items_model->incoming_items();
	}

	public function delivered_items(){
		header('Content-type:application/json');
        echo $this->Items_model->delivered_items();
	}

	public function stocks_items(){
		header('Content-type:application/json');
        echo $this->Items_model->stocks_items();
	}

	public function critical_items(){
		header('Content-type:application/json');
        echo $this->Items_model->critical_items();
	}

	private function get_products(){
		$products = $this->Items_model->get_products();
		$data = [];
		$data['0'] = 'Choose Product';
		foreach($products as $product){
			$data[$product->id] =  $product->name;
		}

		return $data;
	}

	public function get_suppliers(){
		$suppliers = $this->Items_model->get_suppliers();
		$data = [];
		$data['0'] = 'Choose Supplier';
		foreach($suppliers as $supplier){
			$data[$supplier->id] =  $supplier->name;
		}

		return $data;
	}

	public function get_product_price(){
		$id = $this->input->post('id');
		$result = $this->Items_model->get_product_price($id);
		header('Content-type:application/json');
		echo json_encode($result);
	}

	public function insert_orderItems(){
		$data = [
			'product_id' => $this->input->post('product'),
			'supplier_id' => $this->input->post('supplier'),
			'quantity' => $this->input->post('qty'),
			'total_order' => $this->input->post('total'),
			'ordered_date' => $this->input->post('orderDate'),
		];
		echo $this->Items_model->insert_orderItems($data);
	}

	public function delete_orderItems(){
		$id = $this->input->get('id');
		echo $this->Items_model->delete_orderItems($id);
	}

	public function get_order_data(){
		$id = $this->input->post('id');
		$data = $this->Items_model->get_order_data($id);
		header('Content-type:application/json');
		echo json_encode($data);
	}

	public function update_orderItems(){
		$id = $this->input->post('id');
		$data = [
			'product_id' => $this->input->post('product'),
			'supplier_id' => $this->input->post('supplier'),
			'quantity' => $this->input->post('qty'),
			'total_order' => $this->input->post('total'),
			'ordered_date' => $this->input->post('orderDate'),
		];

		echo $this->Items_model->update_orderItems($id, $data);
	}

	public function receive_order(){
		$id = $this->input->post('id');
		echo $this->Items_model->receive_order($id);
	}

	public function get_stock_item(){
		$id = $this->input->post('id');
		$data = $this->Items_model->get_stock_item($id);
		header('Content-type:application/json');
		echo json_encode($data);
	}

	public function adjust_stocks(){
		$id = $this->input->post('id');
		$data = ['quantity' => $this->input->post('qty')];
		echo $this->Items_model->adjust_stocks($id, $data);
	}

	public function get_last_invoice(){
		$date = $this->input->post('date');
		$result = $this->Items_model->get_last_invoice($date);
		echo $result[0]->id;
	}

	public function check_stock(){
		$id = $this->input->post('id');
		$stock = $this->Items_model->check_stock($id);
		echo $stock[0]->quantity;
	}

	public function get_product_id(){
		$sku = $this->input->post('sku');
		$item =  $this->Items_model->get_product_id($sku);
		echo $item[0]->id;
	}

	public function avail_retail(){
		$data = $this->input->post('retails');
		echo $this->Items_model->avail_retail($data);
	}

	public function get_sold_items(){
		header('Content-type:application/json');
		echo json_encode($this->Items_model->get_sold_items());
	}
}