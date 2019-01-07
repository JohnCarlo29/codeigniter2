<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title pull-left">
             <h4>Stocks</h4>
         </div>
        <div class="clearfix"></div>       
    </div>
    <div class="panel-body">
        <table id="stocksTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Quantity</th>
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
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--Adjust Stocks Items Modal -->
<div class="modal fade" id="stocksModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Stock Adjustment</h4>
            </div>
            <?= form_open('items/adjust_stocks', array('id'=>'stocksForm')); ?>
                <div class="modal-body">
                    <?= form_hidden('id', ""); ?>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">SKU</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'sku',
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' => 'sku',
                                        'readonly' => 'true'
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
                                        'name' => 'name',
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'readonly' => 'true'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-3 col-form-label">Qty</label>
                        <div class="col-sm-9">
                            <?php
                                $data = [
                                        'name' => 'qty',
                                        'type' => 'number',
                                        'class' => 'form-control',
                                        'id' => 'qty',
                                        'placeholder' => 'Enter Qty'
                                ];  
                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $data = [
                                'name' => 'adjustment',
                                'type' => 'submit',
                                'id' => 'adjustment',
                                'class' => 'btn btn-info',
                                'value' =>'Adjust Stocks'
                        ];
                        echo form_input($data);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>