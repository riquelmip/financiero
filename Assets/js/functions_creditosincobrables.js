
var tableCreditosIncobrables;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){
    persona_natural();
});

$('#tableCreditosIncobrables').DataTable();

function persona_natural(){
   
    tableCreditosIncobrables = $('#tableCreditosIncobrables').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Creditos/getCreditosIncobrables",
            "dataSrc":""

        },
        "columns":[
            {"data":"dui"},
            {"data":"nombreCliente"},
            {"data":"descripcion"},
            {"data":"fecha_inicio"},
            {"data":"total"},
            {"data":"embargo"},
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
   
    tableCreditosIncobrables = $('#tableCreditosIncobrables').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Creditos/getCreditosDosIncobrables",
            "dataSrc":""

        },
        "columns":[
            {"data":"dui"},
            {"data":"nombreCliente"},
            {"data":"descripcion"},
            {"data":"fecha_inicio"},
            {"data":"total"},
            {"data":"embargo"},
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

function fntVerPagosPendientes(iddetalle){

  var datos = { "iddetalle": iddetalle,"estado":0};
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

function fntEmbargo(idpersona,detalle,valorembargo){
  console.log(idpersona);
  document.querySelector("#codigo2").value = idpersona;
  document.querySelector("#codigo22").value = detalle;
  document.querySelector("#codigo23").value = valorembargo;
  $('#modalEmbargo').modal('show');
  var formCargos = document.querySelector("#formFiador2");
  formCargos.onsubmit = function(e) {
      e.preventDefault();

      var strNombre = document.querySelector('#codigo2').value;
      
      if(strNombre == '')
      {
          swal("Atención", "Todos los campos son obligatorios." , "error");
          return false;
      }
      divLoading.style.display = "flex";
      var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      var ajaxUrl = base_url+'/Carteraclientes/setEmbargo'; 
      var formData = new FormData(formCargos);
      request.open("POST",ajaxUrl,true);
      request.send(formData);
      request.onreadystatechange = function(){
         if(request.readyState == 4 && request.status == 200){
              
              var objData = JSON.parse(request.responseText);
              if(objData.estado)
              {
                  
                  $('#modalEmbargo').modal("hide");
                  formCargos.reset();
                  
                  swal("Embargos", objData.msg ,"success");
                  tableCreditosIncobrables.api().ajax.reload();

              }else{
                  swal("Error", objData.msg , "error");
              }              
          } 
          divLoading.style.display = "none";
          return false;
      }

      
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