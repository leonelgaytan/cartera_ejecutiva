jQuery(document).ready(function($) {
		jQuery("#tblRegistros").DataTable({
		    language: {
		        "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
		    }
		});
		jQuery('#tblResultados').on('click', 'a.btnNuevo', function(e) {
			jQuery("#formResponsables").get(0).reset()
			jQuery('#ID_RESPONSABLE').val(0);
			$('#myModal').modal('show');
		});


		jQuery('#tblResultados').on('click', 'a.btnEliminar', function(e) {
	        $.ajax({
	                data:  {'ID_RESPONSABLE' : $(this).data('id')},
	                url:   base_url + 'index.php/responsables/eliminar',
				    cache: false,
	                type:  'POST',
	                beforeSend: function () {
					showBlock("#formResponsables",'Eliminando...');
						myToast = $.toast({
						    heading: 'Información',
						    text: 'Eliminando...',
						    icon: 'info',
						    hideAfter: false,
							position : 'mid-center'
						});
	                },
	                success:  function (response) {
	                        //jsonToTable(response);
	                	hideBlock("#formResponsables");
	                    if(response.success == 1){
	                    	$('#myModal').modal('hide');
							myToast.update({
							        heading: response.head,
							        text: response.message,
							        icon: 'success'
							 });
							// Actualizar la tabla de Actividades
							 	//jQuery('#formResponsables')[0].reset();
								location.href = base_url + "index.php/responsables";
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
	                		hideBlock("#formResponsables");
							myToast.update({
							        heading: 'Error',
							        text: 'Intente de nuevo',
							        icon: 'error'
							 });    

	            }
	        });
		});




		jQuery("#formResponsables").validate({
			submitHandler: function(form) {
				var parametros = new FormData($(form)[0]);
					metodo = (idr > 0) ? 'POST': 'POST';
					head = (idr > 0) ? 'Actualizando': 'Guardando';
			        $.ajax({
			                data:  parametros,
			                url:   base_url + 'index.php/responsables/guardar',
						    cache: false,
						    contentType: false,
						    processData: false,
			                type:  metodo,
			                beforeSend: function () {
							showBlock("#formResponsables",'Guardando...');
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
			                	hideBlock("#formResponsables");
			                    if(response.success == 1){
			                    	jQuery('#myModal').modal('hide');
									myToast.update({
									        heading: response.head,
									        text: response.message,
									        icon: 'success'
									 });
									// Actualizar la tabla de Actividades
									 	//jQuery('#formResponsables')[0].reset();
										location.href = base_url + "index.php/responsables";
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
			                		hideBlock("#formResponsables");
									myToast.update({
									        heading: 'Error',
									        text: 'Intente de nuevo',
									        icon: 'error'
									 });    
		
			            }
			        });

			}
		});

});

