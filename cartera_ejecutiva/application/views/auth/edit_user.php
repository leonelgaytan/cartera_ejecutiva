                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                              <h1><?php echo lang('edit_user_heading');?></h1>
                              <p><?php echo lang('edit_user_subheading');?></p>
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

                              <?php echo form_open(uri_string(),array("class" => "form-horizontal"));?>


                              <div class="form-group">
                                <label  class="col-sm-2 control-label">
                                  <?php echo lang('edit_user_fname_label', 'first_name');?> 
                                </label>
                                <div class="col-sm-10">
                                  <?php $first_name['class'] = 'form-control';?>
                                  <?php echo form_input($first_name);?>
                                </div>
                              </div>

                              <div class="form-group">
                                <label  class="col-sm-2 control-label">
                                  <?php echo lang('edit_user_lname_label', 'last_name');?> 
                                </label>
                                <div class="col-sm-10">
                                  <?php $last_name['class'] = 'form-control';?>
                                <?php echo form_input($last_name);?>
                                </div>
                              </div>

                              <div class="form-group">
                                <label  class="col-sm-2 control-label">
                                  <?php echo lang('edit_user_company_label', 'company');?>
                                </label>
                                <div class="col-sm-10">
                                  <?php $company['class'] = 'form-control';?>
                                  <?php echo form_input($company);?>
                                </div>
                              </div>

                              <div class="form-group">
                                <label  class="col-sm-2 control-label">
                                          <?php echo lang('edit_user_phone_label', 'phone');?>
                                </label>
                                    <div class="col-sm-10">
                                        <?php $phone['class'] = 'form-control';?>
                                          <?php echo form_input($phone);?>
                                </div>
                              </div>

                              <div class="form-group">
                                <label  class="col-sm-2 control-label">         
                                  <?php echo lang('edit_user_password_label', 'password');?>
                                    </label>
                                    <div class="col-sm-10">
                                        <?php $password['class'] = 'form-control';?>
                                          <?php echo form_input($password);?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-2 control-label">
                                          <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?>
                                    </label>
                                    <div class="col-sm-10">
                                        <?php $password_confirm['class'] = 'form-control';?>
                                        <?php $password_confirm['type'] = 'password';?>
                                        <?php echo form_input($password_confirm);?>
                                </div>
                              </div>


                                    <?php if ($this->ion_auth->is_admin()): ?>

                              <div class="form-group">
                                <label  class="col-sm-2 control-label">
                                    <?php echo lang('edit_user_groups_heading');?>
                                </label>                                    
                                <div class="col-sm-10">

                                        <?php foreach ($groups as $group):?>
                                            <label class="checkbox">
                                            <?php
                                                $gID=$group['ID_GRUPO'];
                                                $checked = null;
                                                $item = null;
                                                foreach($currentGroups as $grp) {
                                                    if ($gID == $grp->ID) {
                                                        $checked= ' checked="checked"';
                                                    break;
                                                    }
                                                }
                                            ?>
                                            <input class="form-control" type="checkbox" name="groups[]" value="<?php echo $group['ID_GRUPO'];?>"<?php echo $checked;?>>
                                            <?php echo htmlspecialchars($group['NOMBRE_GRUPO'],ENT_QUOTES,'UTF-8');?>
                                            </label>
                                        <?php endforeach?>
                                    <?php endif ?>
                                          </div>
                                         </div>

                                    <?php echo form_hidden('ID', $user->ID_USUARIO);?>
                                    <?php echo form_hidden($csrf); ?>

                                    <p><?php echo form_submit('submit', lang('edit_user_submit_btn'),"class='btn btn-info'");?></p>

                              <?php echo form_close();?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
            </div>