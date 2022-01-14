var tableVentas;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	persona_natural();



});

$('#tableVentas').DataTable();








function mostrarAyuda(){
    $('#modalAyuda').modal('show');
}


function persona_natural(){
   
    tableVentas = $('#tableVentas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Ventas/getVentascontadocn",
            "dataSrc":""
        },
        "columns":[
            {"data":"idventa"},
            {"data":"fecha"},
            {"data":"cliente"},
            {"data":"descripcion"},
            {"data":"total"},
            {"data":"estado"}
        ],
        columnDefs: [{
            targets: 0,
            className: 'text-center'
          },
          {
            targets: 1,
            className: 'text-center'
          },
          {
            targets: 2,
            className: 'text-center'
          },
          {
            targets: 3
          },
          {
            targets: 4,
            className: 'text-center'
          },
          {
            targets: 5,
            className: 'text-center'
          }
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });

    
       
}

function persona_juridica(){
   
    tableVentas = $('#tableVentas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Ventas/getVentascontadocj",
            "dataSrc":""
        },
        "columns":[
            {"data":"idventa"},
            {"data":"fecha"},
            {"data":"cliente"},
            {"data":"descripcion"},
            {"data":"total"},
            {"data":"estado"}
        ],
        columnDefs: [{
            targets: 0,
            className: 'text-center'
          },
          {
            targets: 1,
            className: 'text-center'
          },
          {
            targets: 2,
            className: 'text-center'
          },
          {
            targets: 3
          },
          {
            targets: 4,
            className: 'text-center'
          },
          {
            targets: 5,
            className: 'text-center'
          }
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });

       
}