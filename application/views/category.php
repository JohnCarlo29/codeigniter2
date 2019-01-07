<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title pull-left">
             <h4>Products Category</h4>
         </div>
        <div class="clearfix"></div>       
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <?=form_open('products/add_category', array('id'=>'addCategoryForm')); ?>
                    <div class="form-group row">
                        <label for="product" class="col-md-12 col-form-label">Category</label>
                        <div class="col-md-12">
                            <?php
                                $data = [
                                        'name' => 'category',
                                        'type' => 'text',
                                        'class' => 'form-control category',
                                        'placeholder' =>'Enter New Category'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <?php
                        $data = [
                                'name' => 'add_category',
                                'type' => 'submit',
                                'id' => 'add_category',
                                'class' => 'btn btn-primary',
                                'value' =>'Add Category'
                        ];
                        echo form_input($data);
                    ?>
                <?=form_close(); ?>
            </div>
            <div class="col-md-8">
                <table id="categoryTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>  
        </div>
    </div>
</div>

<!--update category modal-->
<div class="modal fade bs-example-modal-sm" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?=form_open('products/add_category', array('id'=>'updateCategoryForm')); ?>
                    <?= form_hidden('id', ""); ?>
                    <div class="form-group row">
                        <label for="product" class="col-md-12 col-form-label">Category</label>
                        <div class="col-md-12">
                            <?php
                                $data = [
                                        'name' => 'category',
                                        'type' => 'text',
                                        'class' => 'form-control category',
                                        'placeholder' =>'Enter New Category'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>

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
                <?=form_close(); ?>
            </div>
        </div>
    </div>
</div>