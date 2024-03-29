var tableVentas;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	
persona_natural();


});

$('#tableVentas').DataTable();


function fntViewCadenaAv(idcadena){

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Compras/getCadena/'+idcadena;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#titleModalV").innerHTML = "<div class='text-left'><b>"+"Compra #"+objData.data[0].idcompra+"<br>"+"Proveedor: "+objData.data[0].nombre+"</b></div>";
                var srtCadenaCoros = "";
                for (var i = 0; i < objData.data.length; i++) {
                    srtCadenaCoros = srtCadenaCoros+ "<table class='table table-hover table-bordered'><thead><tr><th># de Compra</th><th># de Producto</th><th>Cantidad</th><th>Precio de Venta</th></tr> <tr><td>"+"000"+objData.data[i].iddetalle+"</td><td>"+"000"+objData.data[i].idproducto+"</td><td>"+objData.data[i].cantidad+"</td><td>"+objData.data[i].precioventa+"</td></tr></thead><tbody></tbody></table>";
                  }
                document.querySelector("#modalViewBody").innerHTML = "<div class='text-center'>"+srtCadenaCoros+"</div>";
                
                $('#modalViewCadenaAv').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}


function anularVenta(idventa){

    swal({
        title: "Anular Venta",
        text: "¿Realmente quiere la venta?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, anular!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Ventas/anularVenta';
            let strData = "idventa="+idventa;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estado)
                    {
                        swal("Anular!", objData.msg , "success");
                        tableVentas.api().ajax.reload();
                    }else{
                        swal("Anular!", objData.msg , "error");
                    }
                }
            }
        }

    });

}



function verTicket(idventa){

     window.open(base_url+"/Consultas/imprimirticket/"+idventa);
}

function verFactura(idventa){

     window.open(base_url+"/Consultas/imprimirfactura/"+idventa);
}

function verFacturacredito(idventa){

  window.open(base_url+"/Consultas/imprimirfacturacreditofiscal/"+idventa);
}
function verNota(idventa){

  window.open(base_url+"/Consultas/imprimirnota/"+idventa);
}



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
            "url": " "+base_url+"/Ventas/getVentascn",
            "dataSrc":""
        },
        "columns":[
            {"data":"idventa"},
            {"data":"fecha"},
            {"data":"cliente"},
            {"data":"subtotal"},
            {"data":"iva"},
            {"data":"monto"},
            {"data":"estado"},
            {"data":"opciones"}
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
            "url": " "+base_url+"/Ventas/getVentascj",
            "dataSrc":""
        },
        "columns":[
            {"data":"idventa"},
            {"data":"fecha"},
            {"data":"cliente"},
            {"data":"subtotal"},
            {"data":"iva"},
            {"data":"monto"},
            {"data":"estado"},
            {"data":"opciones"}
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