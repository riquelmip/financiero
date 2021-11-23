var tableCargo;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	tableCargo = $('#tableCargo').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Cargos/getCargos",
            "dataSrc":""
        },
        "columns":[
            
            {"data":"nombre"},
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

        var intIdCat= document.querySelector('#idCargo').value;
        var strNombre = document.querySelector('#txtNombre').value;
        
        if(strNombre == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Cargos/setCargos'; 
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
                    
                    swal("Cargos", objData.msg ,"success");
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

$('#tableCargo').DataTable();

function openModal(){

    document.querySelector('#idCargo').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Cargo";
    document.querySelector("#formCargos").reset();
	$('#modalFormCargos').modal('show');
}

window.addEventListener('load', function() {

}, false);

function fntEditCargos(idcat){
    document.querySelector('#titleModal').innerHTML ="Actualizar Cargo";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idcat = idcat;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Cargos/getCargo/'+idcat;
    
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado)
            {
                document.querySelector("#idCargo").value = objData.data.idcargo;
                document.querySelector("#txtNombre").value = objData.data.nombre;
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
        title: "Eliminar Cargo",
        text: "¿Realmente quiere eliminar el Cargo?",
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
            var ajaxUrl = base_url+'/Cargos/delCargos/';
            var strData = "idcargo="+idcate;
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



