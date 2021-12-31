var tableEntradas;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){


	tableEntradas = $('#tableEntradas').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Inventario/getRegistroEntradas",
            "dataSrc":""

        },
        "columns":[
            {"data":"fecha"},
            {"data":"codigobarra"},
            {"data":"descripcion"},
            {"data":"marca"},
            {"data":"categoria"},
            {"data":"cantidad"},
            {"data":"preciocompra"},            
            {"data":"monto"}
            
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
            targets: 3,
            className: 'text-center'
          },
          {
            targets: 4,
            className: 'text-center'
          },
          {
            targets: 5,
            className: 'text-center'
          },
          {
            targets: 6,
            className: 'text-center'
          },
          {
            targets: 7,
            className: 'text-center'
          }
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


});

$('#tableEntradas').DataTable();