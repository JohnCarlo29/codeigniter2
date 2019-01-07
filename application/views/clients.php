<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>New Client</h4>
		</div>
		<div class="panel-body">
			<?= form_open('clients/register',['id'=>"clientForm"]); ?>
				<div class="form-group col-md-5">
                    <label for="lname" class="col-md-12 col-form-label">Last Name</label>
                    <div class="col-md-12">
                        <?php
                            $data = [
                                    'name' => 'lname',
                                    'type' => 'text',
                                    'class' => 'form-control lname',
                                    'placeholder' =>'Last Name.'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label for="fname" class="col-md-12 col-form-label">First Name</label>
                    <div class="col-md-12">
                        <?php
                            $data = [
                                    'name' => 'fname',
                                    'type' => 'text',
                                    'class' => 'form-control fname',
                                    'placeholder' =>'First Name.'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="mi" class="col-md-12 col-form-label">Middle Initial</label>
                    <div class="col-md-12">
                        <?php
                            $data = [
                                    'name' => 'mi',
                                    'type' => 'text',
                                    'class' => 'form-control mi',
                                    'placeholder' =>'M.I.'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="address" class="col-md-12 col-form-label">Address</label>
                    <div class="col-md-12">
                        <?php
                            $data = [
                                    'name' => 'address',
                                    'type' => 'text',
                                    'class' => 'form-control address',
                                    'placeholder' =>'Address'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="contact" class="col-md-12 col-form-label">Contact No.</label>
                    <div class="col-md-12">
                        <?php
                            $data = [
                                    'name' => 'contact',
                                    'type' => 'text',
                                    'class' => 'form-control contact',
                                    'placeholder' =>'Contact'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="optionContact" class="col-md-12 col-form-label">Optional Contact No.</label>
                    <div class="col-md-12">
                        <?php
                            $data = [
                                    'name' => 'optionContact',
                                    'type' => 'text',
                                    'class' => 'form-control optionContact',
                                    'placeholder' =>'Optional Contact'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                	<button class="btn btn-primary pull-right">Add Client</button>
            	</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<div class="col-md-12">
	<table id="clientsTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                	<th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>M.I</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
                <tr>
                	<th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>M.I</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
</div>

<div class="modal fade" id="updateClientModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Client</h4>
            </div>
            <?= form_open('clients/update_client', array('id'=>'updateClientForm')); ?>
                <div class="modal-body">
                    <?= form_hidden('id', ""); ?>
                    <div class="form-group row">
                        <label for="lname" class="col-md-3 col-form-label">Last Name</label>
                        <div class="col-md-9">
                            <?php
                                $data = [
                                        'name' => 'lname',
                                        'type' => 'text',
                                        'class' => 'form-control lname',
                                        'placeholder' =>'Last Name.'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-md-3 col-form-label">First Name</label>
                        <div class="col-md-9">
                            <?php
                                $data = [
                                        'name' => 'fname',
                                        'type' => 'text',
                                        'class' => 'form-control fname',
                                        'placeholder' =>'First Name.'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mi" class="col-md-3 col-form-label">Middle Initial</label>
                        <div class="col-md-9">
                            <?php
                                $data = [
                                        'name' => 'mi',
                                        'type' => 'text',
                                        'class' => 'form-control mi',
                                        'placeholder' =>'M.I.'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="address" class="col-md-3 col-form-label">Address</label>
                        <div class="col-md-9">
                            <?php
                                $data = [
                                        'name' => 'address',
                                        'type' => 'text',
                                        'class' => 'form-control address',
                                        'placeholder' =>'Address'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contact" class="col-md-3 col-form-label">Contact No.</label>
                        <div class="col-md-9">
                            <?php
                                $data = [
                                        'name' => 'contact',
                                        'type' => 'text',
                                        'class' => 'form-control contact',
                                        'placeholder' =>'Contact'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="optionContact" class="col-md-3 col-form-label">Optional Contact No.</label>
                        <div class="col-md-9">
                            <?php
                                $data = [
                                        'name' => 'optionContact',
                                        'type' => 'text',
                                        'class' => 'form-control optionContact',
                                        'placeholder' =>'Optional Contact'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'update_client',
                                'type' => 'submit',
                                'id' => 'update_client',
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