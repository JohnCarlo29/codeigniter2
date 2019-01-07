<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title pull-left">
             <h4>Products</h4>
         </div>
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newProductModal">New Product</button>
        <div class="clearfix"></div>       
    </div>
    <div class="panel-body">
        <table id="productsTable" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Initial Price</th>
                    <th>SRP</th>
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
                    <th>Category</th>
                    <th>Description</th>
                    <th>Initial Price</th>
                    <th>SRP</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
<div>


<!--New Product Modal -->
<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Product</h4>
            </div>
            <?= form_open('products/insert_product', array('id'=>'newProductForm')); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="sku" class="col-sm-3 col-form-label">SKU No.</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'sku',
                                        'type' => 'text',
                                        'class' => 'form-control sku',
                                        'placeholder' =>'Enter SKU No.'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Product Name</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'product_name',
                                        'type' => 'text',
                                        'class' => 'form-control product_name',
                                        'placeholder' =>'Enter Product Name'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                            <?php
                                $attrib = ['class' => 'form-control category'];
                                echo form_dropdown('category',$categories,'0',$attrib);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'description',
                                        'type' => 'text',
                                        'class' => 'form-control description',
                                        'placeholder' =>'Enter Description'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Intial Price</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'initial_price',
                                        'type' => 'text',
                                        'class' => 'form-control intial_price',
                                        'placeholder' =>'Enter Intial Price'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">SRP</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'srp',
                                        'type' => 'text',
                                        'class' => 'form-control srp',
                                        'placeholder' =>'Enter SRP'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'add_product',
                                'type' => 'submit',
                                'id' => 'add_product',
                                'class' => 'btn btn-primary',
                                'value' =>'Add'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!--Update Product Modal -->
<div class="modal fade" id="updateProductModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Product</h4>
            </div>
            <?= form_open('products/update_product', array('id'=>'updateProductForm')); ?>
                <div class="modal-body">
                    <?= form_hidden('id', ""); ?>
                    <div class="form-group row">
                        <label for="sku" class="col-sm-3 col-form-label">SKU No.</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'sku',
                                        'type' => 'text',
                                        'class' => 'form-control sku',
                                        'placeholder' =>'Enter SKU No.'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Product Name</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'product_name',
                                        'type' => 'text',
                                        'class' => 'form-control product_name',
                                        'placeholder' =>'Enter Product Name'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                            <?php
                                $attrib = ['class' => 'form-control category'];
                                echo form_dropdown('category',$categories,'0',$attrib);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'description',
                                        'type' => 'text',
                                        'class' => 'form-control description',
                                        'placeholder' =>'Enter Description'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Intial Price</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'initial_price',
                                        'type' => 'text',
                                        'class' => 'form-control intial_price',
                                        'placeholder' =>'Enter Intial Price'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">SRP</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'srp',
                                        'type' => 'text',
                                        'class' => 'form-control srp',
                                        'placeholder' =>'Enter SRP'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'update_product',
                                'type' => 'submit',
                                'id' => 'update_product',
                                'class' => 'btn btn-info',
                                'value' =>'Update'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
