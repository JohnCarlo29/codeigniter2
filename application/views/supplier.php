<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title pull-left">
             <h4>Suppliers</h4>
         </div>
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newSupplierModal">New Supplier</button>
        <div class="clearfix"></div>       
    </div>
    <div class="panel-body">
        <table id="suppliersTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Supplier Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Contact Person</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            <tfoot>
                <tr>
                    <th>id</th>
                    <th>Supplier Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Contact Person</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--New Supplier Modal -->
<div class="modal fade" id="newSupplierModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Supplier</h4>
            </div>
            <?= form_open('suppliers/insert_supplier', array('id'=>'newSupplierForm')); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="sku" class="col-sm-3 col-form-label">Supplier</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'name',
                                        'type' => 'text',
                                        'class' => 'form-control name',
                                        'placeholder' =>'Enter Supplier Name'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Street Address</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'st_address',
                                        'type' => 'text',
                                        'class' => 'form-control st_address',
                                        'placeholder' =>'Enter Street Address'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Barangay</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'barangay',
                                        'type' => 'text',
                                        'class' => 'form-control barangay',
                                        'placeholder' =>'Enter Barangay'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">City</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'city',
                                        'type' => 'text',
                                        'class' => 'form-control city',
                                        'placeholder' =>'Enter City'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'phone',
                                        'type' => 'text',
                                        'class' => 'form-control phone',
                                        'placeholder' =>'Enter Phone'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Contact Person</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'person',
                                        'type' => 'text',
                                        'class' => 'form-control person',
                                        'placeholder' =>'Enter Contact Person'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'add_supplier',
                                'type' => 'submit',
                                'id' => 'add_supplier',
                                'class' => 'btn btn-primary',
                                'value' =>'Add Supplier'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!--Update Supplier Modal -->
<div class="modal fade" id="updateSupplierModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Supplier</h4>
            </div>
            <?= form_open('suppliers/update_supplier', array('id'=>'updateSupplierForm')); ?>
                <div class="modal-body">
                    <?= form_hidden('id', ""); ?>
                    <div class="form-group row">
                        <label for="sku" class="col-sm-3 col-form-label">Supplier</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'name',
                                        'type' => 'text',
                                        'class' => 'form-control name',
                                        'placeholder' =>'Enter Supplier Name'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Street Address</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'st_address',
                                        'type' => 'text',
                                        'class' => 'form-control st_address',
                                        'placeholder' =>'Enter Street Address'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Barangay</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'barangay',
                                        'type' => 'text',
                                        'class' => 'form-control barangay',
                                        'placeholder' =>'Enter Barangay'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">City</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'city',
                                        'type' => 'text',
                                        'class' => 'form-control city',
                                        'placeholder' =>'Enter City'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'phone',
                                        'type' => 'text',
                                        'class' => 'form-control phone',
                                        'placeholder' =>'Enter Phone'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Contact Person</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'person',
                                        'type' => 'text',
                                        'class' => 'form-control person',
                                        'placeholder' =>'Enter Contact Person'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'update_supplier',
                                'type' => 'submit',
                                'id' => 'update_supplier',
                                'class' => 'btn btn-info',
                                'value' =>'Update Supplier'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

