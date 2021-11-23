
var tableUnidad;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    tableUnidad = $('#tableUnidad').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Unidadmedida/getunidades",
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

   

   var formUnidades = document.querySelector("#formUnidades");
    formUnidades.onsubmit = function(e) {
        e.preventDefault();

        var intId = document.querySelector('#idunidad').value;
        var strNombre = document.querySelector('#txtNombre').value;

        if(strNombre == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Unidadmedida/setUnidad'; 
        var formData = new FormData(formUnidades);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado)
                {
                    $('#modalFormUnidades').modal("hide");
                    formUnidades.reset();
                 
                    swal("Unidad de Medida", objData.msg ,"success");
                    tableUnidad.api().ajax.reload();
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }
    
});

$('#tableUnidad').DataTable();

// //ABRIR MODAL

function openModal(){
    document.querySelector('#idunidad').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Unidad de Medida";
    document.querySelector("#formUnidades").reset();
    $('#modalFormUnidades').modal('show');
}

// //METODO BORRAR
function fntDelunidad(idUnidad){
    var idUnidad = idUnidad;
    swal({
        title: "Eliminar Unidad",
        text: "¿Realmente quiere eliminar la Unidad de Medida?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Unidadmedida/delUnidad/';
            var strData = "idunidad="+idUnidad;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    console.log(objData);
                    if(objData.estado)
                    {
                        swal("Eliminada!", objData.msg , "success");
                        tableUnidad.api().ajax.reload(function(){

                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}


// //METODO EDITAR

function fntEditUnidad(idunidad){

    document.querySelector('#titleModal').innerHTML ="Actualizar Unidad";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idunidad = idunidad;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Unidadmedida/getUnidad/'+idunidad;
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado)
            {

               document.querySelector('#idunidad').value=objData.data.idunidad;
               document.querySelector('#txtNombre').value=objData.data.nombre;
 
                $('#modalFormUnidades').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

}


