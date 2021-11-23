var tableCategoria;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	tableCategoria = $('#tableCompra').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Compras/getCompras",
            "dataSrc":""
        },
        "columns":[
            {"data":"idcompra"},
            {"data":"dia"},
            {"data":"monto"},
            {"data":"credito"},
            {"data":"fecha_credito"},
            {"data":"opciones"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });




});

$('#tableCompra').DataTable();







function openModal(){

    document.querySelector('#idCategoria').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Categoria";
    document.querySelector("#formCategoria").reset();
	$('#modalFormCategoria').modal('show');
}




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



window.addEventListener('load', function() {
    /*fntEditRol();
    fntDelRol();
    fntPermisos();*/
}, false);

function fntEditCategoria(idcat){
    document.querySelector('#titleModal').innerHTML ="Actualizar Categoria";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idcat = idcat;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Categoria/getCategoria/'+idcat;
    
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado)
            {
                document.querySelector("#idCategoria").value = objData.data.idcategoria;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                $('#modalFormCategoria').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

}

function fntDelCategoria(idcate){
    var idcate = idcate;
    swal({
        title: "Eliminar Categoria",
        text: "¿Realmente quiere eliminar el Categoria?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Categoria/delCategoria/';
            var strData = "idcategoria="+idcate;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    console.log(objData);
                    if(objData.estado)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableCategoria.api().ajax.reload(function(){

                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}



