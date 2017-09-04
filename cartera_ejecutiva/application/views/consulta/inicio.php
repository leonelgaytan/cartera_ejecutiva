<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

<!-- Datatabñes -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	
<script type="text/javascript" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<!-- Multiple Select -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">



 <!-- Customs -->
<link rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/plugins/datepicker/css/datepicker.css">

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>    

<script type="text/javascript" src="<?php echo base_url();?>assets/js/generales.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/consulta.js?<?php echo time();?>"></script>
<script type="text/javascript">var base_url = '<?php echo base_url();?>';</script>
	

<script type="text/javascript">



function changeInputDiv(){
   <?php if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('generador')){ ?>			
		$($('#formRegistrar').prop('elements')).each(function(){
            var value = $(this).val();
            var new_html = ('<div>' + value +  '</div>' )
            $(this).replaceWith(new_html);
		});
	<?php } ?>
	}


	function fillDatosDemanda(){
			if(idd > 0){
			$('#tblRegistros').hide();
		        $.ajax({
		                data:  {'id' : did},
		                url:   base_url + 'index.php/v2/consulta/buscarDetalle',
		                type:  'GET',
		                beforeSend: function () {
		                    $("#bodyModal").html("<center><h3>Buscando Información...</h3></center>");
		                },
		                success:  function (response) {
								$('#bodyModal').hide();
								fillTableDetail(response);
								$('#tblRegistros').show();
		                }, 
		                error: function() {
		                    $("#resultado").html("<center><h3>Ocurrio un error... Intente de nuevo</h3></center>");
		                }
		        });
			}else{
            	$('#formRegistrar')[0].reset();
			}
	}
</script>

<style type="text/css">
	
.datepicker {
  padding: 4px;
  border-radius: 4px;
  direction: ltr;
  /*.dow {
	border-top: 1px solid #ddd !important;
  }*/
  z-index:2000;
}	
.help-block{
	font-size: 10px;
	color: red;
}
</style>


	<div class="row">
		<div class="col-md-8 col-md-offset-2">

	<div class="divInstrucciones">
	    	<h5 class="sisInstrucciones">INSTRUCCIONES:</h5>
			<li>
				Ingrese los parametros de búsqueda
			</li>
			<li>
				Presione el botón "Buscar"
			</li>
			<li>
				Si la consulta arroja resultados es posible visualizar los detalles presionando el boton azul.
			</li>
        </div>

		<div class="divForm">
			<form class="form-horizontal" method="GET" action="#" id="formBuscar">
			<div class="row">
				<div class="col-md-10">

					  <div class="form-group">
					    <label for="nombre" class="col-sm-4 control-label">Por Folio</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="folio" id="folio" placeholder="">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="nombre" class="col-sm-4 control-label">Por Nombre</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="">
					    </div>
					  </div>




					<div class="form-group">
				    	<label  class="col-sm-4 control-label">Unidad Responsable</label>
				    		<div class="col-sm-8">
					      		<select  class="form-control select" id="ur" name="ur[]" multiple="true">
						      		<!--<option value="0">Todos</option>-->
						      		<!-- <option value="-1">*** Agregar ***</option> -->
								<?php 
									for ($a=0; $a < count($ID_UR); $a++) { ?>
										<option <?php echo (isset($info[0]['ID_UR']) && $info[0]['ID_UR'] == $ID_UR[$a]['ID']) ? 'selected': '';?> value="<?php echo $ID_UR[$a]['ID'];?>"><?php echo $ID_UR[$a]['ID'] . ' - ' . $ID_UR[$a]['NAME'];?></option>
									<?php } ?>
								?>
						      </select>
						  </div>
					</div>



					<div class="form-group">
				    	<label  class="col-sm-4 control-label">Fase de Proyecto</label>
				    		<div class="col-sm-8">
					      		<select  class="form-control select" id="fp" name="fp[]" multiple="true">
						      		<!--<option value="0">Todos</option>-->
						      		<!-- <option value="-1">*** Agregar ***</option> -->
								<?php 
									for ($f=0; $f < count($ID_FASE_PROYECTO); $f++) { ?>
										<option <?php echo (isset($info[0]['ID_UR']) && $info[0]['ID_UR'] == $ID_FASE_PROYECTO[$f]['ID']) ? 'selected': '';?> value="<?php echo $ID_FASE_PROYECTO[$f]['ID'];?>"><?php echo $ID_FASE_PROYECTO[$f]['ID'] . ' - ' . $ID_FASE_PROYECTO[$f]['NAME'];?></option>
									<?php } ?>
								?>
						      </select>
						  </div>
					</div>



					  <div class="form-group">
					    <label for="anio" class="col-sm-4 control-label">Por Año</label>
					    <div class="col-sm-8">

							<select id="anio" name="anio[]" class="form-control" multiple="multiple">
								<!-- <option value="0">Todos</option> -->
								<?php foreach ($anios as $key => $value):
									 foreach ($value as $k => $v){ ?>
										<option value="<?php echo $v;?>"><?php echo $v;?></option>
									<?php } 
								 endforeach ?>
							</select>

					    </div>
					  </div>

				</div>
				<div class="col-md-2">
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10 ">
					      <button type="submit" class="btn btn-success" >Buscar</button>
					    </div>
					  </div>
				</div>

			</div>
		</form>

		</div>

		<div id="resultado" class="divResultados">
			

		</div>


      </div>
     </div>
   </div>
  </div>
</div>

       

