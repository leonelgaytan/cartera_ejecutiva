<?php 
	function getSelect($str,$value){
		$arr = explode(',',$str);
		if(in_array($value, $arr)){
			return true;
		}else{
			return false;
		}
	}

?>

	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>

	<link rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/plugins/datepicker/css/datepicker.css">
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>  

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/generales.js"></script>

	<script type="text/javascript">var base_url = '<?php echo base_url();?>';</script>
	<script type="text/javascript">var idd = '<?php echo $idd;?>';</script>

	<?php if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){?>
		<script type="text/javascript">var lv = 0;</script>
	<?php }else{ ?>
		<script type="text/javascript">var lv = 1;</script>
	<?php } ?>

<!--
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css"/>
-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jQuery-Mask-Plugin/dist/jquery.mask.min.js"></script>  

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/captura.js?<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/multiselect/dist/js/multiselect.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/multiselect/css/style.css" />

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/captura.js?<?php echo time();?>"></script>


	<script type="text/javascript">
		   <?php if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capturista')){ ?>   	

	jQuery(document).ready(function($) {

		$("#formRegistrar :input").attr("disabled", true);

		/*
		$($('#formRegistrar').prop('elements')).each(function(){
			$('.help').hide();
            $(this).attr("disabled", true);
            //var value = $(this).val();
            var new_html = ('<div>' + value +  '</div>' )
            //$(this).replaceWith(new_html);
		});
		*/

   		});
	<?php } ?>

	</script>

<div class="row">
<div class="col-md-12">
    <div class="content">


    <?php if(isset($info[0]['ID_UR']) && strlen($info[0]['ID_UR']) > 0){ ?>
	    <script type="text/javascript">
	    	var varIDUR = <?php echo $info[0]['ID_UR'];?>;
			$( document ).ready(function() {
				selectSecundario('ID_UR_SEC',varIDUR,'<?php echo $info[0]['ID_UR_SEC'];?>');
			});
	    </script>
    <?php } ?>



    <?php if(isset($error)){?>
    	<center><h4><?php echo $error['message'];?></h4></center>
    <?php }else{?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <center><h4>
	      <?php if(isset($info[0]['ID_PROYECTO']) && $info[0]['ID_PROYECTO'] > 0){ ?>
	      	<?php echo $info[0]['NOMBRE_PROYECTO'];?>
	      <?php }else{ ?>
	      	Nuevo Proyecto
	      <?php } ?>
	  </h4></center>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"  aria-controls="collapseOne">
          1. Información General
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
		<form class="form-horizontal" id="formRegistrar" action="#">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

			<?php if($idd > 0){?>
				<input type="hidden" name="ID_PROYECTO" value="<?php echo (isset($info[0]['ID_PROYECTO'])) ? $info[0]['ID_PROYECTO'] : 0; ?>" />
			<?php } ?>

		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Año</label>
		    <div class="col-sm-9">

		    <?php 
		    	$anios1 = array();
				array_push($anios1,(date('Y')-3));
				array_push($anios1,(date('Y')-2));
				array_push($anios1,(date('Y')-1));
		    	array_push($anios1,date('Y'));
		    	array_push($anios1,(date('Y')+1));
		    ?>
	    	<select id="selAnios" name="ANIO" class="form-control required" <?php echo (isset($info[0]['FOLIO_PROYECTO'])) ? 'disabled' : ''; ?>>
	    		<option value="">--- Seleccione ---</option>
		      <?php for ($x=0; $x < count($anios1); $x++) { ?>
		      	<option <?php echo (isset($info[0]['ANIO']) && $info[0]['ANIO'] == $anios1[$x]) ? 'selected': '';?> value="<?php echo $anios1[$x];?>"><?php echo $anios1[$x];?></option>
		      <?php } ?>
	    	</select>



		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Fecha de Registro</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control  datepicker required" name="FEC_REGISTRO" value="<?php echo isset($info[0]['FEC_REGISTRO']) ? $info[0]['FEC_REGISTRO'] : '';?>" placeholder="yyyy-mm-dd">
		      <span class="help">Formato : <strong>dd/mm/yyyy</strong></span>
		    </div>
		  </div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Folio del proyecto</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required" id="FOLIO_PROYECTO" name="FOLIO_PROYECTO" value="<?php echo isset($info[0]['FOLIO_PROYECTO']) ? $info[0]['FOLIO_PROYECTO'] : '';?>" readonly>
		    </div>
		  </div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Versión</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required" name="VERSION" value="<?php echo isset($info[0]['VERSION']) ? $info[0]['VERSION'] : 0;?>" <?php echo (isset($info[0]['VERSION'])) ? '' : 'readonlyx'; ?> >
		    </div>
		  </div>


			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Tipo de Proyecto</label>
		    		<div class="col-sm-9">
					    <div class="input-group" id="ID_TIPO_PROYECTO_div">
					       <input type="text" class="form-control required" name="ID_TIPO_PROYECTO_input" id="ID_TIPO_PROYECTO_input" />
					      <a data-id="ID_TIPO_PROYECTO" href="#" class="input-group-addon hideInput">
					      <i class="glyphicon glyphicon-remove"></i>
					      </a>
					    </div>

			      		<select  class="form-control required select" id="ID_TIPO_PROYECTO" name="ID_TIPO_PROYECTO">
				      		<option value="">--- Seleccione ---</option>
				      		<!-- <option value="-1">*** Agregar ***</option> -->
						<?php 
							for ($a2=0; $a2 < count($ID_TIPO_PROYECTO); $a2++) { ?>
								<option <?php echo (isset($info[0]['ID_TIPO_PROYECTO']) && $info[0]['ID_TIPO_PROYECTO'] == $ID_TIPO_PROYECTO[$a2]['ID']) ? 'selected': '';?> value="<?php echo $ID_TIPO_PROYECTO[$a2]['ID'];?>"><?php echo $ID_TIPO_PROYECTO[$a2]['ID'] . ' - ' . $ID_TIPO_PROYECTO[$a2]['NAME'];?></option>
							<?php } ?>
						?>
				      </select>
					  <span id="ID_TIPO_PROYECTO_help" class="help-block"></span>
				  </div>
			</div>

		  <div class="form-group">
		    <center><label  class="control-label">Categoría</label></center>
		    <div class="col-sm-12">
				<div class="row">
				    <div class="col-sm-5">
				        <select style="font-size: 12px;" id="ID_CATEGORIA" name="ID_CATEGORIA_from[]" class="form-control" size="<?php echo count($ID_CATEGORIA);?>" multiple="multiple">
				        <?php for ($a1=0; $a1 < count($ID_CATEGORIA); $a1++) { ?>
				        	<?php if(isset($info[0]['ID_CATEGORIA'])){?>

				        		<?php if(!getSelect($info[0]['ID_CATEGORIA'],$ID_CATEGORIA[$a1]['ID'])){?>

							    <option value="<?php echo $ID_CATEGORIA[$a1]['ID'];?>"> 
							    <?php echo $ID_CATEGORIA[$a1]['NAME'];?>
							    </option>

				        		<?php } ?>

				        	<?php }else{ ?>
							    <option value="<?php echo $ID_CATEGORIA[$a1]['ID'];?>"> 
							    <?php echo $ID_CATEGORIA[$a1]['NAME'];?>
							    </option>
				        <?php } ?>
				        <?php } ?>

				        </select>
				    </div>
				    
		            <div class="col-sm-2">
		                <button type="button" id="ID_CATEGORIA_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
		                <button type="button" id="ID_CATEGORIA_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
		                <button type="button" id="ID_CATEGORIA_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
		                <button type="button" id="ID_CATEGORIA_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
		            </div>
				    
				    <div class="col-sm-5">
				        <select style="font-size: 12px;" name="ID_CATEGORIA_to[]" id="ID_CATEGORIA_to" class="form-control required" size="<?php echo count($ID_CATEGORIA);?>" multiple="multiple">

					        <?php for ($a1=0; $a1 < count($ID_CATEGORIA); $a1++) { ?>
					        	<?php if(isset($info[0]['ID_CATEGORIA'])){?>

					        		<?php if(getSelect($info[0]['ID_CATEGORIA'],$ID_CATEGORIA[$a1]['ID'])){?>

								    <option value="<?php echo $ID_CATEGORIA[$a1]['ID'];?>"> 
								    <?php echo $ID_CATEGORIA[$a1]['NAME'];?>
								    </option>

					        		<?php } ?>


					        <?php } ?>
					        <?php } ?>
				        </select>
				    </div>
				</div>

		    </div>
		  </div>


			<!--

			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Categoría</label>
		    		<div class="col-sm-9">
					    <div class="input-group" id="ID_CATEGORIA_div">
					       <input type="text" class="form-control required" name="ID_CATEGORIA_input" id="ID_CATEGORIA_input" />
					      <a data-id="ID_CATEGORIA" href="#" class="input-group-addon hideInput">
					      <i class="glyphicon glyphicon-remove"></i>
					      </a>
					    </div>

			      		<select  class="form-control required select" id="ID_CATEGORIA" name="ID_CATEGORIA">
				      		<option value="">--- Seleccione ---</option>
						<?php 
							for ($a1=0; $a1 < count($ID_CATEGORIA); $a1++) { ?>
								<option <?php echo (isset($info[0]['ID_CATEGORIA']) && $info[0]['ID_CATEGORIA'] == $ID_CATEGORIA[$a1]['ID']) ? 'selected': '';?> value="<?php echo $ID_CATEGORIA[$a1]['ID'];?>"><?php echo $ID_CATEGORIA[$a1]['ID'] . ' - ' . $ID_CATEGORIA[$a1]['NAME'];?></option>
							<?php } ?>
						?>
				      </select>
					  <span id="ID_CATEGORIA_help" class="help-block"></span>
				  </div>
			</div>
			-->

			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Unidad Responsable</label>
		    		<div class="col-sm-9">
					    <div class="input-group" id="ID_UR_div">
					       <input type="text" class="form-control required" name="ID_UR_input" id="ID_UR_input" />
					      <a data-id="ID_UR" href="#" class="input-group-addon hideInput">
					      <i class="glyphicon glyphicon-remove"></i>
					      </a>
					    </div>

			      		<select  class="form-control required select" id="ID_UR" name="ID_UR">
				      		<option value="">--- Seleccione ---</option>
				      		<!-- <option value="-1">*** Agregar ***</option> -->
						<?php 
							for ($a=0; $a < count($ID_UR); $a++) { ?>
								<option <?php echo (isset($info[0]['ID_UR']) && $info[0]['ID_UR'] == $ID_UR[$a]['ID']) ? 'selected': '';?> value="<?php echo $ID_UR[$a]['ID'];?>"><?php echo $ID_UR[$a]['ID'] . ' - ' . $ID_UR[$a]['NAME'];?></option>
							<?php } ?>
						?>
				      </select>
					  <span id="ID_UR_help" class="help-block"></span>
				  </div>
			</div>


			<div class="form-group" id="div_ID_UR_SEC">
		    	<label  class="col-sm-3 control-label">Unidad Responsable Secundaria</label>
		    		<div class="col-sm-9">
					    <div class="input-group" id="ID_UR_SEC_div">
					       <input type="text" class="form-control" name="ID_UR_SEC_input" id="ID_UR_SEC_input" />
					      <a data-id="ID_UR_SEC" href="#" class="input-group-addon hideInput">
					      <i class="glyphicon glyphicon-remove"></i>
					      </a>
					    </div>

			      		<select  class="form-control select" id="ID_UR_SEC" name="ID_UR_SEC">
				      		<option value="">--- Seleccione ---</option>
				      		<!--
				      		<!-- <option value="-1">*** Agregar ***</option> -->
						<?php 
							for ($a=0; $a < count($ID_UR_SEC); $a++) { ?>
								<option	value="<?php echo $ID_UR_SEC[$a]['ID'];?>"><?php echo $ID_UR_SEC[$a]['ID'] . ' - ' . $ID_UR_SEC[$a]['NAME'];?></option>
							<?php } ?>
						?>
						-->
				      </select>
					  <span id="ID_UR_SEC_help" class="help-block"></span>
				  </div>
			</div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Oficio de Salida</label>
		    <div class="col-sm-9">
		      <input type="number" class="form-control" name="OFICIO_SALIDA" value="<?php echo isset($info[0]['OFICIO_SALIDA']) ? $info[0]['OFICIO_SALIDA'] : '';?>">
		    </div>
		  </div>





		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Nombre del Proyecto</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required" name="NOMBRE_PROYECTO" id="NOMBRE_PROYECTO" value="<?php echo isset($info[0]['NOMBRE_PROYECTO']) ? $info[0]['NOMBRE_PROYECTO'] : '';?>">
		    </div>
		  </div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Fecha Linea Base Inicio</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required datepicker" name="FEC_LINEA_BASE_INICIO" value="<?php echo isset($info[0]['FEC_LINEA_BASE_INICIO']) ? $info[0]['FEC_LINEA_BASE_INICIO'] : '';?>" >
		      <span class="help">Formato : <strong>dd/mm/yyyy</strong></span>
		    </div>
		  </div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Fecha Linea Base Fin</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required datepicker" name="FEC_LINEA_BASE_FIN" value="<?php echo isset($info[0]['FEC_LINEA_BASE_FIN']) ? $info[0]['FEC_LINEA_BASE_FIN'] : '';?>" >
		      <span class="help">Formato : <strong>dd/mm/yyyy</strong></span>
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Plurianualidad</label>
		    <div class="col-sm-9">
				<select class="form-control required" name="PLURIANUALIDAD">
				  <option value="">--- SELECCIONAR ---</option>
				  <option <?php echo (isset($info[0]['PLURIANUALIDAD']) && $info[0]['PLURIANUALIDAD'] == 'SI') ? 'selected': '';?> value="SI">SI</option>
				  <option <?php echo (isset($info[0]['PLURIANUALIDAD']) && $info[0]['PLURIANUALIDAD'] == 'NO') ? 'selected': '';?> value="NO">NO</option>
				</select>
		    </div>
		  </div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Presupuesto Estimado</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required" id="PRESUPUESTO_ESTIMADO" name="PRESUPUESTO_ESTIMADO" value="<?php echo isset($info[0]['PRESUPUESTO_ESTIMADO']) ? $info[0]['PRESUPUESTO_ESTIMADO'] : '';?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Presupuesto Asignado</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="PRESUPUESTO_ASIGNADO" name="PRESUPUESTO_ASIGNADO" value="<?php echo isset($info[0]['PRESUPUESTO_ASIGNADO']) ? $info[0]['PRESUPUESTO_ASIGNADO'] : '';?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Nombre lider del proyecto</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required" name="NOMBRE_LIDER_PROYECTO" value="<?php echo isset($info[0]['NOMBRE_LIDER_PROYECTO']) ? $info[0]['NOMBRE_LIDER_PROYECTO'] : '';?>">
		    </div>
		  </div>



			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Fase de Proyecto</label>
		    		<div class="col-sm-9">
					    <div class="input-group" id="ID_FASE_PROYECTO_div">
					       <input type="text" class="form-control required" name="ID_FASE_PROYECTO_input" id="ID_FASE_PROYECTO_input" />
					      <a data-id="ID_FASE_PROYECTO" href="#" class="input-group-addon hideInput">
					      <i class="glyphicon glyphicon-remove"></i>
					      </a>
					    </div>

			      		<select  class="form-control required select" id="ID_FASE_PROYECTO" name="ID_FASE_PROYECTO">
				      		<option value="">--- Seleccione ---</option>
				      		<!-- <option value="-1">*** Agregar ***</option> -->
						<?php 
							for ($c=0; $c < count($ID_FASE_PROYECTO); $c++) { ?>
								<option <?php echo (isset($info[0]['ID_FASE_PROYECTO']) && $info[0]['ID_FASE_PROYECTO'] == $ID_FASE_PROYECTO[$c]['ID']) ? 'selected': '';?>	value="<?php echo $ID_FASE_PROYECTO[$c]['ID'];?>"><?php echo $ID_FASE_PROYECTO[$c]['ID'] . ' - ' .  $ID_FASE_PROYECTO[$c]['NAME'];?></option>
							<?php } ?>
						?>
				      </select>
					  <span id="ID_FASE_PROYECTO_help" class="help-block"></span>
				  </div>
			</div>




		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Porcentaje Fase</label>
		    <div class="col-sm-9">
		      <input type="number" min="0" max="100" class="form-control required" name="PORCENTAJE_FASE" value="<?php echo isset($info[0]['PORCENTAJE_FASE']) ? $info[0]['PORCENTAJE_FASE'] : '';?>">
		    </div>
		  </div>

			<hr />



		  <div class="form-group">
		    <center><label  class="control-label">Dominio Tecnológico</label></center>
		    <div class="col-sm-12">
				<div class="row">
				    <div class="col-sm-5">
				        <select style="font-size: 12px;" id="ID_DOMINIO_TEC" name="ID_DOMINIO_TEC_from[]" class="form-control" size="<?php echo count($ID_DOMINIO_TEC);?>" multiple="multiple">
				        <?php for ($d=0; $d < count($ID_DOMINIO_TEC); $d++) { ?>
				        	<?php if(isset($info[0]['ID_DOMINIO_TEC'])){?>

				        		<?php if(!getSelect($info[0]['ID_DOMINIO_TEC'],$ID_DOMINIO_TEC[$d]['ID'])){?>

							    <option value="<?php echo $ID_DOMINIO_TEC[$d]['ID'];?>"> 
							    <?php echo $ID_DOMINIO_TEC[$d]['NAME'];?>
							    </option>

				        		<?php } ?>

				        	<?php }else{ ?>
							    <option value="<?php echo $ID_DOMINIO_TEC[$d]['ID'];?>"> 
							    <?php echo $ID_DOMINIO_TEC[$d]['NAME'];?>
							    </option>
				        <?php } ?>
				        <?php } ?>

				        </select>
				    </div>
				    
		            <div class="col-sm-2">
		                <button type="button" id="ID_DOMINIO_TEC_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
		                <button type="button" id="ID_DOMINIO_TEC_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
		                <button type="button" id="ID_DOMINIO_TEC_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
		                <button type="button" id="ID_DOMINIO_TEC_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
		            </div>
				    
				    <div class="col-sm-5">
				        <select style="font-size: 12px;" name="ID_DOMINIO_TEC_to[]" id="ID_DOMINIO_TEC_to" class="form-control required" size="<?php echo count($ID_DOMINIO_TEC);?>" multiple="multiple">

					        <?php for ($d=0; $d < count($ID_DOMINIO_TEC); $d++) { ?>
					        	<?php if(isset($info[0]['ID_DOMINIO_TEC'])){?>

					        		<?php if(getSelect($info[0]['ID_DOMINIO_TEC'],$ID_DOMINIO_TEC[$d]['ID'])){?>

								    <option value="<?php echo $ID_DOMINIO_TEC[$d]['ID'];?>"> 
								    <?php echo $ID_DOMINIO_TEC[$d]['NAME'];?>
								    </option>

					        		<?php } ?>


					        <?php } ?>
					        <?php } ?>
				        </select>
				    </div>
				</div>

		    </div>
		  </div>


			<hr />


		  <div class="form-group">
		    <center><label  class="control-label">PGCM</label></center>
		    <div class="col-sm-12 ">
				<div class="row">
				    <div class="col-sm-5">
				        <select style="font-size: 12px;" id="ID_PGCM" name="ID_PGCM_from[]" class="form-control" size="<?php echo count($ID_PGCM);?>" multiple="multiple">
				        <?php for ($e=0; $e < count($ID_PGCM); $e++) { ?>
				        	<?php if(isset($info[0]['ID_PGCM'])){?>

				        		<?php if(!getSelect($info[0]['ID_PGCM'],$ID_PGCM[$e]['ID'])){?>

							    <option value="<?php echo $ID_PGCM[$e]['ID'];?>"> 
							    <?php echo $ID_PGCM[$e]['ID'] . ' - ' . $ID_PGCM[$e]['NAME'];?>
							    </option>

				        		<?php } ?>

				        	<?php }else{ ?>
							    <option value="<?php echo $ID_PGCM[$e]['ID'];?>"> 
							    <?php echo $ID_PGCM[$e]['ID'] . ' - ' . $ID_PGCM[$e]['NAME'];?>
							    </option>
				        <?php } ?>
				        <?php } ?>

				        </select>
				    </div>
				    
		            <div class="col-sm-2">
		                <button type="button" id="ID_PGCM_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
		                <button type="button" id="ID_PGCM_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
		                <button type="button" id="ID_PGCM_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
		                <button type="button" id="ID_PGCM_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
		            </div>
				    
				    <div class="col-sm-5">
				        <select style="font-size: 12px;" name="ID_PGCM_to[]" id="ID_PGCM_to" class="form-control required" size="<?php echo count($ID_PGCM);?>" multiple="multiple">

					        <?php for ($e=0; $e < count($ID_PGCM); $e++) { ?>
					        	<?php if(isset($info[0]['ID_PGCM'])){?>

					        		<?php if(getSelect($info[0]['ID_PGCM'],$ID_PGCM[$e]['ID'])){?>

								    <option value="<?php echo $ID_PGCM[$e]['ID'];?>"> 
								    <?php echo $ID_PGCM[$e]['ID'] . ' - ' . $ID_PGCM[$e]['NAME'];?>
								    </option>

					        		<?php } ?>


					        <?php } ?>
					        <?php } ?>
				        </select>
				    </div>
				</div>

		    </div>
		  </div>



			<hr />


		  <div class="form-group">
		    <center><label  class="control-label">EDN</label></center>
		    <div class="col-sm-12 ">
				<div class="row">
				    <div class="col-sm-5">
				        <select style="font-size: 12px;" id="ID_EDN" name="ID_EDN_from[]" class="form-control" size="<?php echo count($ID_EDN);?>" multiple="multiple">
				        <?php for ($f=0; $f < count($ID_EDN); $f++) { ?>
				        	<?php if(isset($info[0]['ID_EDN'])){?>

				        		<?php if(!getSelect($info[0]['ID_EDN'],$ID_EDN[$f]['ID'])){?>

							    <option value="<?php echo $ID_EDN[$f]['ID'];?>"> 
							    <?php echo $ID_EDN[$f]['ID'] . ' - ' . $ID_EDN[$f]['NAME'];?>
							    </option>

				        		<?php } ?>

				        	<?php }else{ ?>
							    <option value="<?php echo $ID_EDN[$f]['ID'];?>"> 
							    <?php echo $ID_EDN[$f]['ID'] . ' - ' . $ID_EDN[$f]['NAME'];?>
							    </option>
				        <?php } ?>
				        <?php } ?>

				        </select>
				    </div>
				    
		            <div class="col-sm-2">
		                <button type="button" id="ID_EDN_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
		                <button type="button" id="ID_EDN_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
		                <button type="button" id="ID_EDN_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
		                <button type="button" id="ID_EDN_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
		            </div>
				    
				    <div class="col-sm-5">
				        <select style="font-size: 12px;" name="ID_EDN_to[]" id="ID_EDN_to" class="form-control required" size="<?php echo count($ID_EDN);?>" multiple="multiple">

					        <?php for ($f=0; $f < count($ID_EDN); $f++) { ?>
					        	<?php if(isset($info[0]['ID_EDN'])){?>

					        		<?php if(getSelect($info[0]['ID_EDN'],$ID_EDN[$f]['ID'])){?>

								    <option value="<?php echo $ID_EDN[$f]['ID'];?>"> 
								    <?php echo $ID_EDN[$f]['ID'] . ' - ' . $ID_EDN[$f]['NAME'];?>
								    </option>

					        		<?php } ?>


					        <?php } ?>
					        <?php } ?>
				        </select>
				    </div>
				</div>

		    </div>
		  </div>



			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Elaboró</label>
		    		<div class="col-sm-2">
			      		<select  class="form-control required select" id="ID_TITULO" name="ID_TITULO_ELABORO">
				      		<option value="">--- Seleccione ---</option>
						<?php 
							for ($g=0; $g < count($ID_TITULO); $g++) { ?>
								<option <?php echo (isset($info[0]['ID_TITULO_ELABORO']) && $info[0]['ID_TITULO_ELABORO'] == $ID_TITULO[$g]['ID']) ? 'selected': '';?>	value="<?php echo $ID_TITULO[$g]['ID'];?>"><?php echo $ID_TITULO[$g]['NAME'];?></option>
						<?php } ?>
						?>
				      </select>
					  <span id="ID_TITULO_help" class="help-block"></span>
				  </div>
		    <div class="col-sm-7">
		      <input type="text" class="form-control required" name="NOMBRE_ELABORO" value="<?php echo isset($info[0]['NOMBRE_ELABORO']) ? $info[0]['NOMBRE_ELABORO'] : '';?>">
		    </div>

			</div>




		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Cargo elaboró</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required" name="CARGO_ELABORO" value="<?php echo isset($info[0]['CARGO_ELABORO']) ? $info[0]['CARGO_ELABORO'] : '';?>">
		    </div>
		  </div>


			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Revisó</label>
		    		<div class="col-sm-2">

			      		<select  class="form-control required select" id="ID_TITULO_REVISO" name="ID_TITULO_REVISO">
				      		<option value="">--- Seleccione ---</option>
						<?php 
							for ($h=0; $h < count($ID_TITULO); $h++) { ?>
								<option <?php echo (isset($info[0]['ID_TITULO_REVISO']) && $info[0]['ID_TITULO_REVISO'] == $ID_TITULO[$h]['ID']) ? 'selected': '';?>	value="<?php echo $ID_TITULO[$h]['ID'];?>"><?php echo $ID_TITULO[$h]['NAME'];?></option>
							<?php } ?>
						?>
				      </select>
					  <span id="ID_TITULO_REVISO_help" class="help-block"></span>
				  </div>
		    <div class="col-sm-7">
		      <input type="text" class="form-control required" name="NOMBRE_REVISO" value="<?php echo isset($info[0]['NOMBRE_REVISO']) ? $info[0]['NOMBRE_REVISO'] : '';?>">
		    </div>


			</div>



		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Cargo revisó</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required" name="CARGO_REVISO" value="<?php echo isset($info[0]['CARGO_REVISO']) ? $info[0]['CARGO_REVISO'] : '';?>">
		    </div>
		  </div>



			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Aprobó</label>
		    		<div class="col-sm-2">

			      		<select  class="form-control required select" id="ID_TITULO_APROBO" name="ID_TITULO_APROBO">
				      		<option value="">--- Seleccione ---</option>
						<?php 
							for ($h=0; $h < count($ID_TITULO); $h++) { ?>
								<option <?php echo (isset($info[0]['ID_TITULO_APROBO']) && $info[0]['ID_TITULO_APROBO'] == $ID_TITULO[$h]['ID']) ? 'selected': '';?>	value="<?php echo $ID_TITULO[$h]['ID'];?>"><?php echo $ID_TITULO[$h]['NAME'];?></option>
							<?php } ?>
						?>
				      </select>
					  <span id="ID_TITULO_APROBO_help" class="help-block"></span>
				  </div>

		    <div class="col-sm-7">
		      <input type="text" class="form-control required" name="NOMBRE_APROBO" value="<?php echo isset($info[0]['NOMBRE_APROBO']) ? $info[0]['NOMBRE_APROBO'] : '';?>">
		    </div>

			</div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Cargo Aprobó</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control required" name="CARGO_APROBO" value="<?php echo isset($info[0]['CARGO_APROBO']) ? $info[0]['CARGO_APROBO'] : '';?>">
		    </div>
		  </div>



		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Oficio envio DPNTIC</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="OFICIO_ENVIO_DPNTIC" value="<?php echo isset($info[0]['OFICIO_ENVIO_DPNTIC']) ? $info[0]['OFICIO_ENVIO_DPNTIC'] : '';?>">
		    </div>

		    <div class="col-sm-4">
		      <input type="file" class="form-control" name="userfile" >
		    </div>

		    <?php if(isset($info[0]['DOCUMENTO']) && strlen($info[0]['DOCUMENTO']) > 0){?>
			    <div class="col-sm-1">
			    	<a target="_blank" href="<?php echo base_url();?>index.php/captura/pdf/<?php echo $info[0]['ID_PROYECTO'];?>/0" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-cloud-download"></i></a>
			    </div>
		    <?php } ?>

		  </div>




		  <div class="form-group">
			<center><strong><h4 id="NomExist" class="bg-danger">
				<br />
				El nombre del proyecto escrito ya existe en la base de datos con el folio <span id="FolExist"></span> del año <span id="AniExist"></span>
				<br />
				Favor de revisar los datos antes de guardar
			</h4>
			</center></strong>
			<?php if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){?>
			    <div >
			      <center><button type="submit" class="btn btn-primary">Guardar</button></center>
			    </div>
			<?php } ?>

		  </div>
		</form>

      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          2. Formatos
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
	      <?php if(isset($info[0]['ID_PROYECTO']) && $info[0]['ID_PROYECTO'] > 0){ ?>

			<center><h4 class="rowDivision">Formatos registrados</h4></center>
		      <table class="table table-striped table-bordered">
		      	<thead>
		      		<tr>
		      			<th>Tipo Oficio</th>
		      			<th>Formato</th>
		      			<th>Descripción Oficio</th>
		      			<th>Fecha de Registro</th>
		      			<th>Volante</th>
		      			<th>Documento</th>
					<?php if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){?>
		      			<th></th>
		      		<?php } ?>
		      		</tr>
		      	</thead>
		      	<tbody id="tblFormatos">
		      		
		      	</tbody>
		      </table>
		<?php if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){?>

		      <hr />
			<center><h4 class="rowDivision">Registrar Formato</h4></center>


		<form class="form-horizontal" id="formRegistrarFormato" action="#">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input type="hidden" name="ID_PROYECTO" value="<?php echo $info[0]['ID_PROYECTO']; ?>" />
			<input type="hidden" id="ID_DETALLE_OFICIO" name="ID_DETALLE_OFICIO" value="0" />


			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Tipo Oficio</label>
		    		<div class="col-sm-9">

			      		<select  class="form-control required" name="ID_TIPO_OFICIO" id="ID_TIPO_OFICIO" >
				      		<option value="">--- Seleccione ---</option>
						<?php 
							for ($to=0; $to < count($ID_TIPO_OFICIO); $to++) { ?>
								<option <?php echo (isset($info[0]['ID_OFICIO']) && $info[0]['ID_OFICIO'] == $ID_TIPO_OFICIO[$to]['ID']) ? 'selected': '';?>	value="<?php echo $ID_TIPO_OFICIO[$to]['ID'];?>"><?php echo $ID_TIPO_OFICIO[$to]['NAME'];?></option>
							<?php } ?>
						?>
				      </select>
					  <span id="ID_TIPO_OFICIO_help" class="help-block"></span>
				  </div>
			</div>


			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Formato</label>
		    		<div class="col-sm-9">

			      		<select  class="form-control required" id="ID_FORMATO" name="ID_FORMATO" >
				      		<option value="">--- Seleccione ---</option>
				      </select>
					  <span id="ID_FORMATO_help" class="help-block"></span>
				  </div>
			</div>


			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Descripción del Oficio</label>
		    		<div class="col-sm-9">
		    		<textarea  name="DESCRIP_OFICIO" class="form-control"></textarea>
		    		</div>
		    </div>


			  <div class="form-group">
			    <label  class="col-sm-3 control-label">Fecha de Registro del Oficio</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control datepicker required" name="FEC_OFICIO_REG">
		      	  <span class="help">Formato : <strong>dd/mm/yyyy</strong></span>
			    </div>
			  </div>

			  <div class="form-group">
			    <label  class="col-sm-3 control-label">Volante</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" name="VOLANTE">
			    </div>
			  </div>

			  <div class="form-group">
			    <label  class="col-sm-3 control-label">Documento</label>
			    <div class="col-sm-9">
			      <input type="file" class="form-control" name="userfile">
			    </div>
			  </div>



		  <div class="form-group">
		    <div >
		      <center><button type="submit" class="btn btn-primary">Guardar Formato</button></center>
		    </div>
		  </div>

		</form>
		<?php } ?>

	      <?php }else{ ?>
	      	<center>Primero guarde la información general para acceder a este paso.</center>
	      <?php } ?>
      </div>
    </div>
  </div>


  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          3. Actividades
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
      <?php if(isset($info[0]['ID_PROYECTO']) && $info[0]['ID_PROYECTO'] > 0){ ?>

      <script type="text/javascript">
      	fillActividades();
      	fillFormatos();
      </script>
			<center><h4 class="rowDivision">Formatos registrados</h4></center>
		      <table class="table table-striped table-bordered">
		      	<thead>
		      		<tr>
		      			<th>Actividad</th>
		      			<th>Fecha inicio (planeada)</th>
		      			<th>Fecha fin (planeada)</th>
		      			<th>Porcentaje planeado</th>
		      			<th>Fecha inicio (real)</th>
		      			<th>Fecha fin (real)</th>
		      			<th>Porcentaje real</th>
					<?php if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){?>
		      			<th></th>
		      		<?php } ?>
		      		</tr>
		      	</thead>
		      	<tbody id="tblActividades">
		      		
		      	</tbody>
		      </table>
		<?php if($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('capturista')){?>

      <hr />
		<center><h4 class="rowDivision">Registrar Actividad</h4></center>
		<form class="form-horizontal" id="formRegistrarActividad" action="#">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

			<input type="hidden" name="ID_PROYECTO" value="<?php echo $info[0]['ID_PROYECTO']; ?>" />
			<input type="hidden" id="ID_DETALLE_ACTIVIDAD" name="ID_DETALLE_ACTIVIDAD" value="0" />

			<div class="form-group">
		    	<label  class="col-sm-3 control-label">Actividades</label>
		    		<div class="col-sm-9">

			      		<select  class="form-control required select" id="ID_ACTIVIDAD" name="ID_ACTIVIDAD">
				      		<option value="">--- Seleccione ---</option>
						<?php 
							for ($h1=0; $h1 < count($ID_ACTIVIDAD); $h1++) { ?>
								<option <?php echo (isset($info[0]['ID_ACTIVIDAD']) && $info[0]['ID_ACTIVIDAD'] == $ID_ACTIVIDAD[$h1]['ID']) ? 'selected': '';?>	value="<?php echo $ID_ACTIVIDAD[$h1]['ID'];?>"><?php echo $ID_ACTIVIDAD[$h1]['NAME'];?></option>
							<?php } ?>
						?>
				      </select>
					  <span id="ID_ACTIVIDAD_help" class="help-block"></span>
				  </div>
			</div>



		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Fecha Inicio Planeada</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control datepicker" name="FEC_INI_PLANEADA" value="<?php echo isset($info[0]['FEC_INI_PLANEADA']) ? $info[0]['FEC_INI_PLANEADA'] : '';?>">
		      	  <span class="help">Formato : <strong>dd/mm/yyyy</strong></span>
		    </div>
		  </div>



		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Fecha Fin Planeada</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control datepicker" name="FEC_FIN_PLANEADA" value="<?php echo isset($info[0]['FEC_FIN_PLANEADA']) ? $info[0]['FEC_FIN_PLANEADA'] : '';?>">
		      	  <span class="help">Formato : <strong>dd/mm/yyyy</strong></span>
		    </div>
		  </div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Porcentaje Planeado</label>
		    <div class="col-sm-9">
		      <input type="number" min="0" max="100" class="form-control" name="PORCENTAJE_PLANEADO" value="<?php echo isset($info[0]['PORCENTAJE_PLANEADO']) ? $info[0]['PORCENTAJE_PLANEADO'] : '';?>">
		    </div>
		  </div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Fecha Inicio Real</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control datepicker" name="FEC_INI_REAL" value="<?php echo isset($info[0]['FEC_INI_REAL']) ? $info[0]['FEC_INI_REAL'] : '';?>" >
		      	  <span class="help">Formato : <strong>dd/mm/yyyy</strong></span>
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Fecha Fin Real</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control datepicker" name="FEC_FIN_REAL" value="<?php echo isset($info[0]['FEC_FIN_REAL']) ? $info[0]['FEC_FIN_REAL'] : '';?>" >
		      	  <span class="help">Formato : <strong>dd/mm/yyyy</strong></span>
		    </div>
		  </div>


		  <div class="form-group">
		    <label  class="col-sm-3 control-label">Porcentaje Real</label>
		    <div class="col-sm-9">
		      <input type="number" min="0" max="100" class="form-control" name="PORCENTAJE_AVANCE" value="<?php echo isset($info[0]['PORCENTAJE_AVANCE']) ? $info[0]['PORCENTAJE_AVANCE'] : '';?>">
		    </div>
		  </div>


		  <div class="form-group">
		    <div>
		      <center><button type="submit" class="btn btn-primary">Guardar Actividad</button></center>
		    </div>
		  </div>

		</form>
		<?php } ?>

      <?php }else{ ?>
      	<center>Primero guarde la información general para acceder a este paso.</center>
      <?php } ?>
      </div>
    </div>
  </div>


  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          4. Responsables
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
      		<a class="btn btn-success btnResponsables" style="float: right;">Asignar</a><br />
      		<center><h3>Responsables asignados</h3></center>
      		<table class="table table-striped" id=="tblAsignados">
      			<thead>
	      			<tr>
	      				<th>NOMBRE</th>
	      				<th>CARGO</th>
	      				<th>TELÉFONO</th>
	      				<th>EXTENSIÓN</th>
	      				<th>CORREO</th>
	      			</tr>
      			</thead>
        	<tbody id="asignados">
        		<tr>
        			<td colspan="4"><center>NO SE HAN REGISTRADO RESPONSABLES</center></td>
        		</tr>
        	</tbody>
      		</table>
      </div>
    </div>
   </div>
</div>



	<?php } ?>


   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Asignar Responsable</h4>
      </div>
      <div class="modal-body">

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tabResp" aria-controls="tabResp" role="tab" data-toggle="tab">Seleccionar</a></li>
    <!--
    <li role="presentation"><a href="#tabregistrar" aria-controls="tabregistrar" role="tab" data-toggle="tab">Registrar</a></li>
    -->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tabResp">
    	
      
        <table id="tblResponsables" class="table" style="font-size: 13px;">
        	<thead>
      			<tr>
      				<th>NOMBRE</th>
      				<th>TELÉFONO</th>
	      			<th>EXTENSIÓN</th>
      				<th>CORREO</th>
      			</tr>
        	</thead>
        	<tbody id="responsables">
        	</tbody>
        </table>

    </div>
    <div role="tabpanel" class="tab-pane" id="tabregistrar">
		    	
		<form id="formResponables">

		  <div class="form-group">
		    <label for="ID_TITULO">TÍTULO</label>
	      		<select  class="form-control required select" id="ID_TITULO" name="ID_TITULO_ELABORO">
		      		<option value="">--- Seleccione ---</option>
				<?php 
					for ($g=0; $g < count($ID_TITULO); $g++) { ?>
						<option <?php echo (isset($info[0]['ID_TITULO_ELABORO']) && $info[0]['ID_TITULO_ELABORO'] == $ID_TITULO[$g]['ID']) ? 'selected': '';?>	value="<?php echo $ID_TITULO[$g]['ID'];?>"><?php echo $ID_TITULO[$g]['NAME'];?></option>
				<?php } ?>
				?>
		      </select>
		  </div>

		  <div class="form-group">
		    <label for="NOMBRE_RESPONSABLE">NOMBRE</label>
		    <input type="text" class="form-control" id="NOMBRE_RESPONSABLE" name="NOMBRE_RESPONSABLE">
		  </div>


		  <div class="form-group">
		    <label for="CARGO_RESPONSABLE">CARGO</label>
		    <textarea class="form-control" id="CARGO_RESPONSABLE" name="CARGO_RESPONSABLE"></textarea>
		  </div>

		  <div class="form-group">
		    <label for="TEL_RESPONSABLE">TELÉFONO</label>
		    <input type="text" class="form-control" id="TEL_RESPONSABLE" name="TEL_RESPONSABLE">
		  </div>

		  <div class="form-group">
		    <label for="EXT_RESPONSABLE">EXT</label>
		    <input type="text" class="form-control" id="EXT_RESPONSABLE" name="EXT_RESPONSABLE">
		  </div>

		  <div class="form-group">
		    <label for="EXT1_RESPONSABLE">EXT</label>
		    <input type="text" class="form-control" id="EXT1_RESPONSABLE" name="EXT1_RESPONSABLE">
		  </div>

		  <hr/>
		  <button type="submit" class="btn btn-default">GUARDAR</button>
		</form>


    </div>
  </div>

</div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Guardar</button> -->
      </div>
    </div>
  </div>
</div>

</div>