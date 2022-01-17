
var tableCreditos;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){
    persona_natural();
});

$('#tableCreditos').DataTable();

function persona_natural(){
   
    tableCreditos = $('#tableCreditos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Creditos/getCreditos",
            "dataSrc":""

        },
        "columns":[
            {"data":"dui"},
            {"data":"nombreCliente"},
            {"data":"descripcion"},
            {"data":"fecha_inicio"},
            {"data":"total"},
            {"data":"opciones"}
        ],
        'dom': '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap"B>><"col-sm-12 col-md-4"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
}

function persona_juridica(){
   
    tableCreditos = $('#tableCreditos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Creditos/getCreditosDos",
            "dataSrc":""

        },
        "columns":[
            {"data":"dui"},
            {"data":"nombreCliente"},
            {"data":"descripcion"},
            {"data":"fecha_inicio"},
            {"data":"total"},
            {"data":"opciones"}
        ],
        'dom': '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap"B>><"col-sm-12 col-md-4"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
}
  function decimalAdjust(type, value, exp) {
    // Si el exp no está definido o es cero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si el valor no es un número o el exp no es un entero...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }

$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

function fntVerPagos(iddetalle){

  var datos = { "iddetalle": iddetalle,"estado":1};
  console.log(iddetalle);
  $.ajax({
    dataType: "json",
    method: "POST",
    url: base_url + "/Creditos/getPagos",
    data: datos,
  })
    .done(function (json) {
        console.log(json); 
      $('#tablePagos').DataTable().destroy();
      $("#datos_tabla_pago").empty().html(json.htmlDatosTabla);
      inicializar_tabla1("tablePagos");
    })
    .fail(function () {})
    .always(function () {
    });

    $('#modalVerPagos').modal('show');

}



function verNotaCredito(idventa){

  window.open(base_url+"/Consultas/imprimirnotaCREDITO/"+idventa);
}

function fntPagosCredito(iddetalle){

  var datos = { "iddetalle": iddetalle};
  $.ajax({
    dataType: "json",
    method: "POST",
    url: base_url + "/Creditos/getCredito",
    data: datos,
  })
    .done(function (json) {
        console.log(json);
      $("#nombreProducto").empty().html(json['datosIndividuales'][0].descripcion);
      $('#tablePagosCreditos').DataTable().destroy();
      $("#datos_tabla").empty().html(json.htmlDatosTabla);
      inicializar_tabla("tablePagosCreditos");
    })
    .fail(function () {})
    .always(function () {

    });

    $('#modalPagosCreditos').modal('show');
    $('#modalPagosCreditos').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });
}

function fntPagoCuota(iddetalle,mes){

  
  var datos = { iddetalle: iddetalle,mes:mes};
  $.ajax({
    dataType: "json",
    method: "POST",
    url: base_url + "/Creditos/getCreditoPagar",
    data: datos,
  })
    .done(function (json) {
        var mes = json[0].mesPago;
        var fecha = json[0].anio+"-"+json[0].mesPago+"-"+json[0].dia;
        var cuota = json[0].cuota;
        var saldofinal = json[0].saldofinal;
        var tasa = json[0].tasa;
        var meses = json[0].meses;
        var iddetalle = json[0].iddetalle;
        var cuotaspendientes = json[0].cuotaspendientes;
        //var n = window.prompt("HOLAAA","tasa");
        console.log(saldofinal+" "+cuota);       
        
    swal({
      title: "Abono a capital!",
      text: "Si desea abonar a capital digite la cantidad en dólares($):",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      animation: "slide-from-top",
      inputPlaceholder: "0.00"
    },
    function(inputValue){
        
     if (inputValue===false) {
        return false;
    }else  if (inputValue === "" || inputValue === null) {
        var abonoCapital = 0;
      }else{
        var abono = parseFloat(inputValue);
        var interes = Math.round10((saldofinal * ((tasa/100)/12)),-2);
        var aux = Math.round10((cuota - interes),-2);
        var valor = Math.round10((saldofinal - aux), -2);
        console.log(valor); 
        if(valor<=0){
            swal.showInputError("No es posible abono a capital! 'Cuota Final'");
            return false;
        }else{
            if(cuotaspendientes == 1){
              swal.showInputError("No es posible abono a capital! 'Cuota Pendiente'");
                return false;  
            }else{
                if(abono > valor){
                    swal.showInputError("Abono a capital es mayor al saldo final del crédito! Monto Válido: "+valor);
                    return false;
                }else{
                    abonoCapital = abono;
                }

            }
        }
        
      }

        divLoading.style.display = "flex";
        var datos_insert = {"iddetalle": iddetalle,"mes": mes, "fecha": fecha, "cuota": cuota, "saldofinal": saldofinal, "tasa": tasa, "meses": meses, "abonoCapital": abonoCapital};
        console.log(datos_insert);
        $.ajax({
            dataType: "json",
            method: "POST",
            url: base_url + "/Creditos/setPagoCredito",
            data : datos_insert,
        }).done(function(json) {
            console.log("EL consultar",json);
            
            if (json.estado) { 

                $('#modalPagosCreditos').modal("hide");
                swal("Pago Cuota!", json.msg, "success");
                tableCreditos.api().ajax.reload();
                
            }else{
                swal("Pago Cuota!", json.msg, "error");
            }


        }).fail(function(){

        }).always(function(){
            divLoading.style.display = "none";
        });
      
        

    });
    
    })
    .fail(function () {})
    .always(function () {});      
}

function inicializar_tabla(tabla) {
  $("#" + tabla).dataTable({
    responsive: true,
    aServerSide: true,
    autoWidth: false,
    deferRender: true,
    retrieve: true,
    processing: true,
    paging: true,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",

      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
    },
    columns: [{
        data: "cuota",
      },
      {
        data: "dia",
      },
      {
        data: "totalCredito",
      },
      {
        data: "opciones",
      },
    ],
    dom: '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap"B>><"col-sm-12 col-md-4"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    buttons: [{
        extend: "copyHtml5",
        text: "<i class='far fa-copy'></i>",
        titleAttr: "Copiar",
        className: "btn btn-primary",
      },
      {
        extend: "excelHtml5",
        text: "<i class='fas fa-file-excel'></i>",
        titleAttr: "Exportar a Excel",
        className: "btn btn-primary",
      },
      {
        extend: "pdfHtml5",
        text: "<i class='fas fa-file-pdf'></i>",
        titleAttr: "Exportar a PDF",
        className: "btn btn-primary",
      },
      {
        extend: "csvHtml5",
        text: "<i class='fas fa-file-csv'></i>",
        titleAttr: "Exportar a CSV",
        className: "btn btn-primary",
      },
    ],
    lengthMenu: [5, 10, 20, 50],
    bDestroy: true,
    iDisplayLength: 5,
    order: [
      [0, "asc"]
    ],
  });
}

function inicializar_tabla1(tabla) {
  $("#" + tabla).dataTable({
    responsive: true,
    aServerSide: true,
    autoWidth: false,
    deferRender: true,
    retrieve: true,
    processing: true,
    paging: true,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",

      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
    },
    columns: [{
        data: "mes",
      },
      {
        data: "fecha",
      },
      {
        data: "fechapago",
      },
      {
        data: "cuota",
      },
      {
        data: "capital",
      },
      {
        data: "intereses",
      },
      {
        data: "mora",
      },
      {
        data: "abonocapital",
      },
      {
        data: "totalabono",
      },
      {
        data: "saldofinal",
      },
    ],
    dom: '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap"B>><"col-sm-12 col-md-4"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    buttons: [{
        extend: "copyHtml5",
        text: "<i class='far fa-copy'></i>",
        titleAttr: "Copiar",
        className: "btn btn-primary",
      },
      {
        extend: "excelHtml5",
        text: "<i class='fas fa-file-excel'></i>",
        titleAttr: "Exportar a Excel",
        className: "btn btn-primary",
      },
      {
        extend: "pdfHtml5",
        text: "<i class='fas fa-file-pdf'></i>",
        titleAttr: "Exportar a PDF",
        className: "btn btn-primary",
      },
      {
        extend: "csvHtml5",
        text: "<i class='fas fa-file-csv'></i>",
        titleAttr: "Exportar a CSV",
        className: "btn btn-primary",
      },
    ],
    lengthMenu: [5, 10, 20, 50],
    bDestroy: true,
    iDisplayLength: 5,
    order: [
      [0, "asc"]
    ],
  });
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
