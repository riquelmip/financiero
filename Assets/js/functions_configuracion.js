var tableCargo;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	tableCargo = $('#tableConfiguracion').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Configuracion/getCargos",
            "dataSrc":""
        },
        "columns":[
            
            {"data":"tiempo_incobrable"},
            {"data":"opciones"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    //Nuevo Cargo
    var formCargos = document.querySelector("#formCargos");
    formCargos.onsubmit = function(e) {
        e.preventDefault();

        var intIdCat= document.querySelector('#id_configuracion').value;
        var strtiempo_incobrable = document.querySelector('#txttiempo_incobrable').value;
        
        if(strtiempo_incobrable == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Configuracion/setCargos'; 
        var formData = new FormData(formCargos);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado)
                {
                    
                    $('#modalFormCargos').modal("hide");
                    formCargos.reset();
                    
                    swal("Configuracion", objData.msg ,"success");
                    tableCargo.api().ajax.reload();

                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }

});

$('#tableConfiguracion').DataTable();

function openModal(){

    document.querySelector('#id_configuracion').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Configuracion";
    document.querySelector("#formCargos").reset();
	$('#modalFormCargos').modal('show');
}

window.addEventListener('load', function() {

}, false);

function fntEditCargos(idcat){
    document.querySelector('#titleModal').innerHTML ="Actualizar Configuracion";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idcat = idcat;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Configuracion/getCargo/'+idcat;
    
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado)
            {
                document.querySelector("#id_configuracion").value = objData.data.id_configuracion;
                document.querySelector("#txttiempo_incobrable").value = objData.data.tiempo_incobrable;
                $('#modalFormCargos').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

}

function fntDelCargos(idcate){
    var idcate = idcate;
    swal({
        title: "Eliminar Configuracion",
        text: "¿Realmente quiere eliminar la Configuracion?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Configuracion/delCargos/';
            var strData = "id_configuracion="+idcate;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    console.log(objData);
                    if(objData.estado)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableCargo.api().ajax.reload(function(){

                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}



