
var tableProveedor;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

   $.mask.definitions['~']='[2,6,7]';
    $('#txtNumero').mask("~999-9999");


    tableProveedor = $('#tableProveedor').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Proveedor/getproveedores",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"direccion"},
            {"data":"telefono"},
            {"data":"contacto_vendedor"},
            {"data":"estado"},
            {"data":"opciones"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

   

   var formProveedor = document.querySelector("#formProveedor");
    formProveedor.onsubmit = function(e) {
        e.preventDefault();

     var mensaje1 =  document.getElementById('msje1');
        var mensaje2 =  document.getElementById('msje2');

        if(mensaje1.textContent == '* Solo letras'){
            swal("Atención", "Campo Nombre solo permite letras." , "error");
            return false;
        }else{
            if(mensaje2.textContent == '* Solo letras'){
                swal("Atención", "Campo Contacto solo permite letras." , "error");
                return false;
            }   
        }


        var intIdProv = document.querySelector('#idProveedor').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strDescripcion = document.querySelector('#txtDescripcion').value;
        var intEstado = document.querySelector('#listaEstado').value;   
        var numero = document.querySelector('#txtNumero').value;
        var contacto = document.querySelector('#txtContacto').value;
        if(strNombre == '' || strDescripcion == '' || intEstado == '' || numero=='' || contacto=='')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Proveedor/setproveedor'; 
        var formData = new FormData(formProveedor);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado)
                {
                    $('#modalFormProveedores').modal("hide");
                    formProveedor.reset();
                 
                    swal("Proveedor", objData.msg ,"success");
                    tableProveedor.api().ajax.reload();
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }
    
});

$('#tableProveedor').DataTable();

//ABRIR MODAL

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

    $("#txtContacto").on("keyup",function(){
        var text = $("#txtContacto").val();

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

function openModal(){
    document.querySelector('#idProveedor').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Proveedor";
    document.querySelector("#formProveedor").reset();
    $('#modalFormProveedores').modal('show');
}

//METODO BORRAR
function fntDelproveedor(idprove){
    var idprove = idprove;
    swal({
        title: "¿Desea dar de baja al Proveedor?",
        text: "",
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
            var ajaxUrl = base_url+'/Proveedor/delproveedor/';
            var strData = "idproveedor="+idprove;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    console.log(objData);
                    if(objData.estado)
                    {
                        swal("Eliminado!", objData.msg , "success");
                        tableProveedor.api().ajax.reload(function(){

                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}


//METODO EDITAR

function fntEditproveedor(idproveedor){

    document.querySelector('#titleModal').innerHTML ="Actualizar Proveedor";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idproveedor = idproveedor;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Proveedor/getproveedor/'+idproveedor;
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado)
            {

               document.querySelector('#idProveedor').value=objData.data.idproveedor;
               document.querySelector('#txtNombre').value=objData.data.nombre;
               document.querySelector('#txtDescripcion').value=objData.data.direccion;
                document.querySelector('#listaEstado').value=objData.data.estado;   
               document.querySelector('#txtNumero').value=objData.data.telefono;
               document.querySelector('#txtContacto').value=objData.data.contacto_vendedor;

                if(objData.data.estado == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                                  <option value="1">Activo</option>
                                  <option value="0">Inactivo</option>
                                `;
                document.querySelector("#listaEstado").innerHTML = htmlSelect;
                $('#modalFormProveedores').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

}


