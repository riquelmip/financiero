var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){
    cargar_datos();

    
});




function cargar_datos(){
    divLoading.style.display = "flex";
    var datos = {"consultar_info":"si_consultala"}
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url+"/ActivoFijo/getActivoFijos",
        data : datos,
    }).done(function(json) {
        
        $("#datos_tabla").empty().html(json.htmlDatosTabla);
        inicializar_tabla("tableActivoFijo");

    }).fail(function(){

    }).always(function(){
        divLoading.style.display = "none";
    });
}

$(document).on("click",".abr",function(e){
    e.preventDefault();

        var datos={"codigo": $(this).attr('data-id')}
        console.log(datos);
    $.ajax({
        dataType: "json",
        method: "POST",
        url: base_url+"/ActivoFijo/getDetalles",
        data : datos,
    }).done(function(json) {
        
        document.querySelector('#imagen').innerHTML= json.arr;
        document.querySelector('#nombre1').innerHTML= json.datosIndividuales[0].nombre;
        document.querySelector('#fecha').innerHTML= json.datosIndividuales[0].fecha_adquisicion;
        document.querySelector('#anios').innerHTML= json.datosIndividuales[0].vida_util+' años';
        document.querySelector('#costo').innerHTML= '$ '+json.datosIndividuales[0].costo;
        
        var oTable = $('#tabledetalle').dataTable();
        oTable.fnDestroy();
        $("#datos_detalle").empty().html(json.htmlDatosTabla);
        inicializar_tabla2("tabledetalle");
        
        $('#modalDetalleActivofijo').modal('show');
    }).fail(function(){

    }).always(function(){
        
    });

  
});

function alerta_recargartabla(titulo, mensaje, tipo){
    swal({
        title: titulo,
        text: mensaje,
        type: tipo,
        //timer: 3000
    }, 
    function(){
            cargar_datos();
    });

}

function inicializar_tabla(tabla){
    $('#'+tabla).dataTable( {
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
        "columns":[
            {"data":"img"},
            {"data":"nombre"},
            {"data":"codigo"},
            {"data":"cantidad"},
            {"data":"fecha_adquisicion"},
            {"data":"opciones"}
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
        "lengthMenu" : [5,10,20,50],
        "bDestroy": true,
        "iDisplayLength": 5,
        "order":[[0,"asc"]]  
    });
}

function inicializar_tabla2(tabla){
    $('#'+tabla).dataTable( {
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
        "columns":[
            {"data":"codigo_correlativo"},
            {"data":"decripcion"},
            {"data":"estado"},
            {"data":"opciones"},
            {"data":"opciones2"}
        ],
        "lengthMenu" : [5,10,20,50],
        "bDestroy": true,
        "iDisplayLength": 5,
        "order":[[0,"asc"]]  
    });
}