var tableRoles;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	// tableRoles = $('#tableRoles').dataTable( {
	// 	"aProcessing":true,
	// 	"aServerSide":true,
    //     "language": {
    //     	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    //     },
    //     "ajax":{
    //         "url": " "+base_url+"/Roles/getRoles",
    //         "dataSrc":""
    //     },
    //     "columns":[
    //         {"data":"idrol"},
    //         {"data":"nombrerol"},
    //         {"data":"descripcion"},
    //         {"data":"estado"},
    //         {"data":"opciones"}
    //     ],
    //     "resonsieve":"true",
    //     "bDestroy": true,
    //     "iDisplayLength": 10,
    //     "order":[[0,"desc"]]  
    // });
    fntGraficoPastel();
    fntGraficoLineal();
    fntGraficoBarra();
});

function fntGraficoPastel(){

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Cartera Tipo A',     2],
    ['Cartera Tipo B',      2],
    ['Cartera Tipo C',  2],
    ['Cartera Tipo D', 2],
    ['Cartera Tipo Incobrable',    0]
  ]);

  var options = {
    title: 'Cantidad de Clientes en Carteras',
    is3D: true,
  };

        var chart = new google.visualization.PieChart(document.getElementById('graficoPastel'));

        chart.draw(data, options);
    }
}

function fntGraficoLineal(){

    google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Tipo de Cliente');
        data.addColumn('number', 'Natural');
        data.addColumn('number', 'Juridico');


        data.addRows([
            [1,  2, 2],
            [2,  2, 2],
            [3,  2, 3],

        ]);

        var options = {
            chart: {
            title: 'Cantidad de clientes por tipo',
            subtitle: 'Natural y Juridico'
            },
            width: 900,
            height: 350,
            
            series: {
                0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
              },
              axes: {
                y: {
                  distance: {label: 'Categoria Cliente'}, // Left y-axis.
                  
                }
              }

        };

        var chart = new google.charts.Line(document.getElementById('graficoLinea'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
}



