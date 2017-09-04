var cbos = ['ID_APERCIBIMIENTO','ID_CAUSA_CONCLUSION','ID_CONDENA_ECO','ID_CONDENA_NO_ECO','ID_ESTATUS_PROCESAL','ID_ACCION_LABORAL','ID_CATEGORIA','ID_UR_ADSCRIP_TRAB'];

var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function() {
  	table = 'tblRegistros';
  	name = 'Cartera Ejecutiva';
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()


jQuery(document).ready(function($) {
	/*
$('#tblRegistros').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
	*/

   $('#anio,#ur,#fp').multiselect({
            buttonText: function(options, select) {
                if (options.length === 0) {
                    return 'Ninguno Seleccionado';
                }
                else if (options.length > 0) {
                    return 'Seleccionados: ' + options.length;
                }
            }
        });



		jQuery("#formBuscar").validate({
			submitHandler: function(form) {
				parametros = {}
				
				parametros = $(form).serializeArray();
				//$.each($(form).serializeArray(), function(i, obj) { parametros[obj.name] = obj.value });
				console.log(parametros);
			        $.ajax({
			                data:  parametros,
			                url:   base_url + 'index.php/consulta/buscar',
			                type:  'GET',
			                beforeSend: function () {
			                    $("#resultado").html("<center><h3>Procesando, espere por favor...</h3></center>");

								myToast = $.toast({
								    heading: 'Información',
								    text: 'Buscando...',
								    icon: 'info',
								    hideAfter: false,
									position : 'mid-center'
								});

			                },
			                success:  function (response) {
			                        jsonToTable(response);
			                    if(response.length > 0){
									myToast.update({
									        heading: 'Información',
									        text: 'Se han encontrado ' + response.length + ' registros.',
									        icon: 'success'
									 });    
			                    }else{
			
									myToast.update({
									        heading: 'Información',
									        text: 'La busqueda no arrojó resultados',
									        icon: 'warning',
									 });    
			                    }
								setTimeout(function(){ 
									$.toast().reset('all');
								}, 2000);
								
			                }, 
			                error: function() {
			                    $("#resultado").html("<center><h3>Ocurrio un error... Intente de nuevo</h3></center>");
		


			                }
			        });
				

			}
		});

		$('#resultado').on('click', 'a.btnDetalle', function(e) {
			$("#N_DEMANDANTE").removeClass( "required" );
			did = $(this).data('id');
			$('#hiddenId').val(did);
			$(e.target).closest('tr').children('td,th').css('background-color','#CCC');
		});

		$('#resultado').on('click', 'a.btnBitacora', function() {
			did = $(this).data('id');
			$('#bodyModal').show();
			$('#hiddenDID').val(did);
		});

		$('#myModal').on('show.bs.modal', function (e) {
			if(did > 0){
			$('#tblRegistros').hide();
		        $.ajax({
		                data:  {'id' : did},
		                url:   base_url + 'index.php/consulta/buscarDetalle',
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



		});

		$('#myModal2').on('show.bs.modal', function (e) {
			if(did > 0){
				console.log(did);
				fillTableBitacora(did);
			}else{
            	$('#formBitacora')[0].reset();
			}
		});

});



	function jsonToTable(r){
        $("#resultado").html('');
        if(r.length > 0){
	        table = '<table id="tblRegistros" class="table table-bordered table-striped">';
	        table += '<tr class="tdTitulo"><th colspan="6"><center>Fólios encontrados: ' + r.length + ' <a onclick="tableToExcel()"><i class="glyphicon glyphicon-cloud-download"></i></a></center></th></tr>';
	        table += '<tr><th>AÑO</th><th>FOLIO</th><th>FECHA REGISTRO</th><th>NOMBRE</th><th>VERSIÓN</th><th>FASE</th><td></td></tr>';
	     	for (i = 0; i < r.length; i++) {
				table += '<tr><td>' + r[i]['ANIO'] + '</td><td>' + r[i]['FOLIO_PROYECTO'] + '</td><td> ' + r[i]['FEC_REGISTRO'] + '</td><td>' + r[i]['NOMBRE_PROYECTO'] + '</td><td>' + r[i]['VERSION'] + '</td><td>' + r[i]['FASE_PROYECTO']  + '</td><td><center><a href="' + base_url + 'index.php/captura/index/' + r[i]['ID_PROYECTO'] +  '" class="btn btn-info btn-sm btnDetalle"><span class="glyphicon glyphicon-info-sign"></span></a></center></td></<tr>';
			}
			table += '</table>';
			$("#resultado").append(table);
        }else{
		    $("#resultado").append("<center><h3>La búsqueda no arrojó resultados</h3></center>");
        }

	}

	function fillTableBitacora(demID){
		console.log('fillTableBitacora: ' + demID);
        $("#bodyBitacora").html('');

        $.ajax({
                data:  {'id' : demID},
                url:   base_url + 'index.php/consulta/buscarBitacora',
                type:  'GET',
                beforeSend: function () {
                    $("#bodyModal2").html("<center><h3>Buscando Información...</h3></center>");
                },
                success:  function (r) {
		        if(r.length > 0){
		        	$('#bodyBitacora').html('');
			     	for (i = 0; i < r.length; i++) {
			     		$('#bodyBitacora').append('<tr><td>' + r[i]['ID_DEMANDA'] + '</td><td>' + r[i]['FECHA'] + '</td><td>' + r[i]['TOTAL'] + '</td><td>' + r[i]['OBSERVACIONES'] + '</td></tr> ');
					}
		        }else{
				    //$("#resultado").append("<center><h3>La búsqueda no arrojó resultados</h3></center>");
		        }		
                }, 
                error: function() {
                    //$("#resultado").html("<center><h3>Ocurrio un error... Intente de nuevo</h3></center>");
                }
        });

	}	

	function hideDivs(){
		$.each(cbos, function(key, value) {
			$('#' + value + '_div').hide();
		});
	}