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
    ['XXXX1',     11],
    ['XXXX2',      2],
    ['XXXX3',  2],
    ['XXXX4', 2],
    ['XXXX5',    7]
  ]);

  var options = {
    title: 'Título',
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
        data.addColumn('number', 'Eje X');
        data.addColumn('number', 'XXXX1');
        data.addColumn('number', 'XXXX2');
        data.addColumn('number', 'XXXX3');

        data.addRows([
            [1,  37.8, 80.8, 41.8],
            [2,  30.9, 69.5, 32.4],
            [3,  25.4,   57, 25.7],
            [4,  11.7, 18.8, 10.5],
            [5,  11.9, 17.6, 10.4],
            [6,   8.8, 13.6,  7.7],
            [7,   7.6, 12.3,  9.6],
            [8,  12.3, 29.2, 10.6],
            [9,  16.9, 42.9, 14.8],
            [10, 12.8, 30.9, 11.6],
            [11,  5.3,  7.9,  4.7],
            [12,  6.6,  8.4,  5.2],
            [13,  4.8,  6.3,  3.6],
            [14,  4.2,  6.2,  3.4]
        ]);

        var options = {
            chart: {
            title: 'Título',
            subtitle: 'Subtítulo'
            },
            width: 900,
            height: 350,
            
            series: {
                0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
              },
              axes: {
                y: {
                  distance: {label: 'Eje Y'}, // Left y-axis.
                  
                }
              }

        };

        var chart = new google.charts.Line(document.getElementById('graficoLinea'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
}

function fntGraficoBarra(){
    google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Eje X', 'XXXX1', 'XXXX2', 'XXXX3'],
          ['XXXX1', 1000, 400, 200],
          ['XXXX2', 1170, 460, 250],
          ['XXXX3', 660, 1120, 300],
          ['XXXX4', 1030, 540, 350]
        ]);

        var options = {
            chart: {
              title: 'Título',
              subtitle: 'Subtítulo'
            },
            series: {
              0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            },
            axes: {
              y: {
                distance: {label: 'Eje Y'}, // Left y-axis.
                
              }
            }
          };

        var chart = new google.charts.Bar(document.getElementById('graficoBarras'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
}

