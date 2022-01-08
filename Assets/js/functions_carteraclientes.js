
var tableClientes;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    cargar_datos();


    //NUEVO REGISTRO CLIENTE
    var formCliente = document.querySelector("#formCliente");
    formCliente.onsubmit = function(e) {
        e.preventDefault();

        var intcodigo_cliente_natural = document.querySelector('#codigo_cliente_natural').value;
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




function openModal(){
   //static mask
    $("#msje2").text("");
    $("#msje1").text("");
    document.querySelector('#codigo_cliente_natural').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector("#formCliente").reset();
    //$('#txtDui').inputmask({mask: "99999999-9"});
    $('#modalFormCliente').modal('show');
   
}


function persona_juridica() {
    document.getElementById('tabla1').style.display = 'none';
    document.getElementById('tabla2').style.display = '';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
            dataType: "json",
            method: "POST",
            url: base_url + "/Carteraclientes/getProductos2",
            data: datos,
        })
        .done(function(json) {
            //console.log("EL consultar novedad", json);
            console.log("EL consultar",json);
            $("#datos_tabla_juridica").empty().html(json.htmlDatosTabla);
            inicializar_tabla2("tableClientesJuridica");
            
        })
        .fail(function(json) {})
        .always(function() {
        
        });
}

function persona_natural() {
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url+"/Carteraclientes/getProductos",
        data : datos,
    }).done(function(json) {
        console.log("EL consultar",json);
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");
            
        })
        .fail(function(json) {})
        .always(function() {
        
        });
}


window.addEventListener('load', function () {
    document.getElementById('tabla2').style.display = 'none';

  /*  $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Registrocliente/getCodigoPN",

    }).done(function (json) {
        console.log("EL consultar", json);
        if (json.datosIndividuales > 9 && json.datosIndividuales <= 99) {
            document.querySelector('#codigocliente').value = 'PN-0' + json.datosIndividuales;
        } else if (json.datosIndividuales > 99) {
            document.querySelector('#codigocliente').value = 'PN-' + json.datosIndividuales;
        } else if (json.datosIndividuales > 1 && json.datosIndividuales <= 9) {
            document.querySelector('#codigocliente').value = 'PN-00' + json.datosIndividuales;
        } else {
            document.querySelector('#codigocliente').value = json.datosIndividuales;
        }
        document.getElementById('dato').innerHTML = "<i class='fas fa-user-check' style='color: black; '></i>Registro de Cliente Persona Natural";
    }).fail(function () {

    }).always(function () {

    });*/
}, false);




function fntEditCliente(codigo_cliente_natural){
    document.querySelector('#titleModal').innerHTML ="Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var codigo_cliente_natural = codigo_cliente_natural;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Cliente/getCliente/'+codigo_cliente_natural;
    request.open("GET",ajaxUrl ,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado){

                document.querySelector("#codigo_cliente_natural").value = objData.data.codigo_cliente_natural;
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

function fntDelCliente(codigo_cliente_natural){
    var codigo_cliente_natural = codigo_cliente_natural;
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
            var strData = "codigo_cliente_natural="+codigo_cliente_natural;
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

function cargar_datos(){
    divLoading.style.display = "flex";
    var datos = {"consultar_info":"si_consultala"}
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url+"/Carteraclientes/getProductos",
        data : datos,
    }).done(function(json) {
        console.log("EL consultar",json);
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");
        
         

    }).fail(function(){

    }).always(function(){
        divLoading.style.display = "none";
    });
}

function alerta_recargartabla(titulo, mensaje, tipo){
    swal({
        title: titulo,
        text: mensaje,
        type: tipo,
        //timer: 3000
    }, 
    function(){
            cargar_datos();
    });

}

function inicializar_tabla(tabla){
    $('#'+tabla).dataTable( {
        "responsive": true,
        "aServerSide": true,
        "autoWidth": false,
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "paging": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
        "columns":[
            {"data":"codigo_persona_natural"},
            {"data":"dui_persona_natural"},
            {"data":"nombre_completo"},
            {"data":"direccion_persona_natural"},
            {"data":"telefono_persona_natural"},
            {"data":"estado_civil_persona_natural"},
            {"data":"lugar_trabajo_persona_natural"},
            {"data":"ingreso_persona_natural"},
            {"data":"egresos_persona_natural"},
            {"data":"id_boleta_de_pago__persona_natural"},
            {"data":"categoria"},
            {"data":"options"}
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
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });
}
function inicializar_tabla2(tabla){
    $('#'+tabla).dataTable( {
        "responsive": true,
        "aServerSide": true,
        "autoWidth": false,
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "paging": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
        "columns":[


            {"data":"codigo_persona_juridica"},
            {"data":"nombre_empresa_persona_juridica"},
            {"data":"direccion_persona_juridica"},
            {"data":"idtelefono_persona_juridica"},
            {"data":"idbalancegeneral_persona_juridica"},
            {"data":"idestadoresultado_persona_juridica"},
            {"data":"categoria"},
            {"data":"options"}

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
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });
}
