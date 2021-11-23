

let tableUsuarios;
let rowTable = "";
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

 
    tableUsuarios = $('#tableUsuarios').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"apellido"},
            {"data":"email_usuario"},
            {"data":"telefono"},
            {"data":"nombrerol"},
            {"data":"estado"},
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
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    //NUEVO USUARIO
    if (document.querySelector("#formUsuario")) {
        let formUsuario = document.querySelector("#formUsuario");
            formUsuario.onsubmit = function(e) {
                e.preventDefault();
            
                let intEmpleado = document.querySelector("#listEmpleados").value;
                let strEmail = document.querySelector('#txtEmail').value;
                let strPassword = document.querySelector('#txtPassword').value;
                let intTipousuario = document.querySelector('#listRolid').value;
                let intStatus = document.querySelector("#listEstado").value;
                var mensaje =  document.getElementById('msje');
                

                if(strEmail == '' || intTipousuario == '' || intEmpleado == '')
                {
                    swal("Atención", "Todos los campos son obligatorios." , "error");
                    return false;
                }

                if(mensaje.textContent==''){
                    
                }else if(mensaje.textContent != '* Contraseña Segura'){

                    swal("Atención", "Contraseña Inválida" , "warning");
                    return false;
                } 

                let elementsValid = document.getElementsByClassName("valid");
                for (let i = 0; i < elementsValid.length; i++) { 
                    if(elementsValid[i].classList.contains('is-invalid')) { 
                        swal("Atención", "Por favor verifique los campos en rojo." , "error");
                        return false;
                    } 
                } 
                divLoading.style.display = "flex";
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url+'/Usuarios/setUsuario'; 
                let formData = new FormData(formUsuario);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
                    if(request.readyState == 4 && request.status == 200){
                        let objData = JSON.parse(request.responseText);
                        if(objData.estado)
                        {
                            //si la fila esta vacia o no existe, es porque estamos creando nuevo registro
                            if (rowTable == "") {
                                //entonces vamos a actualizar la tabla
                                tableUsuarios.api().ajax.reload();
                                $('#modalFormUsuario').modal("hide");
                                formUsuario.reset();
                                swal("Usuarios", objData.msg ,"success");
                            }else{
                                //si estamos actualizando un registro, entonces simularemos que pondremos todos los datos en esa fila, pero sin recargar la tabla
                               // htmlStatus = intStatus == 1 ? //si es igual a 1 es decir que es actuivo
                                //'<span class="badge badge-success">Activo</span>' : 
                                //'<span class="badge badge-danger">Inactivo</span>';
                               // rowTable.cells[1].textContent=strNombre;
                               // rowTable.cells[2].textContent=strApellido;
                               // rowTable.cells[3].textContent=strEmail;
                                //rowTable.cells[4].textContent=intTelefono;
                               // rowTable.cells[5].textContent=document.querySelector("#listRolid").selectedOptions[0].text; //obtenemos el texto que esta enel option seleccionado
                               // rowTable.cells[6].innerHTML = htmlStatus;
                               // rowTable="";
                               $('#modalFormUsuario').modal("hide");
                               formUsuario.reset();
                               //swal("Usuarios", objData.msg ,"success");
                                swal({
                                    title: "Usuarios",
                                    text: objData.msg,
                                    type: "success",
                                    //timer: 3000
                                }, 
                                function(){
                                        window.location.href = base_url+'/Usuarios';
                                });
                            }
                           
                            
                        }else{
                            swal("Error", objData.msg , "error");
                        }
                    }
                    divLoading.style.display = "none";
                    return false;
                }

            }
    }
    //ACTUALIZAR PERFIL
    if (document.querySelector("#formPerfil")) {
        

        let formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function(e) {
                e.preventDefault();
                let strIdentificacion = document.querySelector('#txtIdentificacion').value;
                let strNombre = document.querySelector('#txtNombre').value;
                let strApellido = document.querySelector('#txtApellido').value;   
                let intTelefono = document.querySelector('#txtTelefono').value;
                let strPassword = document.querySelector('#txtPassword').value;
                let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
    
                if(strIdentificacion == '' || strApellido == '' || strNombre == '' || intTelefono == '')
                {
                    swal("Atención", "Todos los campos son obligatorios." , "error");
                    return false;
                }

                if (strPassword != "" || strPasswordConfirm != "") {
                    if (strPassword != strPasswordConfirm) {
                        swal("Atención", "Las contraseñas no son iguales." , "error");
                        return false;
                    }
                    if (strPassword.length < 5) {

                        swal("Atención", "La contraseña debe de tener un minimo de 5 caracteres." , "error");
                        return false;
                    }
                }
    
                //Validaciones de los campos
                let elementsValid = document.getElementsByClassName("valid");
                for (let i = 0; i < elementsValid.length; i++) { 
                    if(elementsValid[i].classList.contains('is-invalid')) { 
                        swal("Atención", "Por favor verifique los campos en rojo." , "error");
                        return false;
                    } 
                } 
                divLoading.style.display = "flex";
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url+'/Usuarios/putPerfil'; 
                let formData = new FormData(formPerfil);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
                    if (request.readyState != 4) return;
                    if(request.status == 200){
                        let objData = JSON.parse(request.responseText);
                        if(objData.status)
                        {
                            $('#modalFormPerfil').modal("hide");
                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false,
                            }, function(isConfirm){
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        }else{
                            swal("Error", objData.msg , "error");
                        }
                    }
                    divLoading.style.display = "none";
                    return false;
                }
    
            }
        }

         //ACTUALIZAR DATOS FISCALES
    if (document.querySelector("#formDataFiscal")) {
        
    

        let formDataFiscal = document.querySelector("#formDataFiscal");
        formDataFiscal.onsubmit = function(e) {
                e.preventDefault();
                let strNit = document.querySelector('#txtNit').value;
                let strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
                let strDirFiscal = document.querySelector('#txtDirFiscal').value;   
              
                if(strNit == '' || strNombreFiscal == '' || strDirFiscal == '' )
                {
                    swal("Atención", "Todos los campos son obligatorios." , "error");
                    return false;
                }

                divLoading.style.display = "flex";
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url+'/Usuarios/putDFiscal'; 
                let formData = new FormData(formDataFiscal);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
                    if (request.readyState != 4) return;
                    if(request.status == 200){
                        let objData = JSON.parse(request.responseText);
                        if(objData.status)
                        {
                            $('#modalFormPerfil').modal("hide");
                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false,
                            }, function(isConfirm){
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        }else{
                            swal("Error", objData.msg , "error");
                        }
                    }
                    divLoading.style.display = "none";
                    return false;
                }
    
            }
        }
}, false);

   
    


window.addEventListener('load', function() {
        fntSelects();
}, false);




function fntSelects(){
    if (document.querySelector('#listRolid')) {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Usuarios/getSelects';
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
    
                
                document.querySelector('#listRolid').innerHTML = objData.roles;
                $('#listRolid').selectpicker('render');
                document.querySelector('#listEmpleados').innerHTML = objData.empleados;
                $('#listEmpleados').selectpicker('render');
              
            }
        }
    }
       
}

function fntViewUsuario(idpersona){
    //let idpersona = idpersona;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.estado)
            {
               let estadoUsuario = objData.data.estado == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';
                console.log(objData);
                document.querySelector("#celDui").innerHTML = objData.data.dui;
                document.querySelector("#celNit").innerHTML = objData.data.nit;
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celApellido").innerHTML = objData.data.apellido;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email_usuario;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.datecreated; 
                $('#modalViewUser').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}



function fntEditUsuario(element, idpersona){
    rowTable=element.parentNode.parentNode.parentNode;//dirigiendose al elemento padre, 3 elementos padre para dirgirse a la fila
    //rowTable.cells[1].textContent="julio";
    console.log(rowTable);
    document.querySelector('#titleModal').innerHTML ="Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";



    //let idpersona =idpersona;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.estado)
            {
                document.querySelector("#idUsuario").value = objData.data.idusuario;
                document.querySelector("#txtEmail").value = objData.data.email_usuario;
                document.querySelector("#listRolid").value =objData.data.idrol;
                $('#listRolid').selectpicker('render');
                document.querySelector("#listEmpleados").value =objData.data.idempleado;
                $('#listEmpleados').selectpicker('render');
                

                if(objData.data.estado == 1){
                    document.querySelector("#listEstado").value = 1;
                }else{
                    document.querySelector("#listEstado").value = 2;
                }
                $('#listEstado').selectpicker('render');
            }
        }
    
        $('#modalFormUsuario').modal('show');
    }
}

function fntDelUsuario(idusuario){

    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/delUsuario';
            let strData = "idUsuario="+idusuario;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estado)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableUsuarios.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}


function openModal()
{
    
    rowTable="";
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}


//PERFIL USUARIO

function openModalPerfil(){
    $('#modalFormPerfil').modal('show');
}

//CONTRASEÑA USUARIOS
$(function(){

    var mayus = new RegExp("^(?=.*[A-Z])");
    var numbers = new RegExp("^(?=.*[0-9])");
    var len = new RegExp("^(?=.{8,})");
    

    $("#txtPassword").on("keyup",function(){
        var pass = $("#txtPassword").val();
         var btn =  document.getElementById('btnText'); 

        if(btn.textContent=="Actualizar" && pass==''){
           $("#msje").text("");
        }else if(!len.test(pass)){
            $("#msje").text("* Digite una contraseña mínima a 8 caracteres").css("color","red");
        }else{
            $("#msje").text("");
             if(!numbers.test(pass)){
                $("#msje").text("* Digite al menos un número").css("color","red");
            }else{
                $("#msje").text("");
                if(!mayus.test(pass)){
                    $("#msje").text("* Digite al menos una letra Mayúscula").css("color","red");
                }else{
                    $("#msje").text("* Contraseña Segura").css("color","green");
                    
                }
            }
        }
    });

});
