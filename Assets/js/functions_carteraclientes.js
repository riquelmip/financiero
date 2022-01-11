var tableClientes;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function () {
    cargar_datos();
});

function persona_naturalA() {
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalA",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");

    })
        .fail(function (json) { })
        .always(function () {

        });
}


function fntViewUsuario(idpersona){
    console.log("Dato");
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Carteraclientes/getUsuario/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.estado)
            {

                console.log(objData);
                document.querySelector("#celDui").innerHTML = objData.data.codigo_persona_natural;
                document.querySelector("#celNit").innerHTML = objData.data.nombre_completo;
                document.querySelector("#celNombre").innerHTML = objData.data.direccion_persona_natural;
                document.querySelector("#celApellido").innerHTML = objData.data.telefono_persona_natural;
                document.querySelector("#celTelefono").innerHTML = objData.data.dui_persona_natural;
                document.querySelector("#celEmail").innerHTML = objData.data.estado_civil_persona_natural;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.lugar_trabajo_persona_natural;
                document.querySelector("#celEstado").innerHTML = objData.data.ingreso_persona_natural;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.egresos_persona_natural;
                document.querySelector("#celBoleta").innerHTML = objData.data.id_boleta_de_pago__persona_natural;
                document.querySelector("#celcategoria").innerHTML = objData.data.categoria;  
                $('#modalViewUser').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntViewUsuario2(idpersona){
    console.log("Dato");
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Carteraclientes/getUsuario2/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.estado)
            {
                console.log(objData);
                document.querySelector("#celDui2").innerHTML = objData.data.codigo_persona_juridica;
                document.querySelector("#celNit2").innerHTML = objData.data.nombre_empresa_persona_juridica;
                document.querySelector("#celNombre2").innerHTML = objData.data.direccion_persona_juridica;
                document.querySelector("#celApellido2").innerHTML = objData.data.idtelefono_persona_juridica;
                document.querySelector("#celTelefono2").innerHTML = objData.data.idbalancegeneral_persona_juridica;
                document.querySelector("#celEmail2").innerHTML = objData.data.idestadoresultado_persona_juridica;
                document.querySelector("#celTipoUsuario2").innerHTML = objData.data.categoria;
                $('#modalViewUser2').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}


function persona_juridicaA() {
    document.getElementById('tabla1').style.display = 'none';
    document.getElementById('tabla2').style.display = '';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/PersonaJuridicaA",
        data: datos,
    })
        .done(function (json) {
            $("#datos_tabla_juridica").empty().html(json.htmlDatosTabla);
            inicializar_tabla2("tableClientesJuridica");

        })
        .fail(function (json) { })
        .always(function () {

        });
}


function persona_naturalB() {
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalB",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");

    })
        .fail(function (json) { })
        .always(function () {

        });
}


function persona_juridicaB() {
    document.getElementById('tabla1').style.display = 'none';
    document.getElementById('tabla2').style.display = '';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/PersonaJuridicaB",
        data: datos,
    })
        .done(function (json) {
            $("#datos_tabla_juridica").empty().html(json.htmlDatosTabla);
            inicializar_tabla2("tableClientesJuridica");

        })
        .fail(function (json) { })
        .always(function () {

        });
}


function persona_naturalC() {
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalC",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");

    })
        .fail(function (json) { })
        .always(function () {

        });
}


function persona_juridicaC() {
    document.getElementById('tabla1').style.display = 'none';
    document.getElementById('tabla2').style.display = '';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/PersonaJuridicaC",
        data: datos,
    })
        .done(function (json) {
            $("#datos_tabla_juridica").empty().html(json.htmlDatosTabla);
            inicializar_tabla2("tableClientesJuridica");

        })
        .fail(function (json) { })
        .always(function () {

        });
}


function persona_naturalD() {
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalD",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");

    })
        .fail(function (json) { })
        .always(function () {

        });
}


function persona_juridicaD() {
    document.getElementById('tabla1').style.display = 'none';
    document.getElementById('tabla2').style.display = '';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/PersonaJuridicaD",
        data: datos,
    })
        .done(function (json) {
            $("#datos_tabla_juridica").empty().html(json.htmlDatosTabla);
            inicializar_tabla2("tableClientesJuridica");

        })
        .fail(function (json) { })
        .always(function () {

        });
}





function clientea() {
    document.getElementById('botones1').style.display = '';
    document.getElementById('botones2').style.display = 'none';
    document.getElementById('botones3').style.display = 'none';
    document.getElementById('botones4').style.display = 'none';
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalA",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");

    })
        .fail(function (json) { })
        .always(function () {

        });
}


function clienteb() {
    document.getElementById('botones1').style.display = 'none';
    document.getElementById('botones2').style.display = '';
    document.getElementById('botones3').style.display = 'none';
    document.getElementById('botones4').style.display = 'none';
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalB",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");

    })
        .fail(function (json) { })
        .always(function () {

        });
}


function clientec() {
    document.getElementById('botones1').style.display = 'none';
    document.getElementById('botones2').style.display = 'none';
    document.getElementById('botones3').style.display = '';
    document.getElementById('botones4').style.display = 'none';
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalC",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");
    })
        .fail(function (json) { })
        .always(function () {
        });
}

function cliented() {
    document.getElementById('botones1').style.display = 'none';
    document.getElementById('botones2').style.display = 'none';
    document.getElementById('botones3').style.display = 'none';
    document.getElementById('botones4').style.display = '';
    document.getElementById('tabla1').style.display = '';
    document.getElementById('tabla2').style.display = 'none';
    var datos = { consultar_info: "si_consultala" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalD",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");
    })
        .fail(function (json) { })
        .always(function () {
        });
}









window.addEventListener('load', function () {
    document.getElementById('botones1').style.display = '';
    document.getElementById('botones2').style.display = 'none';
    document.getElementById('botones3').style.display = 'none';
    document.getElementById('botones4').style.display = 'none';
    document.getElementById('tabla2').style.display = 'none';
}, false);

function cargar_datos() {
    divLoading.style.display = "flex";
    var datos = { "consultar_info": "si_consultala" }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url + "/Carteraclientes/personanaturalA",
        data: datos,
    }).done(function (json) {
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableClientes");
    }).fail(function () {
    }).always(function () {
        divLoading.style.display = "none";
    });
}

function alerta_recargartabla(titulo, mensaje, tipo) {
    swal({
        title: titulo,
        text: mensaje,
        type: tipo,
        //timer: 3000
    },
        function () {
            cargar_datos();
        });

}

function inicializar_tabla(tabla) {
    $('#' + tabla).dataTable({
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
        "columns": [
            { "data": "codigo_persona_natural" },
            { "data": "dui_persona_natural" },
            { "data": "nombre_completo" },
            
            { "data": "categoria" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-primary"
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-primary"
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-primary"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-primary"
            }
        ],
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });
}
function inicializar_tabla2(tabla) {
    $('#' + tabla).dataTable({
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
        "columns": [


            { "data": "codigo_persona_juridica" },
            { "data": "nombre_empresa_persona_juridica" },
            { "data": "categoria" },
            { "data": "options" }

        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-primary"
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-primary"
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-primary"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-primary"
            }
        ],
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });
}
