
var tableMarca;
var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	tableMarca = $('#tableMarca').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Marca/getMarcas",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"estado"},
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
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    //NUEVO REGISTRO MARCA
    var formMarca = document.querySelector("#formMarca");
    formMarca.onsubmit = function(e) {
        e.preventDefault();

        var intIdMarca = document.querySelector('#idmarca').value;
        var strMarca = document.querySelector('#txtNombreMarca').value;
        var intestadoMarca = document.querySelector('#marcaEstado').value;
        var mensaje =  document.getElementById('msje');

        if(mensaje.textContent == '* Solo letras'){
            swal("Atención", "Campo Nombre Marca solo permite letras." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Marca/setMarca'; 
        var formData = new FormData(formMarca);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado)
                {
                    $('#modalFormMarca').modal("hide");
                    formMarca.reset();
                    swal("Marca Producto", objData.msg ,"success");
                    tableMarca.api().ajax.reload();
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }

});

$('#tableMarca').DataTable();

function openModal(){

    document.querySelector('#idmarca').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Marca";
    document.querySelector("#formMarca").reset();
    $("#msje").text("");
	$('#modalFormMarca').modal('show');
}

window.addEventListener('load', function() {
    /*fntEditRol();
    fntDelRol();
    fntPermisos();*/
}, false);

function fntEditMarca(idmarca){
    document.querySelector('#titleModal').innerHTML ="Actualizar Marca";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idmarca = idmarca;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Marca/getMarca/'+idmarca;
    request.open("GET",ajaxUrl ,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.estado){

                document.querySelector("#idmarca").value = objData.data.idmarca;
                document.querySelector("#txtNombreMarca").value = objData.data.nombre;
                document.querySelector("#marcaEstado").value = objData.data.estado;

                if(objData.data.estado == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                `;
                document.querySelector("#marcaEstado").innerHTML = htmlSelect;
                $('#modalFormMarca').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

}

function fntDelMarca(idmarca){
    var idmarca = idmarca;
    swal({
        title: "Eliminar Marca",
        text: "¿Realmente quiere eliminar la Marca?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Marca/delMarca/'+idmarca;
            request.open("GET",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send();
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    
                    if(objData.estado){

                        swal("Eliminar!", objData.msg , "success");
                        tableMarca.api().ajax.reload(function(){

                        });
                        
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}

//SOLO LETRAS
$(function(){

    var mayus = new RegExp("^(?=.*[A-Z])");
    var lower = new RegExp("^(?=.*[a-z])");
     var numbers = new RegExp("^(?=.*[0-9])");
    $("#txtNombreMarca").on("keyup",function(){
        var text = $("#txtNombreMarca").val();

        if(mayus.test(text) || lower.test(text)){
            $("#msje").text("");
        }else{
            $("#msje").text("* Solo letras").css("color","red");
        }

        if(numbers.test(text)){
            $("#msje").text("* Solo letras").css("color","red");
        }else{
            $("#msje").text("");
        }
    });

});


