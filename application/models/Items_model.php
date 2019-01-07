<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->library('datatables');
	}

	public function order_items(){
		$this->datatables->select('orderitems.id, products.sku, products.name as product, products.description, categories.category, products.price, orderitems.quantity,suppliers.name as supplier, orderitems.total_order, orderitems.ordered_date');
        $this->datatables->from('orderitems ');
        $this->datatables->join('products','orderitems.product_id = products.id');
        $this->datatables->join('suppliers','orderitems.supplier_id = suppliers.id');
        $this->datatables->join('categories','products.category_id = categories.id');
        $this->datatables->where('orderitems.received', '0');
        $this->datatables->add_column('action', '<button class="btn btn-sm btn-danger order-delete" data-id="$1"><span class="fa fa-remove"></span></button><button class="btn btn-sm btn-info order-update" data-id="$1" ><span class="fa fa-edit"></span></button>', 'id');

        return $this->datatables->generate();
	}

	public function incoming_items(){
		$this->datatables->select('orderitems.id, products.sku, products.name as product, products.description, categories.category, products.price, orderitems.quantity,suppliers.name as supplier, orderitems.total_order, orderitems.ordered_date');
        $this->datatables->from('orderitems ');
        $this->datatables->join('products','orderitems.product_id = products.id');
        $this->datatables->join('suppliers','orderitems.supplier_id = suppliers.id');
        $this->datatables->join('categories','products.category_id = categories.id');
        $this->datatables->where('orderitems.received', '0');
        $this->datatables->add_column('action', '<button class="btn btn-sm btn-success receive" data-id="$1"><span class="fa fa-check"></span></button>', 'id');

        return $this->datatables->generate();
	}

	public function delivered_items(){
		$this->datatables->select('orderitems.id, products.sku, products.name as product, products.description, categories.category, products.price, orderitems.quantity,suppliers.name as supplier, orderitems.total_order, orderitems.ordered_date, orderitems.received_date');
        $this->datatables->from('orderitems ');
        $this->datatables->join('products','orderitems.product_id = products.id');
        $this->datatables->join('suppliers','orderitems.supplier_id = suppliers.id');
        $this->datatables->join('categories','products.category_id = categories.id');
        $this->datatables->where('orderitems.received', '1');
        return $this->datatables->generate();
	}

	public function stocks_items(){
		$this->datatables->select('stocks.id, products.sku, products.name, products.description, categories.category, stocks.quantity');
        $this->datatables->from('stocks ');
        $this->datatables->join('products','stocks.product_id = products.id');
        $this->datatables->join('categories','products.category_id = categories.id');
        $this->datatables->add_column('action', '<button class="btn btn-sm btn-primary adjust" data-id="$1"><span class="fa fa-sort-numeric-desc"></span></button>', 'id');

        return $this->datatables->generate();
	}

	public function get_sold_items(){
		$this->datatables->select('r.purchased_date, r.invoice_no, r.customer, p.sku, p.name, p.price, r.quantity, r.subtotal');
        $this->datatables->from('retail as r ');
        $this->datatables->join('products as p','r.product_id = p.id');
        $data = (array)json_decode($this->datatables->generate());
        $total = (array)$this->get_total_retail()[0];
        return array_merge($data, $total);
	}

	public function get_total_retail(){
		$this->db->select('SUM(subtotal) as total');
		return $this->db->get('retail')->result();
	}

	public function get_products(){
		$this->db->select('id,name');
		$query = $this->db->get('products');
		return $query->result();
	}

	public function get_suppliers(){
		$this->db->select('id,name');
		$query = $this->db->get('suppliers');
		return $query->result();
	}

	public function get_product_price($id){
		$this->db->where('id',$id);
		$this->db->select('sku,price');
		$query = $this->db->get('products');
		return $query->result();
	}

	public function insert_orderItems($data){
		return $this->db->insert('orderItems', $data);
	}

	public function delete_orderItems($id){
		$this->db->where('id', $id);
		return $this->db->delete('orderItems');
	}

	public function get_order_data($id){
		$this->db->where('id', $id);
		$query = $this->db->get('orderItems');
		return $query->result();
	}

	public function update_orderItems($id,$data){
		$this->db->where('id', $id);
		return $this->db->update('orderItems', $data);
	}

	public function receive_order($id){
		$data = [
			'received_date' => date("Y-m-d"),
			'received' => 1
		];
		$this->db->where('id', $id);
		$is_receive = $this->db->update('orderitems',$data);
		if($is_receive){
			$this->db->select('product_id,quantity');
			$this->db->where('id',$id);
			$addedStocks = $this->db->get('orderitems')->result();

			$query = $this->db->get_where('stocks',['product_id' => $addedStocks[0]->product_id]);
			if($query->num_rows() == 0){
				return $this->db->insert('stocks',$addedStocks[0]);
			}else{
				$this->db->where('product_id',$addedStocks[0]->product_id);
				$result = $this->db->query('UPDATE stocks set quantity = quantity+'.$addedStocks[0]->quantity.' where product_id = '.$addedStocks[0]->product_id);
				return $result;
			}
		}else{
			return false;
		}
	}

	public function get_stock_item($id){
		$this->db->select('stocks.id, products.sku, products.name, stocks.quantity');
		$this->db->from('stocks');
		$this->db->join('products','stocks.product_id = products.id','inner');
		$this->db->where('stocks.id', $id);
		$query = $this->db->get();

		return $query->result();
	}

	public function adjust_stocks($id, $data){
		$this->db->where('id', $id);
		return $this->db->update('stocks', $data);
	}

	public function get_last_invoice($date){
		$this->db->like('invoice_no',$date,'after');
		$this->db->select('RIGHT(MAX(invoice_no),1) as id');
		return $this->db->get('retail')->result();
	}

	public function check_stock($id){
		$this->db->select('quantity');
		return $this->db->get_where('stocks',['product_id' => $id])->result();
	}

	public function get_product_id($sku){
		$this->db->select('id');
		return $this->db->get_where('products', ['sku'=>$sku])->result();
	}

	public function avail_retail($data){
		$avail =  $this->db->insert_batch('retail', $data);
		if($avail > 0){
			return true;
		}else{
			return false;
		}
	}
}