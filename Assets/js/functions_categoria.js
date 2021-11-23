var tableCategoria;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	tableCategoria = $('#tableCategoria').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Categoria/getCategorias",
            "dataSrc":""
        },
        "columns":[
            
            {"data":"nombre"},
            {"data":"opciones"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    //NUEVO ROL
    var formCategoria = document.querySelector("#formCategoria");
    formCategoria.onsubmit = function(e) {
        e.preventDefault();

        var intIdCat= document.querySelector('#idCategoria').value;
        var strNombre = document.querySelector('#txtNombre').value;
        
        if(strNombre == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Categoria/setCategoria'; 
        var formData = new FormData(formCategoria);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado)
                {
                    
                    $('#modalFormCategoria').modal("hide");
                    formCategoria.reset();
                    
                    swal("Categorias", objData.msg ,"success");
                    tableCategoria.api().ajax.reload();

                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }

});

$('#tableCategoria').DataTable();

function openModal(){

    document.querySelector('#idCategoria').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Categoria";
    document.querySelector("#formCategoria").reset();
	$('#modalFormCategoria').modal('show');
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



