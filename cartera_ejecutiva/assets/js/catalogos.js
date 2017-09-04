var trs = '';
var tri = '<tr>';
var tdi = '<td>';
var nodata = 'No se han registrado elementos.';
var tdf = '</td>';
var trf = '</tr>';
var tablei = '<table class="table table-striped table-bordered marginTop20">';
var theadi = '<thead><tr><th>ID</th><th>NOMBRE</th><th>Editar</th><th>Eliminar</th></tr></thead>';
var theadf = '</thead>';
var tbodyi = '<tbody id="tblItems">';
var tbodyf = '</tbody>';
var tablef = '</table>';

jQuery(document).ready(function($) {
	// Obtenemos los catálogos posibles a modificar.
	$('#divID_UR').hide();
	$('#divID_TIPO_PROYECTO').hide();
	$('#divID_TIPO_OFICIO').hide();

	getCatalogos();
	$('#catalogos').on('change', function() {
		setTable(this.value);
		console.log(this.value);
		if(this.value == 'C_UR_SECUNDARIAS'){
			setTable('C_UNIDADES_RESPONSABLES');
			// Mostramos el select 
			$('#divID_UR').show();
			// LLenamos el Select

			setType('GET');
			setMsg({},1);
			setItemSecundario(0);
			setParams({TBL : getTable(),ID : getItem(),NAME : getName()});
			setUrl(base_url + 'index.php/catalogos/getItems');
			sendAjax().done(function(data) {
			   var options = '<option value="0">S E L E C C I O N E</option>';
			    for (var x = 0; x < data.length; x++) {
			        options += '<option value="' + data[x]['ID'] + '">' + data[x]['ID_UR'] + ' - ' +  data[x]['NAME'] + '</option>';
			    }
			    $('#ID_UR').html(options);
			}).fail(function(error) {
				console.log(error);
			});

			$('#divID_TIPO_PROYECTO').hide();
			$('#divID_TIPO_OFICIO').hide();
		}else if(this.value == 'C_FORMATOS_RECIBIDOS'){
			setTable('C_FORMATOS_RECIBIDOS');
			$('#divID_TIPO_PROYECTO').show();
			$('#divID_TIPO_OFICIO').show();
			getID();
			getItemsFR();
		}else{
			$('#divID_TIPO_PROYECTO').hide();
			$('#divID_TIPO_OFICIO').hide();

			getItems();
			getID();
		}
	});


   $('#ID_TIPO_OFICIO,#ID_TIPO_PROYECTO').multiselect({
            buttonText: function(options, select) {
                if (options.length === 0) {
                    return 'Ninguno Seleccionado';
                }
                else if (options.length > 0) {
                    return 'Seleccionados: ' + options.length;
                }
            }
        });

	$('#ID_UR').on('change', function() {
			setItem(this.value);
			setTable('C_UR_SECUNDARIAS');
			setItemSecundario(this.value,false);
			getItems('index.php/catalogos/getItemsUR');
			getID(this.value);
			getID('C_UR_SECUNDARIAS',this.value,false,'index.php/catalogos/getIdUR')
	});

	$('.spanId').hide();

		$( ".btnCambiarId" ).click(function() {
			$('#ID').prop('readonly', false);
		});


	 $("#guardaCatalogo").validate({
	    highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	    },
	    errorPlacement: function() {
		    return true;
		},
		  submitHandler: function(form) {
			setName($( "input[name='NAME']" ).val());
			setItem($( "input[name='ID']" ).val());
			if(getType() == 'GET'){setType('POST');}
			tableName = getTable();
		  	if(tableName.length > 0){
		  		if(tableName == 'C_UR_SECUNDARIAS'){
		  		console.log(tableName);
			  		guardaItem('index.php/catalogos/guardaItemSecundario');
		  		}else if(tableName == 'C_FORMATOS_RECIBIDOS'){
			  		guardaItem('index.php/catalogos/guardaFormatoRecibido');
		  		}else{
			  		guardaItem();
		  		}
		  	}else{
		  		setMsg({head : 'Error',text : 'Seleccione un catálogo a modificar',icon : 'error',hideA : true});
		  		getToast();
		  	}


		  }
	 });

	$( document ).on( "click", "a.btnEditar", function() {
		setType('PUT');
		setItem($(this).data('id'));
		console.log(getItem());
		setMsgUpdate(true);
		$('#divID').hide();
		var row = $(this).closest("tr");
		tdsId = row.find("td:nth-child(1)");


		if(getTable() == 'C_FORMATOS_RECIBIDOS'){
    		tdsName = row.find("td:nth-child(4)");
		}else{
    		tdsName = row.find("td:nth-child(2)");
		}



		$( "input[name='ID']" ).val(tdsId[0].innerHTML);
		$( "input[name='NAME']" ).val(tdsName[0].innerHTML);
		$('html, body').animate({ scrollTop: 0 }, 'fast');
	});


	$( document ).on( "click", "a.btnEliminar", function() {
		var r = confirm("Se eliminará el registro. Desea continuar?");
			if (r == true) {
				setMsgUpdate(false);
				setType('DELETE');
				console.log($(this).data('id'));
				setItem($(this).data('id'));
				$( "input[name='NAME']" ).val('');
				if(getTable() == 'C_FORMATOS_RECIBIDOS'){
			  		guardaItem('index.php/catalogos/guardaFormatoRecibido');
				}else{
					guardaItem();
				}

			}
	});

	$('#msgUpdate').hide();
});



function setOrden(){

}

function getItems(url){
	  url = typeof url !== 'undefined' ? url : 'index.php/catalogos/getItems';
	setType('GET');
	setMsg({},1);
	setParams({TBL : getTable(),ID : getItem(),NAME : getName()});
	setUrl(base_url + url);

	sendAjax().done(function(data) {
		fillTable('#tbl',data);
	}).fail(function(error) {
		console.log(error);
	});

}

function getItemsFR(){
	setType('GET');
	setMsg({},1);
	setItemSecundario(0);
	setParams({TBL : getTable(),ID : getItem(),NAME : getName()});
	setUrl(base_url + 'index.php/catalogos/getFormatosRecibidos');
	sendAjax().done(function(d) {
		fillTableFormatos('#tbl',d);
	}).fail(function(error) {
		console.log(error);
	});
}


function getID(tbl,id,name,url){
	tbl = typeof tbl !== 'undefined' ? tbl : getTable();
	id = typeof id !== 'undefined' ? id : getItem();
	name = typeof name !== 'undefined' ? name : getName();
	url = typeof url !== 'undefined' ? url : 'index.php/catalogos/getId';
	setType('GET');
	setMsg({},1);
	setParams({TBL : tbl,ID : id,NAME : name});
	setUrl(base_url + url);
	sendAjax().done(function(data) {
		data = Number(data);
		if(isInt(data)){
			data = data + 1;
		}else if(isFloat(data)){
			data = data + 0.1;
			data = Math.round( data * 10 ) / 10;
		}else{
			data = 0;
		}
		$('.spanId').show();
		$('#ID').prop('readonly', true);
		$( "input[name='ID']" ).val(data);
	}).fail(function(error) {
		console.log(error);
	});

}


function getCatalogos(){
	setUrl(base_url + 'index.php/catalogos/getCatalogos');
	setType('GET');
	setMsg({},1);
	sendAjax().done(function(data) {
		fillSelect('#catalogos',data);
	}).fail(function(error) {
		console.log(error);
	});

}


function guardaItem(url){
	url = typeof url !== 'undefined' ? url : 'index.php/catalogos/guardaItem';
	TBL = getTable();
	METHOD = getType();
	if(TBL == 'C_FORMATOS_RECIBIDOS' && METHOD !== 'DELETE'){
		parametros = {}
		setParams($('#guardaCatalogo').serializeArray());
	}else{
		setParams({TBL : TBL,ID : getItem(),ID_SEC : getItemSecundario(),NAME : getName()});
	}

	console.log(getUrl());
	setUrl(base_url + url);
	sendAjax().done(function(data) {
		console.log(data);
		if(data.success == 1){
			$( "input[name='NAME']" ).val('');
			getID();
			
			if(getTable() == 'C_FORMATOS_RECIBIDOS'){
				getItemsFR();
			}else{
				getItems();
			}

			setMsg({head : data.head,text : data.message,icon : 'success',hideA : true});
			getToast();
		}else{
			setMsg({head : data.head,text : data.message,icon : 'danger',hideA : true});
			getToast();
		}
	}).fail(function(error) {
			setMsg({head : 'Error',text : error,icon : 'danger',hideA : true});
		getToast();
	});
	$('#divID').show();
} 



function fillSelect(elemento,data){
   var options = '<option value="0">S E L E C C I O N E</option>';
    for (var x = 0; x < data.length; x++) {
        options += '<option value="' + data[x]['TBL'] + '">' + data[x]['DESCRIPTION'] + '</option>';
    }
    $(elemento).html(options);
}

function fillTable(elemento,d){
    $(elemento).html('');
    trs = '';
    theadi = '<thead><tr><th>ID</th><th>NOMBRE</th><th>Editar</th><th>Eliminar</th></tr></thead>';
    if(d.length > 0){
        for (var y = 0; y < d.length; y++) {
            trs += tri 
            	+ tdi + d[y]['ID']  + tdf 
            	+ tdi + d[y]['NAME']  + tdf 
            	+ tdi + '<center><a class="btn btn-default btn-xs btnEditar" data-id="' + d[y]['ID'] + '"><span><i class="glyphicon glyphicon-pencil"></i></span></a></center>'   + tdf  
            	+ tdi + '<center><a class="btn btn-danger btn-xs btnEliminar" data-id="' + d[y]['ID'] + '"><span><i class="glyphicon glyphicon-remove"></i></span></a></center>'   + tdf  
            	+ trf;
        }
        trs = tablei + theadi + theadf + tbodyi + trs   + tbodyf + tablef;
    }else{
        trs = tablei + theadi + theadf + tbodyi + tri  + nodata  + trf + tbodyf + tablef;
    }
    $(elemento).html(trs);
}

function resetEdicion(){
	setType('POST');
	$( "input[name='NAME']" ).val('');
	$("#msgUpdate").hide();

}


function fillTableFormatos(elemento,d){
    $(elemento).html('');
    trs = '';
	theadi = '<thead><tr><th>ID</th><th>TIPO PROYECTO</th><th>TIPO OFICIO</th><th>NOMBRE</th><th>Editar</th><th>Eliminar</th></tr></thead>';


    if(d.length > 0){
        for (var y = 0; y < d.length; y++) {
            trs += tri 
            	+ tdi + d[y]['ID_FORMATO']  + tdf 
            	+ tdi + d[y]['TIPO_PROYECTO']  + tdf 
            	+ tdi + d[y]['DESCRIP_OFICIO']  + tdf 
            	+ tdi + d[y]['FORMATOS_RECIBIDOS']  + tdf 
            	+ tdi + '<center><a class="btn btn-default btn-xs btnEditar" data-id="' + d[y]['ID_FORMATO'] + '"><span><i class="glyphicon glyphicon-pencil"></i></span></a></center>'   + tdf  
            	+ tdi + '<center><a class="btn btn-danger btn-xs btnEliminar" data-id="' + d[y]['ID_FORMATO'] + '"><span><i class="glyphicon glyphicon-remove"></i></span></a></center>'   + tdf  
            	+ trf;
        }
        trs = tablei + theadi + theadf + tbodyi + trs  + tbodyf + tablef;
    }else{
        trs = tri  + nodata  + trf;
    }
    $(elemento).html(trs);

}


function isInt(n){return Number(n) === n && n % 1 === 0;}

function isFloat(n){return Number(n) === n && n % 1 !== 0;}