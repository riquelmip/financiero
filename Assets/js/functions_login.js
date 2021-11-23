// Login Page Flipbox control
$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});
var contadorLogin = 0;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){
    if (document.querySelector('#formLogin')) {
        let formLogin = document.querySelector('#formLogin');
        formLogin.onsubmit = function(e){
            e.preventDefault();

            let strEmail = document.querySelector('#txtEmail').value;
            let strPassword = document.querySelector('#txtPassword').value;

         

            if (strEmail == "" || strPassword == "") {
                swal("Por favor", "Escriba Correo y/o Contraseña", "error");
                return false;
            }else{
                //mostrando loading
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Login/loginUser'; 
                var formData = new FormData(formLogin);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
                    if(request.readyState != 4) return;
                    if (request.status == 200) {
                        console.log(request.responseText);
                        var objData = JSON.parse(request.responseText);
                        //quitando el loading
                                    divLoading.style.display = "none";
                        if(objData.estado)
                        {
                            swal("Inicio de Sesión", objData.msg ,"success");
                            window.location = base_url+'/dashboard'
                        }else{
                            
                            contadorLogin++;
                            if (contadorLogin != 3) {
                                 swal("Atención!", "Intento "+contadorLogin+": "+objData.msg , "error");
                                 document.querySelector('#txtPassword').value = "";
                            }else{
                                 //mostrando loading
                                divLoading.style.display = "flex";
                                var request1 = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                                var ajaxUrl1 = base_url+'/Login/resetPassBloqueo'; 
                                var formData1 = new FormData(formLogin);
                                request1.open("POST",ajaxUrl1,true);
                                request1.send(formData1);
                                 request1.onreadystatechange = function(){
                                    if(request1.readyState != 4) return;
                                    if (request1.status == 200) {
                                         console.log(request1.responseText);
                                        var objData1 = JSON.parse(request1.responseText);
                                    
                                        if(objData1.estado)
                                        {
                                              //quitando el loading
                                    divLoading.style.display = "none";
                                            swal({
                                                title: "Atención!",
                                                text: "Intento "+contadorLogin+": " +objData1.msg,
                                                type: "error",
                                                //timer: 3000
                                            }, 
                                            function(){
                                                    window.location.href = base_url+'/Login';
                                            });
                                        }
                                    } else{
                                        swal("Atención!", "Error en el proceso" , "error");
                                    } //fin el on ready 2 péticion
                                  
                                 }
                               
                            } //fin else intentos
                           
                        }//fin else estado 1 petivcion
                    }else{
                        swal("Atención!", "Error en el proceso" , "error");
                    }
                    //quitando el loading
                    divLoading.style.display = "none";
                    return false;
                }
            }
        }
    }

    if (document.querySelector('#formResetPass')) {
        let formResetPass = document.querySelector('#formResetPass');
        formResetPass.onsubmit = function(e){
            e.preventDefault();

            let strEmail = document.querySelector('#txtEmailReset').value;
            if (strEmail == "") {
                swal("Por favor", "Escribe tu correo electrónico", "error");
                return false;
            }else{
                //poniendo el loading
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Login/resetPass'; 
                var formData = new FormData(formResetPass);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
                    if(request.readyState != 4) return;
                    if (request.status == 200) {
                        var objData = JSON.parse(request.responseText);
                        console.log(objData);
                        if(objData.estado)
                        {
                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false,
                            }, function(isConfirm){
                                if (isConfirm) {
                                    window.location = base_url;
                                }
                            });
                        }else{
                            swal("Atención!", objData.msg, "error");
                        }
                    }else{
                        swal("Atención!", "Error en el proceso" , "error");
                    }
                    divLoading.style.display = "none";
                    return false;
                }
            }
            
        }
    }

    if (document.querySelector('#formCambiarPass')) {
        let formCambiarPass = document.querySelector('#formCambiarPass');
        formCambiarPass.onsubmit = function(e){
            e.preventDefault();

            let strPassword = document.querySelector('#txtPassword').value;
            let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
            let idUsuario = document.querySelector('#idUsuario').value;
            let mensaje =  document.getElementById('msje');

            if (strPassword == "" || strPasswordConfirm == "") {
                swal("Por favor", "Escribe la nueva contraseña", "error");
                return false;
            }else{
                if(mensaje.textContent != '* Contraseña Segura'){

                    swal("Atención", "Contraseña Inválida" , "warning");
                    return false;
                }
                if (strPassword.length < 8) {
                    swal("Atención", "La contraseña debe de tener un mínimo de 8 caracteres", "info");
                    return false;
                }
                if (strPassword != strPasswordConfirm) {
                    swal("Atención", "Las contraseña no son iguales", "error");
                    return false;
                }else{
                    divLoading.style.display = "flex";
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Login/setPassword'; 
                    var formData = new FormData(formCambiarPass);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);

                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if (request.status == 200) {
                            var objData = JSON.parse(request.responseText);

                            if(objData.estado)
                            {
                                swal({
                                    title: "",
                                    text: objData.msg,
                                    type: "success",
                                    confirmButtonText: "Iniciar Sesión",
                                    closeOnConfirm: false,
                                }, function(isConfirm){
                                    if (isConfirm) {
                                        window.location = base_url+'/login';
                                    }
                                });
                            }else{
                                swal("Atención!", objData.msg, "error");
                            }
                        }else{
                            swal("Atención!", "Error en el proceso" , "error");
                            }
                            divLoading.style.display = "none";
                            return false;
                    }
                }
            }
        }
    }

}, false)


//CONTRASEÑA USUARIOS
$(function(){

    var mayus = new RegExp("^(?=.*[A-Z])");
    var numbers = new RegExp("^(?=.*[0-9])");
    var len = new RegExp("^(?=.{8,})");

    $("#txtPassword").on("keyup",function(){
        var pass = $("#txtPassword").val();

        if(!len.test(pass)){
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
