var tbl = 0;
var name = '';
var url = '';
var params = {};
var myToast;
var msg = {};
var type = 'POST';
var item = 0;
var itemS = 0;
var show = false;

function setMsgUpdate(show){
    if(show){
        $('#msgUpdate').show();
    }else{
        $('#msgUpdate').hide();
    }
}

function setUrl(url){
    this.url = url;
}

function getUrl(){
    return this.url;
}

function setType(type){
    this.type = type;
}

function getType(){
    return this.type;
}

function setMsg(msg,tipo){
    tipo = typeof tipo !== 'undefined' ? tipo : 0;
    if(tipo == 0){
        this.msg = msg;
    }else if(tipo == 1){
        // Obteniendo Información
        this.msg = {head : 'Información',text :'Obteniendo datos' ,icon : 'info',hideA : false};
    }else if(tipo == 2){
        // Guardando Información
        this.msg = {head : 'Información',text : 'Guardando datos' ,icon : 'info',hideA : false};
    }else if(tipo == 3){
        // Actualizando Información
        this.msg = {head : 'Información',text : 'Actualizando datos' ,icon : 'warning',hideA : false};
    }else if(tipo == 4){
        // Eliminando Información
        this.msg = {head : 'Información',text : 'Eliminando datos' ,icon : 'warning',hideA : false};
    }
}

function getMsg(){
    return this.msg;
}


function setTable(tbl){
    this.tbl = tbl;
}

function getTable(){
    return this.tbl;
}

function setName(name){
    this.name = name;
}

function getName(){
    return this.name;
}

function setParams(params){
    this.params = params;
}

function getParams(){
    return this.params;
}

function setItem(item){
    this.item = item;
}

function getItem(){
    return this.item
}


function setItemSecundario(item){
    this.itemS = item;
}

function getItemSecundario(){
    return this.itemS;
}


function sendAjax(){
    msg = getMsg();
    return $.ajax({
            data:  getParams(),
            url:   getUrl(),
            type:  getType(),
            beforeSend: function () {
                getToast();
            },
            success:  function (response) {
                resetToast()
            }
    });


}

function getToast(){
    msg = getMsg();
    $.toast({
        heading: msg.head,
        text: msg.text,
        icon: msg.icon,
        hideAfter: msg.hidA,
        position : 'mid-center'
    });
}

function resetToast(tout){
    tout = typeof tout !== 'undefined' ? tout : 0;
    setTimeout(function(){ 
        $.toast().reset('all');
    }, tout);
}

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(typeof haystack[i] == 'object') {
            if(arrayCompare(haystack[i], needle)) return true;
        } else {
            if(haystack[i] == needle) return true;
        }
    }
    return false;
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

jQuery(document).ready(function($) {
       // hideDivs();

        jQuery( ".select" ).change(function() {
            sID = $(this).attr("id");
            val = $( "#" + sID + " option:selected" ).val();
            if(val == -1){
                hideSelect(sID);
                showDiv(sID);
            }

        });

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

});
    