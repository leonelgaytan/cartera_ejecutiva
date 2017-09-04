    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/formwizard/js/jquery.validate.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/generales.js?<?php echo time();?>"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/catalogos.js?<?php echo time();?>"></script>
	<script type="text/javascript">base_url = '<?php echo base_url();?>'</script>

		<!-- Multiple Select -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
		<link rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">

		<div class="row">

			<div class="col-md-10 col-md-offset-1" style="border:1px solid #ccc;">

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    <label for="catalogos">Seleccione un catálogo</label>

							<select class="form-control" id="catalogos">
							</select>
						</div>
					</div>
				</div>
				
				<div class="row">
						<div id="msgUpdate" class="alert alert-warning" role="alert">Se encuentra editando información <a onclick="resetEdicion()">Nuevo</a></div>

					<div class="col-md-5">
						<form action="#" id="guardaCatalogo">

						  <div id="divID_UR" class="form-group">
						    <label for="ID">Unidad Responsable</label>
						    <select id="ID_UR" name="ID_UR" class="form-control">
						    </select>
						  </div>
						  <!-- ELEMENTOS PARA C_FORMATOR_RECIBIDOS -->


							<div class="form-group" id="divID_TIPO_PROYECTO">
						    	<label for="ID_TIPO_PROYECTO">Tipo proyecto</label>
					      		<select  multiple="multiple" class="form-control required" id="ID_TIPO_PROYECTO" name="ID_TIPO_PROYECTO[]">
								<?php 
									for ($a1=0; $a1 < count($ID_TIPO_PROYECTO); $a1++) { ?>
										<option <?php echo (isset($info[0]['ID_TIPO_PROYECTO']) && $info[0]['ID_TIPO_PROYECTO'] == $ID_TIPO_PROYECTO[$a1]['ID']) ? 'selected': '';?> value="<?php echo $ID_TIPO_PROYECTO[$a1]['ID'];?>"><?php echo $ID_TIPO_PROYECTO[$a1]['ID'] . ' - ' . $ID_TIPO_PROYECTO[$a1]['NAME'];?></option>
									<?php } ?>
								?>
						      </select>
							</div>


							<div class="form-group" id="divID_TIPO_OFICIO">
						    	<label for="ID_TIPO_OFICIO">Tipo Oficio</label>
					      		<select  multiple="multiple" class="form-control required" id="ID_TIPO_OFICIO" name="ID_TIPO_OFICIO[]">
								<?php 
									for ($a1=0; $a1 < count($ID_TIPO_OFICIO); $a1++) { ?>
										<option <?php echo (isset($info[0]['ID_TIPO_OFICIO']) && $info[0]['ID_TIPO_OFICIO'] == $ID_TIPO_OFICIO[$a1]['ID']) ? 'selected': '';?> value="<?php echo $ID_TIPO_OFICIO[$a1]['ID'];?>"><?php echo $ID_TIPO_OFICIO[$a1]['ID'] . ' - ' . $ID_TIPO_OFICIO[$a1]['NAME'];?></option>
									<?php } ?>
								?>
						      </select>
							</div>


						  <div class="form-group" id="divID">
						    <label for="ID">Identificador</label>
						    <input type="text" class="form-control required" id="ID" name="ID" readonly="readonly">
						    <span class="spanId">El identificador que se muestre es el consecutivo de la tabla seleccionada - <a class="btnCambiarId">Cambiar</a></span>
						  </div>

						  <div class="form-group">
						    <label for="NAME">Nombre</label>
						    <input type="text" class="form-control required" id="NAME" name="NAME" placeholder="Nombre">
						  </div>

						  <button type="submit" class="btn btn-success">Guardar</button>
						</form>

					</div>

					<div class="col-md-7" id="tbl">

					</div>
				</div>

			</div>
		</div>
     </div>
   </div>
  </div>
</div>