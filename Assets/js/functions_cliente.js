
var tableClientes;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){


	tableClientes = $('#tableClientes').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Cliente/getClientes",
            "dataSrc":""

        },
        "columns":[
            {"data":"dui"},
            {"data":"nombre"},
            {"data":"telefono"},
            {"data":"opciones"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-primary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-primary"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-primary"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-primary"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    //NUEVO REGISTRO CLIENTE
    var formCliente = document.querySelector("#formCliente");
    formCliente.onsubmit = function(e) {
        e.preventDefault();

        var intIdcliente = document.querySelector('#idcliente').value;
        var strDui = document.querySelector('#txtDui').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strApellido = document.querySelector('#txtApellido').value;
        var strTelefono = document.querySelector('#txtTelefono').value;
        var intEstado = document.querySelector('#intEstado').value;
    
        var mensaje1 =  document.getElementById('msje1');
        var mensaje2 =  document.getElementById('msje2');

        if(mensaje1.textContent == '* Solo letras'){
            swal("Atención", "Campo Nombre solo permite letras." , "error");
            return false;
        }else{
            if(mensaje2.textContent == '* Solo letras'){
                swal("Atención", "Campo Apellido solo permite letras." , "error");
                return false;
            }   
        }

        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Cliente/setCliente'; 
        var formData = new FormData(formCliente);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado){

                    $('#modalFormCliente').modal("hide");
                    formCliente.reset();
                    swal("Datos Cliente", objData.msg ,"success");
                    tableClientes.api().ajax.reload();
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }
    }

});

$('#tableClientes').DataTable();


function openModal(){
   //static mask
    $("#msje2").text("");
    $("#msje1").text("");
    document.querySelector('#idcliente').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector("#formCliente").reset();
    //$('#txtDui').inputmask({mask: "99999999-9"});
    $('#modalFormCliente').modal('show');
   
}

function fntEditCliente(idcliente){
    document.querySelector('#titleModal').innerHTML ="Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idcliente = idcliente;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Cliente/getCliente/'+idcliente;
    request.open("GET",ajaxUrl ,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado){

                document.querySelector("#idcliente").value = objData.data.idcliente;
                document.querySelector("#txtDui").value = objData.data.dui;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                document.querySelector("#txtApellido").value = objData.data.apellido;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                $('#modalFormCliente').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

}

//SOLO LETRAS
$(function(){

    var mayus = new RegExp("^(?=.*[A-Z])");
    var lower = new RegExp("^(?=.*[a-z])");
     var numbers = new RegExp("^(?=.*[0-9])");
    $("#txtNombre").on("keyup",function(){
        var text = $("#txtNombre").val();

        if(mayus.test(text) || lower.test(text)){
            $("#msje1").text("");
        }else{
            $("#msje1").text("* Solo letras").css("color","red");
        }

        if(numbers.test(text)){
            $("#msje1").text("* Solo letras").css("color","red");
        }else{
            $("#msje1").text("");
        }
    });

    $("#txtApellido").on("keyup",function(){
        var text = $("#txtApellido").val();

        if(mayus.test(text) || lower.test(text)){
            $("#msje2").text("");
        }else{
            $("#msje2").text("* Solo letras").css("color","red");
        }

        if(numbers.test(text)){
            $("#msje2").text("* Solo letras").css("color","red");
        }else{
            $("#msje2").text("");
        }
    });

});

function fntDelCliente(idcliente){
    var idcliente = idcliente;
    swal({
        title: "Eliminar Cliente",
        text: "¿Realmente quiere eliminar el Registro?",
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
            var ajaxUrl = base_url+'/Cliente/delCliente/';
            var strData = "idcliente="+idcliente;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    
                    if(objData.estado)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableClientes.api().ajax.reload(function(){

                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}
