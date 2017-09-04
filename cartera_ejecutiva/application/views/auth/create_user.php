                <!-- content -->
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h2><?php echo lang('create_user_heading');?></h2>
                                <p><?php echo lang('create_user_subheading');?></p>
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

                                <?php echo form_open("auth/create_user",array("class" => "form-horizontal"));?>


                              <div class="form-group">
                                <label  class="col-sm-2 control-label">
                                  <?php echo lang('create_user_fname_label', 'first_name');?>
                                </label>
                                <div class="col-sm-10">
                                <?php $first_name['class'] = 'form-control';?>
                                  <?php echo form_input($first_name,array("class" => "form-control"));?>
                                </div>
                              </div>

                                  <div class="form-group">
                                    <label  class="col-sm-2 control-label">
                                      <?php echo lang('create_user_lname_label', 'last_name');?>
                                    </label>
                                    <div class="col-sm-10">
                                        <?php $last_name['class'] = 'form-control';?>
                                        <?php echo form_input($last_name);?>
                                    </div>
                                  </div>
                                      
                                      <?php if($identity_column!=='EMAIL') { ?>
                                      <div class="form-group">
                                        <label  class="col-sm-2 control-label">
                                          <?php echo lang('create_user_identity_label', 'identity'); ?>
                                        </label>
                                        <div class="col-sm-10">
                                          <?php echo form_error('identity');?>
                                          <?php $identity['class'] = 'form-control';?>
                                          <?php echo form_input($identity);?>
                                        </div>
                                      </div>
                                      <?php } ?>

                                    <div class="form-group">
                                      <label  class="col-sm-2 control-label">
                                        <?php echo lang('create_user_company_label', 'company');?>
                                      </label>
                                      <div class="col-sm-10">
                                          <?php $company['class'] = 'form-control';?>
                                          <?php $company['placeholder'] = 'Secretaría de Educación Pública';?>
                                          <?php echo form_input($company);?>
                                      </div>
                                    </div>

                                   <div class="form-group">
                                      <label  class="col-sm-2 control-label">
                                        <?php echo lang('create_user_email_label', 'email');?>
                                      </label>
                                      <div class="col-sm-10">
                                          <?php $email['class'] = 'form-control';?>
                                           <?php echo form_input($email);?>
                                      </div>
                                    </div>

                                   <div class="form-group">
                                      <label  class="col-sm-2 control-label">
                                        <?php echo lang('create_user_phone_label', 'phone');?>
                                      </label>
                                      <div class="col-sm-10">
                                          <?php $phone['class'] = 'form-control';?>
                                           <?php echo form_input($phone);?>
                                      </div>
                                    </div>


                                   <div class="form-group">
                                      <label  class="col-sm-2 control-label">
                                        <?php echo lang('create_user_password_label', 'password');?>
                                      </label>
                                      <div class="col-sm-10">
                                          <?php $password['class'] = 'form-control';?>
                                           <?php echo form_input($password);?>
                                      </div>
                                    </div>

                                   <div class="form-group">
                                      <label  class="col-sm-2 control-label">
                                        <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
                                      </label>
                                      <div class="col-sm-10">
                                          <?php $password_confirm['class'] = 'form-control';?>
                                           <?php echo form_input($password_confirm);?>
                                      </div>
                                    </div>

                                      <p><?php echo form_submit('submit', lang('create_user_submit_btn'),"class='btn btn-info'");?></p>

                                <?php echo form_close();?>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>