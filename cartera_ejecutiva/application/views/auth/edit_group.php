                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
								<h1><?php echo lang('edit_group_heading');?></h1>
								<p><?php echo lang('edit_group_subheading');?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                              <?php if(strlen($message) > 0){?>
                                <div class="alert alert-danger">
                                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                                    <div id="infoMessage"><?php echo $message;?></div>
                                </div>
                              <?php } ?>

								<?php echo form_open(current_url(),array("class" => "form-horizontal"));?>


		                              <div class="form-group">
		                                <label  class="col-sm-2 control-label">
		                                  <?php echo lang('edit_group_name_label', 'group_name');?>
		                                </label>
		                                <div class="col-sm-10">
		                                <?php $group_name['class'] = 'form-control';?>
		                                  <?php echo form_input($group_name,array("class" => "form-control"));?>
		                                </div>
		                              </div>

		                              <div class="form-group">
		                                <label  class="col-sm-2 control-label">
		                                  <?php echo lang('edit_group_desc_label', 'description');?>
		                                </label>
		                                <div class="col-sm-10">
		                                <?php $group_description['class'] = 'form-control';?>
		                                  <?php echo form_input($group_description,array("class" => "form-control"));?>
		                                </div>
		                              </div>

								      <p><?php echo form_submit('submit', lang('edit_group_submit_btn'),"class='btn btn-info'");?></p>

								<?php echo form_close();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>