<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?=form_open('',['id'=>'availForm']); ?>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class='col-md-3'>
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
        	<div class='col-md-3'>
	            <label for="customer" class="col-md-3 col-form-label">Customer</label>
	            <div class="col-md-9">
	                <?php
                    	$attrib = ['class'=>"form-control",'id'=>"customer"];
                        echo form_dropdown('customer',$owners,'0',$attrib);
                    ?>
	            </div>
            </div>
            <div class='col-md-3'>
	            <label for="pet" class="col-md-3 col-form-label">Pet</label>
	            <div class="col-md-9">
	                <?php
                    	$attrib = ['class'=>"form-control",'id'=>"pet"];
                        echo form_dropdown('pet',null,null,$attrib);
                    ?>
	            </div>
        	</div>
        	<div class='col-md-3'>
	            <label for="groomer" class="col-md-3 col-form-label">Groomer</label>
	            <div class="col-md-9">
	                <?php
	                    $data = [
	                            'name' => 'customer',
	                            'type' => 'text',
	                            'class' => 'form-control',
	                            'id' => 'groomer'
	                    ];
	                    echo form_input($data);
	                ?>
	            </div>
            </div>
	    </div>
	</div>
</div>

<div class="row">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
		        	<div class='col-md-4'>
			            <label for="pname" class="col-md-12 col-form-label">Grooming Type</label>
			            <div class="col-md-12">
			                <?php
		                    	$attrib = ['class'=>"form-control",'id'=>"grooming"];
		                        echo form_dropdown('grooming',$groom_type,'0',$attrib);
		                    ?>
			            </div>
		            </div>
		            <div class='col-md-4'>
			            <label for="desc" class="col-md-12 col-form-label">Description</label>
			            <div class="col-md-12">
			                <?php
			                    $data = [
			                            'name' => 'desc',
			                            'type' => 'text',
			                            'class' => 'form-control',
			                            'id' => 'desc'
			                    ];
			                    echo form_input($data);
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
			                            'id' => 'price',
			                            'readonly'=>true
			                    ];
			                    echo form_input($data);
			                ?>
			            </div>
		            </div>
		            <div class='col-md-2'>
		            	<div class="col-md-12" style="margin-top: 23px;">
		            		<button class="btn btn-warning" id="avail"><i class="fa fa-shopping-cart"></i> Avail</button>
		            	</div>
		            </div>
			    </div>
			    <div class='col-md-12' style="margin-top: 30px">
					<table class="table table-bordered" id='availTable'>
						<thead>
							<tr>
								<th>id</th>
								<th>Grooming Type</th>
								<th>Description</th>
								<th>Price</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>
					
						</tbody>
					</table>
			    </div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class='form-group row'>
		            <label for="fee" class="col-md-2 col-form-label">Fee</label>
		            <div class="col-md-10">
		                <?php
		                    $data = [
		                            'name' => 'fee',
		                            'type' => 'text',
		                            'class' => 'form-control',
		                            'id' => 'fee',
		                            'readonly'=>true
		                    ];
		                    echo form_input($data);
		                ?>
		            </div>
	            </div>
	            <div class='form-group row'>
		            <label for="cash" class="col-md-2 col-form-label">Cash</label>
		            <div class="col-md-10">
		                <?php
		                    $data = [
		                            'name' => 'cash',
		                            'type' => 'text',
		                            'class' => 'form-control',
		                            'id' => 'cash',
		                    ];
		                    echo form_input($data);
		                ?>
		            </div>
	            </div>
	            <div class='form-group row'>
		            <label for="change" class="col-md-2 col-form-label">Change</label>
		            <div class="col-md-10">
		                <?php
		                    $data = [
		                            'name' => 'change',
		                            'type' => 'text',
		                            'class' => 'form-control',
		                            'id' => 'change',
		                            'readonly'=>true
		                    ];
		                    echo form_input($data);
		                ?>
		            </div>
	            </div>
	          	<button class="btn btn-primary col-md-12" id="availService">Proceed</button>
			</div>
		</div>
	</div>
</div>