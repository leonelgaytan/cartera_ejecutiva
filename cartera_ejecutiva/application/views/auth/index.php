                <!-- content -->
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
								<h2><?php echo lang('index_heading');?></h2>
								<p><?php echo lang('index_subheading');?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">

						<div id="infoMessage"><?php echo $message;?></div>

						<table class="table table-bordered">
							<tr>
								<th>ID</th>
								<th><?php echo lang('index_uname_th');?></th>
								<th><?php echo lang('index_fname_th');?></th>
								<th><?php echo lang('index_lname_th');?></th>
								<th><?php echo lang('index_email_th');?></th>
								<th><?php echo lang('index_groups_th');?></th>
								<th><?php echo lang('index_status_th');?></th>
								<th><?php echo lang('index_action_th');?></th>
							</tr>
							<?php foreach ($users as $user):?>
								<tr>
						            <td><?php echo htmlspecialchars($user->ID_USUARIO,ENT_QUOTES,'UTF-8');?></td>
						            <td><?php echo htmlspecialchars($user->NOMBRE_USUARIO,ENT_QUOTES,'UTF-8');?></td>
						            <td><?php echo htmlspecialchars($user->FIRST_NAME,ENT_QUOTES,'UTF-8');?></td>
						            <td><?php echo htmlspecialchars($user->LAST_NAME,ENT_QUOTES,'UTF-8');?></td>
						            <td><?php echo htmlspecialchars($user->EMAIL,ENT_QUOTES,'UTF-8');?></td>
									<td>
										<?php foreach ($user->groups as $group):?>
											<?php echo htmlspecialchars($group->NOMBRE_GRUPO,ENT_QUOTES,'UTF-8');?><br />
						                <?php endforeach?>
									</td>
									<td><?php echo ($user->ACTIVE) ? anchor("auth/deactivate/".$user->ID_USUARIO, lang('index_active_link')) : anchor("auth/activate/". $user->ID_USUARIO, lang('index_inactive_link'));?></td>
									<td><?php echo anchor("auth/edit_user/".$user->ID_USUARIO, 'Edit') ;?></td>
								</tr>
							<?php endforeach;?>
						</table>

						<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?></p>

						</div>

					</div>
                </div>
            </div>
        </div>
    </div>
</div>