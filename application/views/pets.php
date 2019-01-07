<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>New Pet</h4>
		</div>
		<div class="panel-body">
			<?= form_open('pets/add_pet',['id'=>'petForm']); ?>
				<div class="form-group row">
                    <label for="pet" class="col-md-3 col-form-label">Pet Name</label>
                    <div class="col-md-9">
                        <?php
                            $data = [
                                    'name' => 'pet',
                                    'type' => 'text',
                                    'class' => 'form-control pet',
                                    'placeholder' =>'Pet Name'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pet" class="col-md-3 col-form-label">Owner</label>
                    <div class="col-md-9">
                        <?php
                        	$attrib = ['class' => 'form-control owner'];
                            echo form_dropdown('owner',$owners,'0',$attrib);
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pet" class="col-md-3 col-form-label">Breed</label>
                    <div class="col-md-9">
                        <?php
                            $data = [
                                    'name' => 'breed',
                                    'type' => 'text',
                                    'class' => 'form-control breed',
                                    'placeholder' =>'Breed'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pet" class="col-md-3 col-form-label">Sex</label>
                    <div class="col-md-4">
                        <?php
                            echo form_radio('gender', 'male', false).form_label('Male', 'gender');
                        ?>
                    </div>
                     <div class="col-md-5">
                        <?php
                            echo form_radio('gender', 'female', false).form_label('Female', 'gender');
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bday" class="col-md-3 col-form-label">Birthday</label>
                    <div class="col-md-9">
                        <?php
                            $data = [
                                    'name' => 'bday',
                                    'type' => 'date',
                                    'class' => 'form-control bday',
                                    'placeholder' =>'Birthday'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <?php
                            $data = [
                                    'name' => 'submit',
                                    'type' => 'submit',
                                    'class' => 'btn btn-primary col-md-12',
                                    'value' => 'Register'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                            $data = [
                                    'name' => 'clear',
                                    'type' => 'reset',
                                    'class' => 'btn btn-warning col-md-12',
                                    'value' => 'Clear'
                            ];
                            echo form_input($data);
                        ?>
                    </div>
                </div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<div class="col-md-8">
	<table id="petsTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                	<th>ID</th>
                    <th>Pet</th>
                    <th>Owner</th>
                    <th>Breed</th>
                    <th>Sex</th>
                    <th>Birthday</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
                <tr>
                	<th>ID</th>
                    <th>Pet</th>
                    <th>Owner</th>
                    <th>Breed</th>
                    <th>Sex</th>
                    <th>Birthday</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
</div>

<div class="modal fade" id="updatePetModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Pet</h4>
            </div>
            <?= form_open('products/update_product', array('id'=>'updatePetForm')); ?>
                <div class="modal-body">
                    <?= form_hidden('id', ""); ?>
                    <div class="form-group row">
	                    <label for="pet" class="col-md-3 col-form-label">Pet Name</label>
	                    <div class="col-md-9">
	                        <?php
	                            $data = [
	                                    'name' => 'pet',
	                                    'type' => 'text',
	                                    'class' => 'form-control pet',
	                                    'placeholder' =>'Pet Name'
	                            ];
	                            echo form_input($data);
	                        ?>
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="pet" class="col-md-3 col-form-label">Owner</label>
	                    <div class="col-md-9">
	                        <?php
	                        	$attrib = ['class' => 'form-control owner'];
	                            echo form_dropdown('owner',$owners,'0',$attrib);
	                        ?>
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="pet" class="col-md-3 col-form-label">Breed</label>
	                    <div class="col-md-9">
	                        <?php
	                            $data = [
	                                    'name' => 'breed',
	                                    'type' => 'text',
	                                    'class' => 'form-control breed',
	                                    'placeholder' =>'Breed'
	                            ];
	                            echo form_input($data);
	                        ?>
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="pet" class="col-md-3 col-form-label">Sex</label>
	                    <div class="col-md-4">
	                        <?php
	                            echo form_radio('gender', 'male', false).form_label('Male', 'gender');
	                        ?>
	                    </div>
	                     <div class="col-md-5">
	                        <?php
	                            echo form_radio('gender', 'female', false).form_label('Female', 'gender');
	                        ?>
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="bday" class="col-md-3 col-form-label">Birthday</label>
	                    <div class="col-md-9">
	                        <?php
	                            $data = [
	                                    'name' => 'bday',
	                                    'type' => 'date',
	                                    'class' => 'form-control bday',
	                                    'placeholder' =>'Birthday'
	                            ];
	                            echo form_input($data);
	                        ?>
	                    </div>
	                </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'update_pet',
                                'type' => 'submit',
                                'id' => 'update_pet',
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
