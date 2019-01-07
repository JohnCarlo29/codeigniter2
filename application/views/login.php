<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <?php if($this->session->flashdata('login_validation')){?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('login_validation'); ?>       
            </div>
            <?php } ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>Login</h5>
                </div>
                <div class="panel-body">
                    <?= form_open('users/login_user'); ?>
                        <div class="form-group">
                            <label for="uname">Email address</label>
                            <?php
                                $data = [
                                        'name' => 'uname',
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' =>'uname',
                                        'placeholder' =>'Enter Username'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                            <div class="form-group">
                            <label for="pword">Password</label>
                            <?php
                                $data = [
                                        'name' => 'pword',
                                        'type' => 'password',
                                        'class' => 'form-control',
                                        'id' =>'pword',
                                        'placeholder' =>'Password'
                                ];
                                echo form_input($data);
                            ?>
                        </div>
                    <?php
                        $data = [
                                'name' => 'login',
                                'type' => 'submit',
                                'class' => 'btn btn-primary',
                                'value' =>'Login'
                        ];
                        echo form_input($data);
                        echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>