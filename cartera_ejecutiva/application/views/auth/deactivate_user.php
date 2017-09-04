                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
								<h1><?php echo lang('deactivate_heading');?></h1>
								<p><?php echo sprintf(lang('deactivate_subheading'), $user->NOMBRE_USUARIO);?></p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">

									<?php echo form_open("auth/deactivate/".$user->ID_USUARIO,array("class" => "form-horizontal"));?>

									<div class="radio">

									  	<label>
									    <input type="radio" name="confirm" value="yes" checked="checked" />
										<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
									    </label>
									    </div>
									    <div class="radio">
									    <label>
									    <input type="radio" name="confirm" value="no" />
					    				<?php echo lang('deactivate_confirm_n_label', 'confirm');?>
									    </label>
									</div>
									<hr />
									  <?php echo form_hidden($csrf); ?>
									  <?php echo form_hidden(array('id'=>$user->ID_USUARIO)); ?>

									  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'),"class = 'btn btn-info'");?></p>

									<?php echo form_close();?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>