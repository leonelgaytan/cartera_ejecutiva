        <div class="container">
            <div class="row">
              <center>
                  <h4><?php echo lang('login_heading');?></h4>
                  <p><?php echo lang('login_subheading');?></p>
              </center>

                <div class="col-md-6 col-md-offset-3">
                  <?php if(strlen($message) > 0){?>
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        <div id="infoMessage"><?php echo $message;?></div>
                    </div>
                  <?php } ?>


                      <?php echo form_open("auth/login", array("class" => "form-horizontal"));?>

                        <div class="form-group">
                        <label  class="col-sm-4 control-label">
                          <?php echo lang('login_identity_label', 'identity');?>
                        </label>
                        <div class="col-sm-6">
                          <?php $identity['class'] = 'form-control';?>
                          <?php echo form_input($identity);?>
                        </div>
                        </div>
                        <div class="form-group">
                        <label  class="col-sm-4 control-label">
                          <?php echo lang('login_password_label', 'password');?>
                        </label>
                        <div class="col-sm-6">
                          <?php $password['class'] = 'form-control';?>
                          <?php echo form_input($password);?>
                        </div>
                        </div>
                        <div class="form-group invisible">
                          <?php echo lang('login_remember_label', 'remember');?>
                          <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                        </div>
                        <center><?php echo form_submit('submit', lang('login_submit_btn'),"class='btn btn-success'");?></center>
                    <?php echo form_close();?>


                </div>


            </div>
          
                      <br />
                      <center>
                        <span class="loginInfo">Para ingresar al módulo de consulta deberá digitar su usuario y contraseña
                        </span>
                      </center>


        </div>







