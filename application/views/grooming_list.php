<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4>Grooming List</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<?= form_open('grooming/add_groom_type',['id'=>'groomListForm']); ?>
					<div class="form-group row">
		                <label for="groomType" class="col-md-3 col-form-label">Groom Type</label>
		                <div class="col-sm-9">
		                    <?php
		                        $data = [
		                                'name' => 'groomType',
		                                'type' => 'text',
		                                'class' => 'form-control groomType',
		                                'placeholder' =>'Groom Type'
		                        ];
		                        echo form_input($data);
		                    ?>
		                </div>
		            </div>
		            <div class="form-group row">
		                <label for="description" class="col-md-3 col-form-label">Groom Type</label>
		                <div class="col-md-9">
		                    <?php
		                        $data = [
		                                'name'        => 'description',
								        'rows'        => '5',
								        'cols'        => '50',
								        'class'       => 'form-control description'
		                        ];
		                        echo form_textarea($data);
		                    ?>
		                </div>
		            </div>
		            <div class="form-group row">
		                <label for="price" class="col-md-3 col-form-label">Groom Type</label>
		                <div class="col-sm-9">
		                    <?php
		                        $data = [
		                                'name' => 'price',
		                                'type' => 'number',
		                                'class' => 'form-control price',
		                                'placeholder' =>'Groom Price'
		                        ];
		                        echo form_input($data);
		                    ?>
		                </div>
		            </div>
		            <div class="col-md-12">
		            	<?php
                        $data = [
                                'name' => 'add_category',
                                'type' => 'submit',
                                'id' => 'add_category',
                                'class' => 'btn btn-primary pull-right',
                                'value' =>'Add Category'
                        ];
                        echo form_input($data);
                    ?>
		            </div>
				<?= form_close(); ?>
			</div>
			<div class="col-md-8">
				<table id="groomingTable" class="table table-striped table-bordered" style="width:100%">
		            <thead>
		                <tr>
		                    <th>id</th>
		                    <th>Grooming Type</th>
		                    <th>Description</th>
		                    <th>Price</th>
		                    <th>Action</th>
		                </tr>
		            </thead>
		            <tbody>
		                
		            </tbody>
		            <tfoot>
		                <tr>
		                    <th>id</th>
		                    <th>Grooming Type</th>
		                    <th>Description</th>
		                    <th>Price</th>
		                    <th>Action</th>
		                </tr>
		            </tfoot>
		        </table>
			</div>
		</div>
	</div>
</div>

<!--Update Category Modal -->
<div class="modal fade" id="updateGroomModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Supplier</h4>
            </div>
            <?= form_open('grooming/update_groom_type', array('id'=>'updateGroomForm')); ?>
                <div class="modal-body">
                	<?= form_hidden('id', ""); ?>
                   	<div class="form-group row">
		                <label for="groomType" class="col-md-3 col-form-label">Groom Type</label>
		                <div class="col-sm-9">
		                    <?php
		                        $data = [
		                                'name' => 'groomType',
		                                'type' => 'text',
		                                'class' => 'form-control groomType',
		                                'placeholder' =>'Groom Type'
		                        ];
		                        echo form_input($data);
		                    ?>
		                </div>
		            </div>
		            <div class="form-group row">
		                <label for="description" class="col-md-3 col-form-label">Groom Type</label>
		                <div class="col-md-9">
		                    <?php
		                        $data = [
		                                'name'        => 'description',
								        'rows'        => '5',
								        'cols'        => '50',
								        'class'       => 'form-control description'
		                        ];
		                        echo form_textarea($data);
		                    ?>
		                </div>
		            </div>
		            <div class="form-group row">
		                <label for="price" class="col-md-3 col-form-label">Groom Type</label>
		                <div class="col-sm-9">
		                    <?php
		                        $data = [
		                                'name' => 'price',
		                                'type' => 'number',
		                                'class' => 'form-control price',
		                                'placeholder' =>'Groom Price'
		                        ];
		                        echo form_input($data);
		                    ?>
		                </div>
		            </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'update_category',
                                'type' => 'submit',
                                'id' => 'update_category',
                                'class' => 'btn btn-info',
                                'value' =>'Update Category'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>