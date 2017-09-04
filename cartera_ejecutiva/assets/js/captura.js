	var cbos = ['ID_TIPO_PROYECTO','ID_CATEGORIA','ID_UR','ID_UR_SEC','ID_FASE_PROYECTO','ID_DOMINIO_TEC','ID_PGCM','ID_EDN','ID_TITULO_ELABORO','ID_TITULO_REVISO','ID_TITULO_APROBO','ID_FORMATO'];
	var did = idd;
	var myToast;
	var sheepItForm = {};
	var FolExist = 0;
	var AniExist = 0;

jQuery(document).ready(function($) {
		getResponsables(idd,2);

		$('#asignados').on('click', 'a.btnEliminarResponsable', function(e) {
				e.stopPropagation();

				var r = confirm("SE ELIMINARÁ EL RESPONSABLE DEL PROYECTO ACTUAL!");
				if (r == true) {

			        $.ajax({
			                data:  {'ID_PROYECTO' : idd,'ID_RESPONSABLE' : $(this).data('id')},
			                url:   base_url + 'index.php/captura/eliminaResponsable',
			                type:  'GET',
			                beforeSend : function(){
								showBlock("#asignados",'Eliminando...');
			                },
			                success:  function (response) {
			                	if(response.success == 1){
			                		// Cerramos el modal
			                		// Actualizamos los asignados
			                		getResponsables(idd,2);
			                	}else{
			                		alert('OCURRIO UN ERROR AL INTENTAR ASIGNAR EL RESPONSABLE');
			                	}
			                }
			        });
				}


		});

		$('#responsables').on('click', 'a.btnAsignar', function(e) {
				e.stopPropagation();
		        $.ajax({
		                data:  {'ID_PROYECTO' : idd,'ID_RESPONSABLE' : $(this).data('id')},
		                url:   base_url + 'index.php/captura/asignaResponsable',
		                type:  'POST',
		                beforeSend : function(){
							showBlock("#responsables",'Guardando...');
		                },
		                success:  function (response) {
		                	if(response.success == 1){
		                		// Cerramos el modal
		                		$("#myModal").modal('hide');
		                		// Actualizamos los asignados
		                		getResponsables(idd,2);
		                	}else{
		                		alert('OCURRIO UN ERROR AL INTENTAR ASIGNAR EL RESPONSABLE');
		                	}
		                }
		        });


		});

		$(document).on('click', 'a.btnResponsables', function() {
			getResponsables();
		});


	$('#ID_DOMINIO_TEC').multiselect();

	$('#NomExist').hide();
	$("#NOMBRE_PROYECTO").focusout(function() {
		np = $("#NOMBRE_PROYECTO").val();
		if(np.length > 0){
			$('#NomExist').hide();
	        $.ajax({
	                data:  {'NOMBRE_PROYECTO' : np},
	                url:   base_url + 'index.php/captura/existeProyecto',
	                type:  'POST',
	                success:  function (response) {
						if (typeof response[0].ID_PROYECTO !== 'undefined') {
							FolExist = response[0].FOLIO_PROYECTO;
							AniExist = response[0].ANIO;
						}
	                }
	        });

		}
	  });


	  $('.datepicker').mask('00/00/0000',{placeholder: "__/__/____"});
  		$('#PRESUPUESTO_ESTIMADO,#PRESUPUESTO_ASIGNADO').mask('000,000,000,000.00', {reverse: true});


	 	$('#ID_DOMINIO_TEC,#ID_PGCM,#ID_EDN,#ID_CATEGORIA').multiselect({
			keepRenderingSort : true
	 	});


		hideInputs();
		$('#div_ID_UR_SEC').hide();


		$.validator.setDefaults({
		    highlight: function(element) {
		        $(element).closest('.form-group').addClass('has-error');
		    },
		    unhighlight: function(element) {
		        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		    },
		    errorPlacement: function() {
			    return true;
			}
		});
		hideDivs();
		jQuery( ".select" ).change(function() {
			sID = $(this).attr("id");
			val = $( "#" + sID + " option:selected" ).val();
			if(val == -1){
				hideSelect(sID);
				showDiv(sID);
			}

		});


		jQuery("#ID_TIPO_OFICIO").change(function() {

			val = $(this).val();
			if(!val == ''){
				fillSelectFormatos(val);
			}
		});


		jQuery( "#ID_UR" ).change(function() {
			val = $( "#ID_UR option:selected" ).val();
			if(!val == ''){
				selectSecundario('ID_UR_SEC',val);
			}
			/*
			else{
		        $('#div_ID_UR_SEC').hide();
			}
			*/
		});

		jQuery( "#selAnios" ).change(function() {
			if(idd == 0){
				val = $( "#selAnios option:selected" ).val();
				if(val > 0){
			        $.ajax({
			                data:  {'year' : val},
			                url:   base_url + 'index.php/captura/generaFolioAjax',
						    cache: false,
			                type:  'GET',
			                beforeSend: function () {
							showBlock("#formRegistrar",'Generando Folio...');
			                },
			                success:  function (response) {
			                	hideBlock("#formRegistrar");
			                    if(response.success == 1){
									$('#FOLIO_PROYECTO').val(response.folio);
			                    }
								
			                }, 
			                error: function() {
			                		hideBlock("#formRegistrar");
									myToast.update({
									        heading: 'Error',
									        text: 'Intente de nuevo',
									        icon: 'error'
									 });    
		
			            }
			        });
				}else{
					// quitamos el valor al folio
					$('#FOLIO_PROYECTO').val('');
				}

			}



		});



		jQuery("#formRegistrarActividad").validate({
			submitHandler: function(form) {
				var parametros = new FormData($(form)[0]);
					metodo = (did > 0) ? 'POST': 'POST';
					head = (did > 0) ? 'Actualizando': 'Guardando';
			        $.ajax({
			                data:  parametros,
			                url:   base_url + 'index.php/captura/guardaActividad',
						    cache: false,
						    contentType: false,
						    processData: false,
			                type:  metodo,
			                beforeSend: function () {
							showBlock("#formRegistrarActividad",'Guardando...');
								myToast = $.toast({
								    heading: 'Información',
								    text: head,
								    icon: 'info',
								    hideAfter: false,
									position : 'mid-center'
								});
			                },
			                success:  function (response) {
			                        //jsonToTable(response);
			                	hideBlock("#formRegistrarActividad");
			                    if(response.success == 1){
			                    	$('#myModal').modal('hide');
									myToast.update({
									        heading: response.head,
									        text: response.message,
									        icon: 'success'
									 });
									// Actualizar la tabla de Actividades
									 $('#formRegistrarActividad')[0].reset();
									$("input[name='ID_DETALLE_ACTIVIDAD']").val(0);

									fillActividades();
			                    }else{
									myToast.update({
									        heading: response.head,
									        text: response.message,
									        icon: 'error'
									 });    
			                    }
								setTimeout(function(){ 
									$.toast().reset('all');
								}, 2000);
								
			                }, 
			                error: function() {
			                		hideBlock("#formRegistrarActividad");
									myToast.update({
									        heading: 'Error',
									        text: 'Intente de nuevo',
									        icon: 'error'
									 });    
		
			            }
			        });

			}
		});


		jQuery("#formRegistrarFormato").validate({
			  rules: {
			    userfile: {
			      extension: "pdf"
			    }
			  },
			submitHandler: function(form) {
				var parametros = new FormData($(form)[0]);
					metodo = (did > 0) ? 'POST': 'POST';
					head = (did > 0) ? 'Actualizando': 'Guardando';
			        $.ajax({
			                data:  parametros,
			                url:   base_url + 'index.php/captura/guardaFormato',
						    cache: false,
						    contentType: false,
						    processData: false,
			                type:  metodo,
			                beforeSend: function () {
							showBlock("#formRegistrarFormato",'Guardando...');
								myToast = $.toast({
								    heading: 'Información',
								    text: head,
								    icon: 'info',
								    hideAfter: false,
									position : 'mid-center'
								});
			                },
			                success:  function (response) {
			                        //jsonToTable(response);
			                	hideBlock("#formRegistrarFormato");
			                    if(response.success == 1){
			                    	$('#myModal').modal('hide');
									myToast.update({
									        heading: response.head,
									        text: response.message,
									        icon: 'success'
									 });
									// Actualizar la tabla de Actividades
									$('#formRegistrarFormato')[0].reset();
								    $( "textarea[name='DESCRIP_OFICIO']" ).text('');
									$("input[name='ID_DETALLE_OFICIO']").val(0);
									fillFormatos();
			                    }else{
									myToast.update({
									        heading: response.head,
									        text: response.message,
									        icon: 'error'
									 });    
			                    }
								setTimeout(function(){ 
									$.toast().reset('all');
								}, 2000);
								
			                }, 
			                error: function() {
			                		hideBlock("#formRegistrarFormato");
									myToast.update({
									        heading: 'Error',
									        text: 'Intente de nuevo',
									        icon: 'error'
									 });    
		
			            }
			        });

			}
		});


		jQuery("#formRegistrar").validate({
			  rules: {
			    userfile: {
			      extension: "pdf"
			    }
			  },
			submitHandler: function(form) {
				//parametros = {}
				var parametros = new FormData($(form)[0]);
				//$.each($(form).serializeArray(), function(i, obj) { parametros[obj.name] = obj.value });
				console.log(parametros);
					metodo = (did > 0) ? 'POST': 'POST';
					head = (did > 0) ? 'Actualizando': 'Guardando';

					// Verificar que no exista un titulo de proyecto registrado

			        $.ajax({
			                data:  parametros,
			                url:   base_url + 'index.php/captura/guardaCartera',
						    cache: false,
						    contentType: false,
						    processData: false,
			                type:  metodo,
			                beforeSend: function () {
							showBlock("#formRegistrar",'Guardando...');
								myToast = $.toast({
								    heading: 'Información',
								    text: head,
								    icon: 'info',
								    hideAfter: false,
									position : 'mid-center'
								});
			                },
			                success:  function (response) {
			                        //jsonToTable(response);
			                	hideBlock("#formRegistrar");
			                    if(response.success == 1){
			                    	$('#myModal').modal('hide');
									myToast.update({
									        heading: response.head,
									        text: response.message,
									        icon: 'success'
									 });
									 $(location).attr('href', base_url + 'index.php/captura/index/' + response.last_insert)    
			                    }else{
									myToast.update({
									        heading: response.head,
									        text: response.message,
									        icon: 'error'
									 });    
			                    }
								setTimeout(function(){ 
									$.toast().reset('all');
								}, 2000);
								
			                }, 
			                error: function() {
			                		hideBlock("#formRegistrar");
									myToast.update({
									        heading: 'Error',
									        text: 'Intente de nuevo',
									        icon: 'error'
									 });    
		
			            }
			        });

			}
		});

		/*

		jQuery(function() {
			// bootstrap-datepicker
			jQuery('.datepicker').datepicker({
				format: "yyyy-mm-dd",
				language: "es",
				todayBtn: true
			}).on('changeDate', function(ev){                 
		    $('.datepicker').datepicker('hide');
		});

		});

		*/


		$(document).on('click', 'a.btnEditarActividad', function() {
			actId = $(this).data('id');
			$("input[name='ID_DETALLE_ACTIVIDAD']").val(actId);
			$('#ID_ACTIVIDAD').val($(this).data('ia'));
			row = $(this).closest("tr");
			tdfip = row.find("td:nth-child(2)");
		    tdsffp = row.find("td:nth-child(3)");
		    tdpp = row.find("td:nth-child(4)");
		    tfir = row.find("td:nth-child(5)");
		    tffr = row.find("td:nth-child(6)");
		    tdpa = row.find("td:nth-child(7)");

			$( "input[name='FEC_INI_PLANEADA']" ).val(tdfip[0].innerHTML);
			$( "input[name='FEC_FIN_PLANEADA']" ).val(tdsffp[0].innerHTML);
			$( "input[name='PORCENTAJE_PLANEADO']" ).val(tdpp[0].innerHTML);
			$( "input[name='FEC_INI_REAL']" ).val(tfir[0].innerHTML);
			$( "input[name='FEC_FIN_REAL']" ).val(tffr[0].innerHTML);
			$( "input[name='PORCENTAJE_AVANCE']" ).val(tdpa[0].innerHTML);

		});


		$(document).on('click', 'a.btnEliminarActividad', function() {
			actId = $(this).data('id');
			deleteActividad(actId);
		});




		$(document).on('click', 'a.btnEditarFormato', function() {
			forId = $(this).data('id');
			$('#ID_TIPO_OFICIO').val($(this).data('to'));
			$("input[name='ID_DETALLE_OFICIO']").val(forId);
			// Llenar el formulario de formatos

			row = $(this).closest("tr");
			tddesc = row.find("td:nth-child(3)");
		    tdsfec = row.find("td:nth-child(4)");
		    tdsvol = row.find("td:nth-child(5)");
			$( "textarea[name='DESCRIP_OFICIO']" ).text(tddesc[0].innerHTML);
			$( "input[name='FEC_OFICIO_REG']" ).val(tdsfec[0].innerHTML);
			$( "input[name='VOLANTE']" ).val(tdsvol[0].innerHTML);

			
			
			

			fillSelectFormatos($(this).data('to'),$(this).data('if'));

		});


		$(document).on('click', 'a.btnEliminarFormato', function() {
			forId = $(this).data('id');
			deleteFormato(forId);
		});


		$(document).on('click', 'a.btnNuevo', function() {
			did = 0;
			$("#N_DEMANDANTE").addClass( "required" );
			$('#tblDemandantes tbody').html('');
			$('#tblDemandantes').hide();
			$('#iframeArchivo').attr('src', '');
			$('#msgNoArchivo').show();
			$('#iframeArchivo').hide();
			$('#hiddenId').val(did);
			clearSpan();
			$('#myModal').modal('show');
			//emptyDemandantes();
		});

		$(document).on('click', 'a.hideInput', function() {
			vID = $(this).data('id');
			hideDiv(vID);
			showSelect(vID);
		});

});

	function selectSecundario(select,value,value2){
			 value2 = typeof value2 !== 'undefined' ? value2 : 0;
		        $.ajax({
		                data:  {'ID_UR' : value},
		                url:   base_url + 'index.php/captura/getUrSec',
					    cache: false,
		                type:  'GET',
		                beforeSend: function () {
						showBlock("#formRegistrar",'Generando Folio...');
		                },
		                success:  function (response) {
		                	hideBlock("#formRegistrar");
		                	// LLenar Select UR SEC
		                	console.log(response);
		                	if(response.length > 0){
		                		$('#div_' + select).show();
								$('#' + select).html('<option value="">--- Seleccione ---</option>');
								    for (var i=0; i<response.length; i++) {
								    	selected = '';
								    	if(response[i].ID_UR_SEC == value2){
								    		selected = 'selected'
								    	}
								      $('#' + select).append('<option ' + selected + ' value="' + response[i].ID_UR_SEC + '">' + response[i].DESCRIPCION_UR_SEC + '</option>');
								    }
		                	}else{
		                		// Ocultar select
		                		$('#div_' + select).hide();
		                	}
		                }, 
		                error: function() {
		                		hideBlock("#formRegistrar");
		                		$('#div_' + select).hide();
		            }
		        });
	}


	function fillSelectFormatos(val,idFor){
 			 idFor = typeof idFor !== 'undefined' ? idFor : 0;
		        $.ajax({
		            data:  {'ID_TIPO_OFICIO' : val,'ID_PROYECTO' : did},
		            url:   base_url + 'index.php/captura/getFormatosRecibidos',
		            type:  'GET',
		            dataType: "json",
		            beforeSend: function () {
		            	showBlock('#formRegistrarFormato','Obteniendo Información');
		            },
		            success:  function (response) {
		            	hideBlock('#formRegistrarFormato');
		            	if(response.length > 0){
		            		// Llenar el select 
						$('#ID_FORMATO').html('<option value="">--- Seleccione ---</option>');
						    for (var i=0; i<response.length; i++) {
						    	selected = '';
						      $('#ID_FORMATO').append('<option ' + selected + ' value="' + response[i].ID_FORMATO + '">' + response[i].FORMATOS_RECIBIDOS + '</option>');
						    }
						    if(idFor > 0){
								$('#ID_FORMATO').val(idFor);
						    }

		            	}
		            }, 
		            error: function() {
		            	console.log('error');
		            	hideBlock('#formRegistrarFormato');
						$.toast().reset('all');
		            }
		        });

	}




	function clearSpan(){
		$.each(cbos, function(key, value) {
			$('#' + value + '_help').html('');
		});
	}

	function hideInputs(){
		$.each(cbos, function(key, value) {
			$('#' + value + '_input').hide();
		});
	}

	function hideDivs(){
		$.each(cbos, function(key, value) {
			$('#' + value + '_div').hide();
		});
	}

	function hideSelect(vID){
		$('#' + vID).hide();
	}

	function showSelect(vID){
		//$('#' + vID).prop('selectedIndex',0);
		$('#' + vID + '_input').val('');
		$('#' + vID).show();
	}

	function hideInput(vID){
		$('#' + vID + '_input').hide();
	}

	function showInput(vID){
		$('#' + vID + '_input').show();
	}

	function hideDiv(vID){
		$('#' + vID + '_div').hide();
	}

	function showDiv(vID){
		$('#' + vID + '_div').show();
	}

	function fillActividades(){
        $.ajax({
            data:  {'ID_PROYECTO' : idd},
            url:   base_url + 'index.php/captura/getActividades',
            type:  'GET',
            beforeSend: function () {},
            success:  function (response) {
           	items = response;
			// Generar Tabla
			// Mostrar Tabla si hay demandantes
			totDem = items.length;
			$('#tblActividades').html('');
			if(totDem > 0){
				for (i = 0; i < totDem; i++) { 
					console.log(items[i]);
					item = '<tr>';
					item += '<td>' + items[i]['ACTIVIDAD_PROYECTO']  + '</td>';
					item += '<td>' + items[i]['FEC_INI_PLANEADA']  + '</td>';
					item += '<td>' + items[i]['FEC_FIN_PLANEADA']  + '</td>';
					item += '<td>' + items[i]['PORCENTAJE_PLANEADO']  + '</td>';
					item += '<td>' + items[i]['FEC_INI_REAL']  + '</td>';
					item += '<td>' + items[i]['FEC_FIN_REAL']  + '</td>';
					item += '<td>' + items[i]['PORCENTAJE_AVANCE']  + '</td>';
					if(lv == 0){
						item += '<td><a class="btn btn-default btn-xs btnEditarActividad" data-ia="' + items[i]['ID_ACTIVIDAD'] + '" data-id="' + items[i]['ID_DETALLE_ACTIVIDAD'] + '"><i class="glyphicon glyphicon-pencil"></i></a></center>';
						item += '<a class="btn btn-danger btn-xs btnEliminarActividad" data-id="' + items[i]['ID_DETALLE_ACTIVIDAD'] + '"><i class="glyphicon glyphicon-trash"></i></a></center></td>';
					}

					item += '</tr>';
					$('#tblActividades').append(item);
				}
				$('#tblActividades').show();
			}
            }, 
            error: function() {}
        });
	}


	function fillFormatos(){
        $.ajax({
            data:  {'ID_PROYECTO' : idd},
            url:   base_url + 'index.php/captura/getFormatos',
            type:  'GET',
            beforeSend: function () {},
            success:  function (response) {
           	items = response;
			// Generar Tabla
			// Mostrar Tabla si hay demandantes
			totDem = items.length;
			$('#tblFormatos').html('');
			if(totDem > 0){
				for (i = 0; i < totDem; i++) {
				console.log(items[i]); 
					item = '<tr>';
					item += '<td>' + items[i]['NAME_TIPOS_OFICIOS']  + '</td>';
					item += '<td>' + items[i]['FORMATOS_RECIBIDOS']  + '</td>';
					item += '<td>' + items[i]['DESCRIP_OFICIO']  + '</td>';
					item += '<td>' + items[i]['FEC_OFICIO_REG']  + '</td>';
					item += '<td>' + items[i]['VOLANTE']  + '</td>';
					if(items[i]['DOCUMENTO'] == '' || items[i]['DOCUMENTO'] == null || items[i]['DOCUMENTO'] == 'null'){
						item += '<td></td>';
					}else{
						item += '<td><center><a class="btn btn-xs btn-info" target="_blank" href="' + base_url + 'index.php/captura/pdf/'  + items[i]['DOCUMENTO']  + '""><i class="glyphicon glyphicon-cloud-download"></i></a></center></td>';
					}
					
					if(lv == 0){
						item += '<td><a class="btn btn-default btn-xs btnEditarFormato" data-if="' + items[i]['ID_FORMATO'] + '" data-to="' + items[i]['ID_TIPO_OFICIO'] + '" data-id="' + items[i]['ID_DETALLE_OFICIO'] + '"><i class="glyphicon glyphicon-pencil"></i></a></center>';
						item += '<a class="btn btn-danger btn-xs btnEliminarFormato" data-id="' + items[i]['ID_DETALLE_OFICIO'] + '"><i class="glyphicon glyphicon-trash"></i></a></center></td>';
					}
					item += '</tr>';
					$('#tblFormatos').append(item);
				}
				$('#tblFormatos').show();
			}
            }, 
            error: function() {}
        });
	}


	function emptyDemandantes(dms){
 		dms = typeof dms !== 'undefined' ? dms : [];
 		//forms = sheepItForm.getAllForms();
 		/*
		for (z = 0; z < forms.length; z++) { 
			if(z > 0){
				sheepItForm.removeForm(z);
			}
		}
		*/
		//sheepItForm.addForm();
		sheepItForm.inject(dms);
	}

	function deleteFormato(_forID){
		var r = confirm("Se eliminará el formato!");
		if (r == true) {
	        $.ajax({
	            data:  {'ID_DETALLE_FORMATO' : _forID},
	            url:   base_url + 'index.php/captura/deleteFormato',
	            type:  'POST',
	            beforeSend: function () {
					myToast = $.toast({
					    heading: 'Información',
					    text: 'Eliminando informacion...',
					    icon: 'info',
					    hideAfter: false,
						position : 'mid-center'
					});
	            },
	            success:  function (response) {
	            	if(response.success == 1){
	            		// Se eliminó
	            		fillFormatos();
						myToast.update({
						        heading: response.head,
						        text: response.message,
						        icon: 'success'
						 });    

	            	}else{
	            		//no se eliminó

					myToast.update({
					        heading: response.head,
					        text: response.message,
					        icon: 'warning'
					 });    

	            	}
					setTimeout(function(){ 
						$.toast().reset('all');
					}, 2000);
	            }, 
	            error: function() {
					$.toast().reset('all');
	            }
	        });
		}
	}


	function deleteActividad(_actID){
		var r = confirm("Se eliminará la actividad!");
		if (r == true) {
	        $.ajax({
	            data:  {'ID_DETALLE_ACTIVIDAD' : _actID},
	            url:   base_url + 'index.php/captura/deleteActividad',
	            type:  'DELETE',
	            beforeSend: function () {
					myToast = $.toast({
					    heading: 'Información',
					    text: 'Eliminando informacion...',
					    icon: 'info',
					    hideAfter: false,
						position : 'mid-center'
					});
	            },
	            success:  function (response) {
	            	if(response.success == 1){
	            		// Se eliminó
	            		fillActividades();
						myToast.update({
						        heading: response.head,
						        text: response.message,
						        icon: 'success'
						 });    

	            	}else{
	            		//no se eliminó

					myToast.update({
					        heading: response.head,
					        text: response.message,
					        icon: 'warning'
					 });    

	            	}
					setTimeout(function(){ 
						$.toast().reset('all');
					}, 2000);
	            }, 
	            error: function() {
					$.toast().reset('all');
	            }
	        });
		}
	}

	function showBlock(selector,msg){
	    $(selector).block({
	        theme: false,
	        message: '<h5><img src="' + base_url + 'assets/images/ajax-loading.gif" style="width:20px;" />' + msg + '</h5>'
	    });
	}

	function hideBlock(selector){
		setTimeout(function(){$(selector).unblock(); }, 500);
		
	}

	function optionSort(a, b) {
	    return $(a).val() > $(b).val();
	}


	function getResponsables(ID_PROYECTO,TIPO){
 			ID_PROYECTO = typeof ID_PROYECTO !== 'undefined' ? ID_PROYECTO : 0;
 			TIPO = typeof TIPO !== 'undefined' ? TIPO : 1;
	        $.ajax({
	                data:  {'ID_PROYECTO' : ID_PROYECTO,'TIPO' : TIPO},
	                url:   base_url + 'index.php/captura/getResponsables/' + ID_PROYECTO ,
				    cache: false,
	                type:  'GET',
	                beforeSend: function () {
					showBlock("#tblAsignados",'Buscando responsables...');
	                },
	                success:  function (response) {
						if(TIPO == 1){$("#myModal").modal('show');}
	                	hideBlock("#tblAsignados");
	                	console.log(response);
	                	items = response;
	                	totDem = items.length;

	                	item = '';
					for (i = 0; i < totDem; i++) { 
						item += '<tr>';
						item += '<td>' + items[i]['ABREVIATURA'] + ' ' +items[i]['NOMBRE_RESPONSABLE']  + '</td>';
						if(TIPO !== 1){
							item += '<td>' + items[i]['CARGO_RESPONSABLE']  + '</td>';
						}

						if(items[i]['TEL_RESPONSABLE'] !== null){
							item += '<td>' + items[i]['TEL_RESPONSABLE']  + '</td>';
						}else{
							item += '<td></td>';
						}


						if(items[i]['EXT_RESPONSABLE'] !== null){
							item += '<td>' + items[i]['EXT_RESPONSABLE']  + '</td>';
						}else{
							item += '<td></td>';
						}


						if(items[i]['CORREO_RESPONSABLE'] !== null){
							item += '<td>' + items[i]['CORREO_RESPONSABLE']  + '</td>';
						}else{
							item += '<td></td>';
						}
						if(TIPO == 1){
							item += '<td>'; 
							item += '<a data-id="' + items[i]['ID_RESPONSABLE'] + '" class="btn btn-default btn-xs btnAsignar"><i class="glyphicon glyphicon-ok"></i></a>';
							// item += '<a data-id="' + items[i]['ID_RESPONSABLE'] + '" class="btn btn-warning btn-xs btnEditarResponsable"><i class="glyphicon glyphicon-edit"></i></a>';
							item += '</td>';
						}else{
							item += '<td>' + '<a data-id="' + items[i]['ID_RESPONSABLE'] + '" class="btn btn-danger btn-xs btnEliminarResponsable"><i class="glyphicon glyphicon-trash"></i></a>' + '</td>';
						}
						
						item += '</tr>';
					}
					if(TIPO == 1){
						$('#responsables').html(item);
					}else{
						$('#asignados').html(item);
					}


	                }, 
	                error: function() {
	                	hideBlock("#tblAsignados");

	            	}
	        	});

	}

