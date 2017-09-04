        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <?php if(strlen($message) > 0){?>
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        <div id="infoMessage"><?php echo $message;?></div>


                    </div>
                  <?php } ?>
                       
					<?php echo form_open("auth/forgot_password",array("class" => "bootstrap-admin-login-form form-horizontal"));?>

						<h1><?php echo lang('forgot_password_heading');?></h1>
						<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>


                        <div class="form-group">
                        <label  class="col-sm-4 control-label">

						<?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?>
                        </label>
                        <div class="col-sm-6">
                          <?php echo form_input($identity);?>
                        </div>
                        </div>

  

						<?php echo form_submit('submit', lang('forgot_password_submit_btn'), "class='btn btn-info'");?>

                    <?php echo form_close();?>

                <center><p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p></center>
                </div>
            </div>
        </div>
