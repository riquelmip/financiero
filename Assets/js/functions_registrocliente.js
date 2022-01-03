var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function () {
    var formregistroclientente = document.querySelector("#formregistrocliente");
    formregistroclientente.onsubmit = function (e) {
        e.preventDefault();
        console.log('ENTRA');
        console.log(document.querySelector('#codigocliente').value);
        var datomodificador = document.querySelector('#bandera').value;
        console.log(datomodificador);
        if (datomodificador == 1) {
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Registrocliente/setRegistroClienteNatural';
            var formData = new FormData(formregistroclientente);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {

                    var objData = JSON.parse(request.responseText);
                    if (objData.estado) {
                        swal("Datos Cliente", objData.msg, "success");

                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        } else {
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Registrocliente/setRegistroClienteJuridico';
            var formData = new FormData(formregistroclientente);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {

                    var objData = JSON.parse(request.responseText);
                    if (objData.estado) {
                        swal("Datos Cliente", objData.msg, "success");

                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }

    }


});






window.addEventListener('load', function () {
    document.getElementById('variablejuridica').style.display = 'none';
    document.getElementById('variablejuridica2').style.display = 'none';
    document.getElementById('variablejuridica3').style.display = 'none';
    document.getElementById('variablejuridica4').style.display = 'none';
    $.ajax({
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

    });
}, false);





$(document).on("change", "#radio1", function (e) {
    var radio1 = $("#radio1").val();
    document.querySelector('#bandera').value = 1;
    document.getElementById('dato').innerHTML = "<i class='fas fa-user-check' style='color: black; '></i>Registro de Cliente Persona Natural";
    document.getElementById('variablenatural').style.display = '';
    document.getElementById('variablenatural2').style.display = '';
    document.getElementById('variablenatural3').style.display = '';
    document.getElementById('variablenatural4').style.display = '';
    document.getElementById('variablenatural5').style.display = '';
    document.getElementById('variablenatural6').style.display = '';
    document.getElementById('variablejuridica').style.display = 'none';
    document.getElementById('variablejuridica2').style.display = 'none';
    document.getElementById('variablejuridica3').style.display = 'none';
    document.getElementById('variablejuridica4').style.display = 'none';


   
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Registrocliente/getCodigoPN",

    }).done(function (json) {
        if (json.datosIndividuales > 9 && json.datosIndividuales <= 99) {
            document.querySelector('#codigocliente').value = 'PN-0' + json.datosIndividuales;
        } else if (json.datosIndividuales > 99) {
            document.querySelector('#codigocliente').value = 'PN-' + json.datosIndividuales;
        } else if (json.datosIndividuales > 1 && json.datosIndividuales <= 9) {
            document.querySelector('#codigocliente').value = 'PN-00' + json.datosIndividuales;
        } else {
            document.querySelector('#codigocliente').value = json.datosIndividuales;
        }

    }).fail(function () {

    }).always(function () {

    });



});

$(document).on("change", "#radio2", function (e) {
    var radio2 = $("#radio2").val();
  document.querySelector('#bandera').value = 2;
  document.getElementById('dato').innerHTML = "<i class='fas fa-user-check' style='color: black; '></i>Registro de Cliente Persona Juridica";

  document.getElementById('variablenatural').style.display = 'none';
  document.getElementById('variablenatural2').style.display = 'none';
  document.getElementById('variablenatural3').style.display = 'none';
  document.getElementById('variablenatural4').style.display = 'none';
  document.getElementById('variablenatural5').style.display = 'none';
  document.getElementById('variablenatural6').style.display = 'none';
  document.getElementById('variablejuridica').style.display = '';
  document.getElementById('variablejuridica2').style.display = '';
  document.getElementById('variablejuridica3').style.display = '';
  document.getElementById('variablejuridica4').style.display = '';

    
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Registrocliente/getCodigoPJ",

    }).done(function (json) {
        console.log(json.datosIndividuales);
        if (json.datosIndividuales > 9 && json.datosIndividuales <= 99) {
            document.querySelector('#codigoclientejuridico').value = 'PJ-0' + json.datosIndividuales;
        } else if (json.datosIndividuales > 99) {
            document.querySelector('#codigoclientejuridico').value = 'PJ-' + json.datosIndividuales;
        } else if (json.datosIndividuales > 1 && json.datosIndividuales <= 9) {
            document.querySelector('#codigoclientejuridico').value = 'PJ-00' + json.datosIndividuales;
        } else {
            document.querySelector('#codigoclientejuridico').value = json.datosIndividuales;
        }

    }).fail(function () {

    }).always(function () {

    });



});



