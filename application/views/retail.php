<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?=form_open('',['id'=>'retailForm']); ?>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class='col-md-4'>
	            <label for="invoice" class="col-md-3 col-form-label">Invoice No.</label>
	            <div class="col-md-9">
	                <?php
	                    $data = [
	                            'name' => 'invoice',
	                            'type' => 'text',
	                            'class' => 'form-control',
	                            'id' => 'invoice'
	                    ];
	                    echo form_input($data);
	                ?>
	            </div>
        	</div>
        	<div class='col-md-4 col-md-offset-4'>
	            <label for="invoice" class="col-md-3 col-form-label">Customer</label>
	            <div class="col-md-9">
	                <?php
	                    $data = [
	                            'name' => 'customer',
	                            'type' => 'text',
	                            'class' => 'form-control',
	                            'id' => 'customer'
	                    ];
	                    echo form_input($data);
	                ?>
	            </div>
            </div>
	    </div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class='col-md-2'>
	            <label for="sku" class="col-md-12 col-form-label">SKU</label>
	            <div class="col-md-12">
	                <?php
	                    $data = [
	                            'name' => 'sku',
	                            'type' => 'text',
	                            'class' => 'form-control',
	                            'id' => 'sku'
	                    ];
	                    echo form_input($data);
	                ?>
	            </div>
        	</div>
        	<div class='col-md-3'>
	            <label for="pname" class="col-md-12 col-form-label">Product</label>
	            <div class="col-md-12">
	                <?php
                    	$attrib = ['class'=>"form-control",'id'=>"pname"];
                        echo form_dropdown('pname',$products,'0',$attrib);
                    ?>
	            </div>
            </div>
            <div class='col-md-2'>
	            <label for="price" class="col-md-12 col-form-label">Price</label>
	            <div class="col-md-12">
	                <?php
	                    $data = [
	                            'name' => 'price',
	                            'type' => 'text',
	                            'class' => 'form-control',
	                            'id' => 'price'
	                    ];
	                    echo form_input($data);
	                ?>
	            </div>
            </div>
            <div class='col-md-1'>
	            <label for="qty" class="col-md-12 col-form-label">Qty</label>
	            <div class="col-md-12">
	                <?php
	                    $data = [
	                            'name' => 'qty',
	                            'type' => 'number',
	                            'class' => 'form-control',
	                            'id' => 'qty'
	                    ];
	                    echo form_input($data);
	                ?>
	            </div>
            </div>
            <div class='col-md-2'>
	            <label for="stotal" class="col-md-12 col-form-label">Sub-Total</label>
	            <div class="col-md-12">
	                <?php
	                    $data = [
	                            'name' => 'stotal',
	                            'type' => 'text',
	                            'class' => 'form-control',
	                            'id' => 'stotal'
	                    ];
	                    echo form_input($data);
	                ?>
	            </div>
            </div>
            <div class='col-md-2'>
            	<div class="col-md-12" style="margin-top: 23px;">
            		<button class="btn btn-warning" id="add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
            	</div>
            </div>
	    </div>
	    <div class='col-md-12' style="margin-top: 30px">
			<table class="table table-bordered" id='retailTable'>
				<thead>
					<tr>
						<th>SKU</th>
						<th>Product</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Sub Total</th>
						<th>Remove</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
	    </div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<div class='col-md-4 col-md-offset-8'>
			<div class="form-group row">
                <label for="total" class="col-md-3 col-form-label">Total</label>
                <div class="col-md-9">
                    <?php
                        $data = [
                                'name' => 'total',
                                'type' => 'text',
                                'class' => 'form-control',
                                'id' => 'total',
                                'readonly' => 'true'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="cash" class="col-md-3 col-form-label">Cash</label>
                <div class="col-md-9">
                    <?php
                        $data = [
                                'name' => 'cash',
                                'type' => 'text',
                                'class' => 'form-control',
                                'id' => 'cash'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="change" class="col-md-3 col-form-label">Change</label>
                <div class="col-md-9">
                    <?php
                        $data = [
                                'name' => 'change',
                                'type' => 'text',
                                'class' => 'form-control',
                                'id' => 'change',
                                'readonly' => 'true'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            </div>
            <div class="col-md-12">
        		<button class="btn btn-primary pull-right" id="check-out">Check Out</button>
        	</div>
    	</div>
	</div>
</div>
<?= form_close(); ?>