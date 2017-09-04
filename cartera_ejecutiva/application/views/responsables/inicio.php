	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>	
	<script type="text/javascript">var base_url = '<?php echo base_url();?>';</script>
	<script type="text/javascript">var idr = '<?php echo $ID_RESPONSABLE;?>';</script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/generales.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/responsables.js?<?php echo time();?>"></script>

<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>


	<script type="text/javascript">
		jQuery(document).ready(function($) {
			<?php if($MODAL == 1){?>
				setTimeout(function(){ 
					$('#myModal').modal('show');
				 }, 1000);
			<?php } ?>
		});
	</script>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">   
      	<div id="tblResultados">

			<!-- Button trigger modal -->
			<a href="<?php echo base_url();?>index.php/responsables?m=1" style="float: right;margin-bottom: 10px;margin-right: 10px;" class="btn btn-primary btnNuevo">
			  Registrar nuevo
			</a>


	       <table id="tblRegistros" class="table table-bordered table-striped">
	       <thead>
		        <tr>
			        <th>TÍTULO</th>
			        <th>NOMBRE</th>
			        <th>CARGO</th>
			        <th>CORREO</th>
			        <th>TELÉFONO</th>
			        <th>EXT</th>
			        <th></th>
		        </tr>	       	
	       </thead>
	       <tbody id="tbodyRegistros">
	       	<?php for ($r=0; $r < count($Responsables); $r++) { ?>
	       		<tr>
			        <td><?php echo $Responsables[$r]['ABREVIATURA'];?></td>
			        <td><?php echo $Responsables[$r]['NOMBRE_RESPONSABLE'];?></td>
			        <td><?php echo $Responsables[$r]['CARGO_RESPONSABLE'];?></td>
			        <td><?php echo $Responsables[$r]['CORREO_RESPONSABLE'];?></td>
			        <td><?php echo $Responsables[$r]['TEL_RESPONSABLE'];?></td>
			        <td><?php echo $Responsables[$r]['EXT_RESPONSABLE'];?></td>
			        <td>
			        	<a class="btn btn-xs btn-warning" href="<?php echo base_url();?>index.php/responsables/index/<?php echo $Responsables[$r]['ID_RESPONSABLE'];?>?m=1"><i class="glyphicon glyphicon-pencil"></i></a>
			        	<a class="btn btn-xs btn-danger btnEliminar" data-id="<?php echo $Responsables[$r]['ID_RESPONSABLE'];?>"><i class="glyphicon glyphicon-trash"></i></a>
			        </td>
	       		</tr>
	       	<?php } ?>
	       </tbody>
	       </table>
	    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Agregar/Editar Responsables</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form id="formResponsables" action="#">
			<input type="hidden" name="ID_RESPONSABLE" id="ID_RESPONSABLE" value="<?php echo $ID_RESPONSABLE;?>">
			  <div class="form-group">
			    <label for="ID_TITULO">Título</label>
			    <select class="form-control required" name="ID_TITULO" id="ID_TITULO">
			    	<option value="">--- SELECCIONE ---</option>
			      <?php for ($t=0; $t < count($ID_TITULO); $t++) {?>
			      	<option value="<?php echo $ID_TITULO[$t]['ID'];?>" <?php echo (isset($Info[0]['ID_TITULO']) && $Info[0]['ID_TITULO'] == $ID_TITULO[$t]['ID']) ? 'selected' : '';?>><?php echo $ID_TITULO[$t]['NAME'];?></option>
			      <?php } ?>
			    </select>
			  </div>

		  <div class="form-group">
		    <label for="NOMBRE_RESPONSABLE">Nombre</label>
		    <input type="text" class="form-control required" id="NOMBRE_RESPONSABLE" name="NOMBRE_RESPONSABLE" value="<?php echo (isset($Info[0]['NOMBRE_RESPONSABLE'])) ? $Info[0]['NOMBRE_RESPONSABLE'] : '';?>">
		  </div>

		  <div class="form-group">
		    <label for="CARGO_RESPONSABLE">Cargo</label>
		    <textarea rows="4"  class="form-control required" id="CARGO_RESPONSABLE" name="CARGO_RESPONSABLE"><?php echo (isset($Info[0]['CARGO_RESPONSABLE'])) ? $Info[0]['CARGO_RESPONSABLE'] : '';?></textarea>
		  </div>

		  <div class="form-group">
		    <label for="CORREO_RESPONSABLE">Correo</label>
		    <input type="email" class="form-control" id="CORREO_RESPONSABLE" name="CORREO_RESPONSABLE" value="<?php echo (isset($Info[0]['CORREO_RESPONSABLE'])) ? $Info[0]['CORREO_RESPONSABLE'] : '';?>">
		  </div>

		  <div class="row">
		  	<div class="col-md-6">
			  <div class="form-group">
			    <label for="TEL_RESPONSABLE">Teléfono</label>
			    <input type="text" class="form-control" id="TEL_RESPONSABLE" name="TEL_RESPONSABLE" value="<?php echo (isset($Info[0]['TEL_RESPONSABLE'])) ? $Info[0]['TEL_RESPONSABLE'] : '';?>">
			  </div>
		  	</div>
		  	<div class="col-md-6">
			  <div class="form-group">
			    <label for="EXT_RESPONSABLE">Extensión</label>
			    <input type="text" class="form-control" id="EXT_RESPONSABLE" name="EXT_RESPONSABLE" value="<?php echo (isset($Info[0]['EXT_RESPONSABLE'])) ? $Info[0]['EXT_RESPONSABLE'] : '';?>">
			  </div>
		  	</div>
		  </div>

		  <hr />
		  <button type="submit" class="btn btn-primary">Guardar</button>
		</form>
      </div>
  </div>
</div>