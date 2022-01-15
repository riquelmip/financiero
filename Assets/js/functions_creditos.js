
var tableCreditos;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){
    

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


});

$('#tableClientes').DataTable();



$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

function fntPagosCredito(iddetalle){

  var datos = { iddetalle: iddetalle};
  $.ajax({
    dataType: "json",
    method: "POST",
    url: base_url + "/Creditos/getCredito",
    data: datos,
  })
    .done(function (json) {
        
      $("#nombreCliente").empty().html(json.datosIndividuales.nombreCliente);
      $("#nombreProducto").empty().html(json.datosIndividuales.descripcion);
      $('#tablePagosCreditos').DataTable().destroy();
      $("#datos_tabla").empty().html(json.htmlDatosTabla);
      inicializar_tabla("tablePagosCreditos");
    })
    .fail(function () {})
    .always(function () {});

    $('#modalPagosCreditos').modal('show');
    $('#modalPagosCreditos').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });


  
}

function fntPagoCuota(iddetalle){

  
  var datos = { iddetalle: iddetalle};
  $.ajax({
    dataType: "json",
    method: "POST",
    url: base_url + "/Creditos/getCreditoPagar",
    data: datos,
  })
    .done(function (json) {
        
        var mes = json.mesPago;
        var fecha = json.anio+"-"+json.mesPago+"-"+json.dia;
        var cuota = json.cuota;
        var saldofinal = json.saldofinal;
        var tasa = json.tasa;
        var meses = json.meses;
        var iddetalle = json.iddetalle;
        //var n = window.prompt("HOLAAA","tasa");
        console.log(saldofinal+" "+cuota);

        var interes = saldofinal * ((tasa/100)/12);
        interes = interes.toFixed(2);
        var aux = cuota - interes;
        aux = aux.toFixed(2);
        var valor = saldofinal - aux;
        valor = valor.toFixed(2);
        
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
        var interes = saldofinal * ((tasa/100)/12);
        interes = interes.toFixed(2);
        var aux = cuota - interes;
        aux = aux.toFixed(2);
        var valor = saldofinal - aux;
        valor = valor.toFixed(2);
        console.log(valor);
        if(valor<=0){
            swal.showInputError("No es posible abono a capital! 'Cuota Final'");
            return false;
        }
        if(abono > valor){
            swal.showInputError("Abono a capital es mayor al saldo final del crédito! Monto Válido: "+valor);
            return false;
        }else{
            abonoCapital = abono;
        }
      }

        divLoading.style.display = "flex";
        var datos_insert = {"iddetalle": iddetalle,"mes": mes, "fecha": fecha, "cuota": cuota, "saldofinal": saldofinal, "tasa": tasa, "meses": meses, "abonoCapital": abonoCapital};
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

function ftnDatos(){
    
  var tipo = $('#listaTipo').val();
  if(tipo==1){
      location.reload(true);
  }else{
    location.reload(true);
  }  
  
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
        data: "dui",
      },
      {
        data: "nombreCliente",
      },
      {
        data: "descripcion",
      },
      {
        data: "fecha_inicio",
      },
      {
        data: "total",
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
