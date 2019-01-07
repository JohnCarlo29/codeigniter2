<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-default col-md-12">
	<div class="panel-body row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<?= form_open('pets/admit',['id'=>'admitForm']); ?>
						<fieldset>
							<legend>Client & Pet</legend>
							<div class="form-group row">
			                    <label for="owner" class="col-md-3 col-form-label">Owner</label>
			                    <div class="col-md-9">
			                        <?php
			                        	$attrib = ['class' => 'form-control', 'id'=>'owner'];
			                            echo form_dropdown('owner',$owners,'0',$attrib);
			                        ?>
			                    </div>
			                </div>
			                <div class="form-group row">
			                    <label for="pet" class="col-md-3 col-form-label">Pet</label>
			                    <div class="col-md-9">
			                        <?php
			                        	$attrib = ['class' => 'form-control', 'id'=>'pet'];
			                            echo form_dropdown('pet',null, null,$attrib);
			                        ?>
			                    </div>
			                </div>
			                <div class="form-group row">
			                    <label for="complaint" class="col-md-3 col-form-label">Complaint</label>
			                    <div class="col-md-9">
			                        <?php
				                        $data = [
				                                'name'        => 'complaint',
										        'rows'        => '4',
										        'cols'        => '50',
										        'class'       => 'form-control',
										        'id' => 'complaint'
				                        ];
				                        echo form_textarea($data);
				                    ?>
			                    </div>
			                </div>
			                <div class="form-group row">
			                    <label for="service" class="col-md-3 col-form-label">Service</label>
			                    <div class="col-md-9">
			                        <?php
			                        	$attrib = ['class' => 'form-control','id'=>'service'];
			                        	$data = [
			                        		'0' => 'Choose Service',
			                        		'Check-up' => 'Check-up',
			                        		'Confinement' => 'Confinement',
			                        		'Surgery' => 'Surgery',
			                        		'Vaccine' => 'Vaccine',
			                        		'Deworming' => 'Deworming',
			                        		'Others' => 'Others',
		                        		];
			                            echo form_dropdown('service',$data,'0',$attrib);
			                        ?>
			                    </div>
			                </div>
			                <div class="form-group row">
			                    <label for="dateAdmit" class="col-md-3 col-form-label">Date Admit</label>
			                    <div class="col-md-9">
			                        <?php
			                            $data = [
			                                    'name' => 'dateAdmit',
			                                    'type' => 'date',
			                                    'class' => 'form-control',
			                                    'id' => 'dateAdmit'
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
			                                    'value' => 'Admit'
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
		                </fieldset>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<table id="admissionTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th>id</th>
		                <th>Pet</th>
		                <th>Owner</th>
		                <th>Complaint</th>
		                <th>Service</th>
		                <th>Date Admitted</th>
		                <th>Action</th>
		            </tr>
		        </thead>
		        <tbody>
		        </tbody>

		        <tfoot>
		            <tr>
		                <th>id</th>
		                <th>Pet</th>
		                <th>Owner</th>
		                <th>Complaint</th>
		                <th>Service</th>
		                <th>Date Admitted</th>
		                <th>Action</th>
		            </tr>
		        </tfoot>
		    </table>
		</div>
	</div>
</div>


<!--lab test modal -->

<div id="labModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Lab Test</h4>
			</div>
			<div class="modal-body">
				<?= form_open('pets/lab_update',['id'=>'labForm']); ?>
					<?=form_hidden('id', ""); ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label for="blood" class="col-md-5 col-form-label">Blood</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'blood',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'blood'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="distemper" class="col-md-5 col-form-label">Distemper</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'distemper',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'distemper'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="parvo" class="col-md-5 col-form-label">Parvo</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'parvo',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'parvo'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="ehrlichia" class="col-md-5 col-form-label">Ehrlichia</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'ehrlichia',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'ehrlichia'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="heartworm" class="col-md-5 col-form-label">Heartworm</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'heartworm',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'heartworm'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="ultrasound" class="col-md-5 col-form-label">Ultrasound</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'ultrasound',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'ultrasound'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="other" class="col-md-5 col-form-label">Other</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'other',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'other'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label for="vaginal" class="col-md-5 col-form-label">VaginalSmear</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'vaginal',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'vaginal'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="xrays" class="col-md-5 col-form-label">X-ray</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'xrays',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'xrays'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="scrapping" class="col-md-5 col-form-label">SkinScrapping</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'scrapping',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'scrapping'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="swabbing" class="col-md-5 col-form-label">EarSwabbing</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'swabbing',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'swabbing'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="urine" class="col-md-5 col-form-label">Urine</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'urine',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'urine'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
		                    <div class="form-group row">
								<label for="stool" class="col-md-5 col-form-label">Stool</label>
		                        <div class="col-md-7">
		                            <?php
		                                $data = [
		                                        'name' => 'stool',
		                                        'type' => 'text',
		                                        'class' => 'form-control',
		                                        'id' => 'stool'
		                                ];
		                                echo form_input($data);
		                            ?>
		                        </div>
		                    </div>
						</div>
					</div>
				<?= form_close(); ?>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success pull-right" id="updateLab" name="updateLab">Lab Result</button>
			</div>
		</div>
	</div>
</div>

<!--Releasing Modal -->

<div id="releaseModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Releasing</h4>
			</div>
			<div class="modal-body">
				<?= form_open('pets/release', ['id'=>'medicalForm']); ?>
					<?= form_hidden('id',''); ?>
					<div class="panel panel-default">
						<div class="panel-body">
								<fieldset>
									<legend>Medical Fields</legend>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
							                    <label for="findings" class="col-md-12 col-form-label">Diagnosis/Findings</label>
							                    <div class="col-md-12">
							                        <?php
								                        $data = [
								                                'name'        => 'findings',
														        'rows'        => '2',
														        'cols'        => '50',
														        'class'       => 'form-control',
														        'id'		  => 'findings'
								                        ];
								                        echo form_textarea($data);
								                    ?>
							                    </div>
							                </div>
						            	</div>
						            	<div class="col-md-6">
							                <div class="form-group row">
							                    <label for="medication" class="col-md-12 col-form-label">Medication</label>
							                    <div class="col-md-12">
							                        <?php
								                        $data = [
								                                'name'        => 'medication',
														        'rows'        => '2',
														        'cols'        => '50',
														        'class'       => 'form-control',
														        'id'		  => 'medication'
								                        ];
								                        echo form_textarea($data);
								                    ?>
							                    </div>
							                </div>
							            </div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
							                    <label for="recommendation" class="col-md-12 col-form-label">Recommendation</label>
							                    <div class="col-md-12">
							                        <?php
								                        $data = [
								                                'name'        => 'recommendation',
														        'rows'        => '2',
														        'cols'        => '50',
														        'class'       => 'form-control',
														        'id'		  => 'recommendation'
								                        ];
								                        echo form_textarea($data);
								                    ?>
							                    </div>
							                </div>
						            	</div>
						            	<div class="col-md-6">
							                <div class="form-group row">
							                    <label for="prescription" class="col-md-12 col-form-label">Prescription</label>
							                    <div class="col-md-12">
							                        <?php
								                        $data = [
								                                'name'        => 'prescription',
														        'rows'        => '2',
														        'cols'        => '50',
														        'class'       => 'form-control',
														        'id'		  => 'prescription'
								                        ];
								                        echo form_textarea($data);
								                    ?>
							                    </div>
							                </div>
							            </div>
									</div>
									<div class="row">
						            	<div class="col-md-6">
							                <div class="form-group row">
							                    <label for="pet" class="col-md-4 col-form-label">Follow up</label>
							                    <div class="col-md-8">
							                        <?php
							                        	$attrib = ['class' => 'form-control', 'id'=>'follow-up'];
							                        	$data = ['0'=>'Follow up?','yes'=>'Yes','no'=>'No'];
							                            echo form_dropdown('follow-up',$data,'0',$attrib);
							                        ?>
							                    </div>
							                </div>
							                <div class="form-group row">
							                    <label for="nextsched" class="col-md-4 col-form-label">Next Sched</label>
							                    <div class="col-md-8">
							                        <?php
							                            $data = [
							                                    'name' => 'nextsched',
							                                    'type' => 'date',
							                                    'class' => 'form-control',
							                                    'id' => 'nextsched',
							                                    'disabled'=>'disabled'
							                            ];
							                            echo form_input($data);
							                        ?>
							                    </div>
							                </div>
							                <div class="form-group row">
							                    <label for="releasedate" class="col-md-4 col-form-label">Date Release</label>
							                    <div class="col-md-8">
							                        <?php
							                            $data = [
							                                    'name' => 'releasedate',
							                                    'type' => 'date',
							                                    'class' => 'form-control',
							                                    'id' => 'releasedate'
							                            ];
							                            echo form_input($data);
							                        ?>
							                    </div>
							                </div>
							            </div>
							            <div class="col-md-6">
							            	<div class="form-group row">
							            		<label for="schedfor" class="col-md-3 col-form-label">For</label>
							                    <div class="col-md-9" id="for" style="margin-bottom: 7px; height: 80px; overflow-x: scroll; border: 1px solid black">
							                        <input type="checkbox" name="schedfor[]" value="value1" />HeartWorm Screening<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />HeartWorm Prevention<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />Deworming<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />3in1/5in1/6in1<br />
													<input type="checkbox" name="schedfor[]" value="value3" />Rabbies<br />
													<input type="checkbox" name="schedfor[]" value="value2" />Kennel Cough Vaccine<br />
													<input type="checkbox" name="schedfor[]" value="value1" />Microsporum Vaccine<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />Dental Propphylaxis<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />Executive Check up<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />Grooming<br />
													<input type="checkbox" name="schedfor[]" value="value3" />Tick and Flean Prevention<br />
													<input type="checkbox" name="schedfor[]" value="value2" />Full Tick and Flean Prevention<br />
													<input type="checkbox" name="schedfor[]" value="value1" />Ehrlichia Treatment/Prevention<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />Follow-up check up<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />Confinement<br />
							                        <input type="checkbox" name="schedfor[]" value="value1" />Surgery<br />
							                    </div>
							            	</div>
							            	<div class="form-group row">
												<label for="specific" class="col-md-3 col-form-label">Specific</label>
						                        <div class="col-md-9">
						                            <?php
						                                $data = [
						                                        'name' => 'specific',
						                                        'type' => 'text',
						                                        'class' => 'form-control',
						                                        'id' => 'specific'
						                                ];
						                                echo form_input($data);
						                            ?>
						                        </div>
						                    </div>
							            </div>
									</div>
				                </fieldset>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group row">
									<label for="fee" class="col-md-3 col-form-label">Fee</label>
				                    <div class="col-md-9">
				                        <?php
				                            $data = [
				                                    'name' => 'fee',
				                                    'type' => 'number',
				                                    'class' => 'form-control',
				                                    'id' => 'fee'
				                            ];
				                            echo form_input($data);
				                        ?>
				                    </div>
				                </div>
				           	</div>
				           	<div class="col-md-6">
				                <div class="form-group row">
									<label for="cash" class="col-md-3 col-form-label">Cash</label>
				                    <div class="col-md-9">
				                        <?php
				                            $data = [
				                                    'name' => 'cash',
				                                    'type' => 'number',
				                                    'class' => 'form-control',
				                                    'id' => 'cash'
				                            ];
				                            echo form_input($data);
				                        ?>
				                    </div>
				                </div>
				            </div>
				            <div class="col-md-6">
				                <div class="form-group row">
									<label for="cash" class="col-md-3 col-form-label">Change</label>
				                    <div class="col-md-9">
				                        <?php
				                            $data = [
				                                    'name' => 'change',
				                                    'type' => 'number',
				                                    'class' => 'form-control',
				                                    'id' => 'change',
				                                    'readonly'=>true
				                            ];
				                            echo form_input($data);
				                        ?>
				                    </div>
				                </div>
				            </div>
				            <div class="col-md-6">
				                <div class="form-group row">
									<?php
				                        $data = [
				                                'name' => 'release',
				                                'type' => 'submit',
				                                'class' => 'btn btn-primary col-md-12',
				                                'id'=>'releasePet',
				                                'value' => 'Release'
				                        ];
				                        echo form_input($data);
				                    ?>
				                </div>
				            </div>
						</div>
					</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
