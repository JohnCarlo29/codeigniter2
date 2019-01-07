<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title pull-left">
             <h4>Ordered Items</h4>
         </div>
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#orderItemsModal">
            Order Items
        </button>
        <div class="clearfix"></div>       
    </div>
    <div class="panel-body">
        <table id="ordersTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Total</th>
                    <th>Ordered Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
                <tr>
                    <th>id</th>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Total</th>
                    <th>Ordered Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--Order Items Modal -->
<div class="modal fade" id="orderItemsModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Items</h4>
            </div>
            <?= form_open('items/insert_orderItems', array('id'=>'orderItemsForm')); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="sku" class="col-sm-3 col-form-label">SKU</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'sku',
                                        'type' => 'text',
                                        'class' => 'form-control sku',
                                        'readonly' => 'true'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sku" class="col-sm-3 col-form-label">Product</label>
                        <div class="col-sm-9">
                            <?php
                            	$attrib = ['class'=>"form-control product"];
                                echo form_dropdown('product',$products,'0',$attrib);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'price',
                                        'type' => 'text',
                                        'class' => 'form-control price',
                                        'readonly' => 'true'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Quantity</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'qty',
                                        'type' => 'number',
                                        'class' => 'form-control qty',
                                        'placeholder' =>'Enter Quanty'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'total',
                                        'type' => 'text',
                                        'class' => 'form-control total',
                                        'readonly' => 'true'
                                ];	
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Supplier</label>
                        <div class="col-sm-9">
                            <?php
                                $attrib = ['class' => 'form-control supplier'];
                                echo form_dropdown('supplier',$suppliers,'0',$attrib);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-9">
                        	<div class='input-group date'>
	                            <?php
	                                $data = [
	                                        'name' => 'orderDate',
	                                        'type' => 'date',
	                                        'class' => 'form-control orderDate',
	                                ];	
	                                echo form_input($data);
	                            ?>
	                            <span class="input-group-addon">
					            	<span class="glyphicon glyphicon-calendar"></span>
					         	</span>
                        	</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'order',
                                'type' => 'submit',
                                'id' => 'order',
                                'class' => 'btn btn-primary',
                                'value' =>'Order'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<!--Update Order Items Modal -->
<div class="modal fade" id="updateOrderItemsModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Items</h4>
            </div>
            <?= form_open('items/update_order_items', array('id'=>'updateOrderItemsForm')); ?>
                <div class="modal-body">
                    <?= form_hidden('id', ""); ?>
                    <div class="form-group row">
                        <label for="sku" class="col-sm-3 col-form-label">Supplier</label>
                        <div class="col-sm-9">
                            <?php
                                $attrib = ['class'=>"form-control product"];
                                echo form_dropdown('product',$products,'0',$attrib);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'price',
                                        'type' => 'text',
                                        'class' => 'form-control price',
                                        'readonly' => 'true'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Quantity</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'qty',
                                        'type' => 'number',
                                        'class' => 'form-control qty',
                                        'placeholder' =>'Enter Quanty'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'total',
                                        'type' => 'text',
                                        'class' => 'form-control total',
                                        'readonly' => 'true'
                                ];  
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Supplier</label>
                        <div class="col-sm-9">
                            <?php
                                $attrib = ['class' => 'form-control supplier'];
                                echo form_dropdown('supplier',$suppliers,'0',$attrib);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-9">
                            <div class='input-group date'>
                                <?php
                                    $data = [
                                            'name' => 'orderDate',
                                            'type' => 'date',
                                            'class' => 'form-control orderDate',
                                    ];  
                                    echo form_input($data);
                                ?>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'updateOrder',
                                'type' => 'submit',
                                'id' => 'updateOrder',
                                'class' => 'btn btn-info',
                                'value' =>'Update Order'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>