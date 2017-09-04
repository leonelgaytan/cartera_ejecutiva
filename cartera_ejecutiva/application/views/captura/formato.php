<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/generales.js"></script>

	<script type="text/javascript">var base_url = '<?php echo base_url();?>';</script>
	<script type="text/javascript">var idd = '<?php echo $idd;?>';</script>


	<script type="text/javascript" src="<?php echo base_url();?>assets/js/paso1.js?<?php echo time();?>"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/consulta.js?<?php echo time();?>"></script>

<div class="row">
<div class="col-md-8 col-md-offset-2"">
    <div class="content">
    <table class="table table-bordered" style="width: 800px !important;">
    	<tr>
    		<td rowspan="4" style="width: 100px !important;"><img style="max-width: 150px;margin-top: 50px;" src="<?php echo base_url();?>assets/images/SEP_Horizontal_Small.jpg" /></td>
    		<td colspan="3" rowspan="3">
	    		<b>SECRETARÍA DE EDUCACIÓN PÚBLICA </b><br />
				OFICIALÍA MAYOR U HOMÓLOGO <br />
				NOMBRE DE LA UNIDAD RESPONSABLE
			</td>
    		<td style="width: 100px !important;">Hoja</td>
    		<td style="width: 100px !important;">1/15</td>
    	</tr>

    	<tr>
    		<td colspan="1">Proceso</td>
    		<td colspan="1">PE</td>
    	</tr>

    	<tr>
    		<td colspan="1">Fecha</td>
    		<td colspan="1">Julio 2014</td>
    	</tr>


    	<tr>
    		<td colspan="3">Herramienta de Gestión de la Política TIC PETIC</td>
    		<td rowspan="2" colspan="2">Registro en la Herramienta Formato DGTIC-PE-01</td>
    	</tr>

    	<tr></tr>


    	<tr>
    		<td colspan="3">
				<p><b>Categoría:</b></p>
				<?php for ($a=0; $a < count($ID_CATEGORIA); $a++) { ?>
				<div class="radio">
				  <label>
				    <input type="radio" name="ID_CATEGORIA" id="ID_CATEGORIA<?php echo $ID_CATEGORIA[$a]['ID'];?>">
				   		<?php echo $ID_CATEGORIA[$a]['NAME'];?>
				  </label>
				</div>
				<?php } ?>
    		</td>

    		<td colspan="3">
				<p><b>Riesgo del proyecto:</b></p>
				<?php for ($b=0; $b < count($ID_RIEGO_PROYECTO); $b++) { ?>
				<div class="radio">
				  <label>
				    <input type="radio" name="ID_RIEGO_PROYECTO" id="ID_RIEGO_PROYECTO<?php echo $ID_RIEGO_PROYECTO[$b]['ID'];?>">
				   		<?php echo $ID_RIEGO_PROYECTO[$b]['NAME'];?>
				  </label>
				</div>
				<?php } ?>
    		</td>


    	</tr>

    	<tr>
    			<td colspan="3">
    				
					<p><b>Riesgo del Proyecto</b></p>
					<div class="radio">
					  <label>
					    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
					   		Bajo
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
					    Medio
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
					    Alto
					  </label>
					</div>
    			</td>
    			<td colspan="3">
    				
					<p><b>¿Planea desarrollar aplicativos móviles?</b></p>
					<div class="radio">
					  <label>
					    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
					   		Si
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
					    No
					  </label>
					</div>


					<p><b>En caso negativo llenar el siguiente campo:</b></p>
					<p>Justificación A.M.</p>
					<textarea class="form-control"></textarea>

    			</td>

    	</tr>

    	<tr>
    		<td colspan="6" style="background: #666;color:white;">
				<center>Información de la iniciativa o proyecto</center>
    		</td>
    	</tr>

    	<tr>
    		<td colspan="6">
    			
				  <div class="form-group">
				    <label for="exampleInputEmail1">Identificador del Proyecto (número interno):</label>
				    <input type="text" class="form-control" id="exampleInputEmail1">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Nombre del proyecto:</label>
				    <input type="text" class="form-control" id="exampleInputPassword1">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputPassword1">Antecendentes:</label>
				  	<textarea class="form-control"></textarea>
				  </div>
    		</td>
    	</tr>

    </table>

   </div>
</div>
</div>