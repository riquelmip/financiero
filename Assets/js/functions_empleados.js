
var tableEmpleado;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){
    cargar_datos();

    
    $.mask.definitions['~']='[2,6,7]';
    $('#txtTelefono').mask("~999-9999");


   var formEmpleado = document.querySelector("#formEmpleado");
    formEmpleado.onsubmit = function(e) {
        e.preventDefault();       var mensaje1 =  document.getElementById('msje1');
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
        
            var strId = document.querySelector('#idEmpleado').value;
            var strDui = document.querySelector('#txtDui').value;
            var strNit = document.querySelector('#txtNit').value; 
            var strNombre = document.querySelector('#txtNombre').value;
            var strApellido =document.querySelector('#txtApellido').value;  
            var strDireccion = document.querySelector('#txtDireccion').value;
            var telefono = document.querySelector('#txtTelefono').value;
            var fecha = document.querySelector('#txtFecha').value;
            // var intestado = document.querySelector('#idEmpleado').value;
            var intCargo = document.querySelector('#listCargo').value;

        if(strDui == '' || strNit == '' || strNombre == '' || strApellido=='' || strDireccion=='' || telefono=='', fecha=='', intCargo=='')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Empleado/setEmpleado'; 
        var formData = new FormData(formEmpleado);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado)
                {
                    $('#modalFormEmpleado').modal("hide");
                    formEmpleado.reset();
                 
                    swal("Empleado", objData.msg ,"success");
                    cargar_datos();
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }
    
});



// $('#tableEmpleado').DataTable(); //ESTO NO LO TIENE

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

function fntViewEmpleado(idempleado){
    //let idempleado = idempleado;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Empleado/getEmpleado/'+idempleado;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.estado)
            {
               let estado = objData.data.estado == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';
                // let fecha= objData.data.dia + '/' + objData.data.mes + '/'+ objData.data.anio ;
                var mes="";
                var dia="";
                if(objData.data.mes>=1 && objData.data.mes<=9){
                    mes="0"+ objData.data.mes;
                }else{
                    mes=objData.data.mes;
                }
                if(objData.data.dia>=1 && objData.data.dia<=9){
                    dia="0"+ objData.data.dia;
                }else{
                    dia=objData.data.dia
                }
                var da=dia+"-"+mes+"-"+objData.data.anio;

  
                document.querySelector("#celDui").innerHTML = objData.data.dui;
                document.querySelector("#celNit").innerHTML = objData.data.nit;
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celApellido").innerHTML = objData.data.apellido;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celDireccion").innerHTML = objData.data.direccion;
                document.querySelector("#celFechaRegistro").innerHTML = da;
                document.querySelector("#celEstado").innerHTML = estado;
                document.querySelector("#celCargo").innerHTML = objData.data.nombrecargo; 
                $('#modalViewEmpleado').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function openModal(){
    document.querySelector('#idEmpleado').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Empleado";
    document.querySelector("#formEmpleado").reset();
    $('#modalFormEmpleado').modal('show');
    $('#listCargo').selectpicker('refresh');
}

// //METODO BORRAR
function fntDelEmpleado(idempleado,estad){

    var idempleado = idempleado;

    swal({
        title:"¿Desea dar baja a el Empleado?",
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
            var ajaxUrl = base_url+'/Empleado/delEmpleado';
        
        var strData ="idEmpleado="+idempleado+","+estad;
            
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estado)
                    {
                        swal("Cambio Realizado", objData.msg , "success");
                        cargar_datos();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}




// //METODO EDITAR

function fntEditEmpleado(idEmpleado){

    document.querySelector('#titleModal').innerHTML ="Actualizar Empleado";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idEmpleado = idEmpleado;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Empleado/getEmpleado/'+idEmpleado;
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado)
            {

                console.log("jjjj");
                // var ani = objData.data.anio;
                // var n = ani.toString();
                // var mes = objData.data.mes;
                // var m = mes.toString();
                // var dia = objData.data.dia;
                // var d= dia.toString();
                // var da =""+objData.data.anio+"-"+objData.data.mes+"-"+objData.data.dia;
                var mes="";
                var dia="";
                if(objData.data.mes>=1 && objData.data.mes<=9){
                    mes="0"+ objData.data.mes;
                }else{
                    mes=objData.data.mes;
                }
                if(objData.data.dia>=1 && objData.data.dia<=9){
                    dia="0"+ objData.data.dia;
                }else{
                    dia=objData.data.dia
                }
                var da=objData.data.anio+"-"+mes+"-"+dia;

  
         // var fecha=anio+ '-' + mes+ '-'+ dia ;
            document.querySelector('#idEmpleado').value=objData.data.idempleado;
            document.querySelector('#txtDui').value=objData.data.dui;
            document.querySelector('#txtNit').value=objData.data.nit; 
            document.querySelector('#txtNombre').value=objData.data.nombre;
            document.querySelector('#txtApellido').value=objData.data.apellido;  
            document.querySelector('#txtDireccion').value=objData.data.direccion;
            document.querySelector('#txtTelefono').value=objData.data.telefono;
             document.querySelector('#listaEstado').value=objData.data.estado;
            document.querySelector("#txtFecha").value = da;
            document.querySelector('#listCargo').value=objData.data.idcargo;
            $('#listCargo').selectpicker('refresh');
              $('#listCargo').selectpicker('render');

                $('#modalFormEmpleado').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

}



function cargar_datos(){
    divLoading.style.display = "flex";
    var datos = {"consultar_info":"si_consultala"}
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url+"/Empleado/getEmpleados",
        data : datos,
    }).done(function(json) {
        console.log("EL consultar",json);
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableEmpleado");
         document.querySelector('#listCargo').innerHTML = json.listacargos;
         $('#listCargo').selectpicker('refresh');
        $('#listCargo').selectpicker('render');

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
            {"data":"dui"},
            {"data":"nombre"},
            {"data":"apellido"},
            {"data":"nombrecargo"},
            {"data":"estado"},
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
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });
}
