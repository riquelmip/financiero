var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    fntSelects();

    var formNuevoActivo = document.querySelector("#formNuevoActivo");
    formNuevoActivo.onsubmit = function(e) {
        e.preventDefault(); 

        
        //     var code = document.querySelector('#idEmpleado').value;
        //     var nombre = document.querySelector('#txtDui').value;
        //     var strNit = document.querySelector('#txtNit').value; 
        //     var strNombre = document.querySelector('#txtNombre').value;
        //     var strApellido =document.querySelector('#txtApellido').value;  
        //     var strDireccion = document.querySelector('#txtDireccion').value;
        //     var telefono = document.querySelector('#txtTelefono').value;
        //     var fecha = document.querySelector('#txtFecha').value;
        //     var intCargo = document.querySelector('#listCargo').value;

        // if(strDui == '' || strNit == '' || strNombre == '' || strApellido=='' || strDireccion=='' || telefono=='', fecha=='', intCargo=='')
        // {
        //     swal("Atención", "Todos los campos son obligatorios." , "error");
        //     return false;
        // }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/NuevoActivoFijo/setActivoFijo'; 
        var formData = new FormData(formNuevoActivo);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado)
                {
                    formNuevoActivo.reset();
                 
                    swal("Empleado", objData.msg ,"success");
                    cargar_datos();
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }

    
});


function fntSelects() {
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/NuevoActivoFijo/getSelects";
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let objData = JSON.parse(request.responseText);

        document.querySelector("#tipo").innerHTML = objData.tipos;
        $('#tipo').selectpicker('refresh');
        $('#tipo').selectpicker('render');

        document.querySelector("#proveedor").innerHTML = objData.proveedores;
        $('#proveedor').selectpicker('refresh');
        $('#proveedor').selectpicker('render');
      }
    };
  }


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
