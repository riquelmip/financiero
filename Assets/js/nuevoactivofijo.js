var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    fntSelects();
    ocultarEstado();
    var formNuevoActivo = document.querySelector("#formNuevoActivo");
    formNuevoActivo.onsubmit = function(e) {
        e.preventDefault(); 

  
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
                 
                    swal("Activo Fijo", objData.msg ,"success");
                    
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

	$(document).on("change","#tipo",function(e){
    var a=document.querySelector('#nombre').value;
    var e =document.querySelector('#tipo').value;
    if(a=='' || e==-1){
      return false;
    }
      var datos= {"nombre": document.querySelector('#nombre').value, "tipo": document.querySelector('#tipo').value}
        $.ajax({
          dataType: "json",
          method: "POST",
          url: base_url + "/NuevoActivoFijo/generarcode",
          data : datos,
      }).done(function(json) {
        document.querySelector('#codigo').value=json.codigo;

      }).always(function(){
      
      });


	});

function ocultarEstado() {
 
  var bandera = document.querySelector('#bandera').value;

  if(bandera==0){
    
    $('#oc').css('display', 'none');
    
  }else{
    $('#oc').css('display', 'block');
    
  }
}

  $(document).on("change","#nombre",function(e){
    var a=document.querySelector('#nombre').value;
    if(a=='' || e==-1){
      return false;
    }
      var datos= {"nombre": document.querySelector('#nombre').value, "tipo": document.querySelector('#tipo').value}
        $.ajax({
          dataType: "json",
          method: "POST",
          url: base_url + "/NuevoActivoFijo/generarcode",
          data : datos,
      }).done(function(json) {
        document.querySelector('#codigo').value=json.codigo;

      }).always(function(){
      
      });


	});

function alerta_recargartabla(titulo, mensaje, tipo){
    swal({
        title: titulo,
        text: mensaje,
        type: tipo,
        //timer: 3000
    });

}
