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
       //Obtengo el fichero que va a ser subido
        var dato_archivo = $('#imagen').prop("files")[0];

        formData.append("foto", dato_archivo);
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

   //para cargar la imagen
   if(document.querySelector(".btnAddImage")){
    let btnAddImage =  document.querySelector(".btnAddImage");
    btnAddImage.onclick = function(e){
     let key = Date.now(); //id unico para el div de cada imagen que se agregue
     let newElement = document.createElement("div");
     newElement.id= "div"+key; //el id del div quedaria algo asi: div12523682887
     newElement.innerHTML = `
         <div class="prevImage"></div>
         <input type="file" name="foto" id="imagen" class="inputUploadfile">
         <label for="imagen" class="btnUploadfile"><i class="fas fa-upload "></i></label>
         <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
     document.querySelector("#containerImages").appendChild(newElement); //todo lo del div de cada imagen se agrega al contenedor de imagenes
     document.querySelector("#div"+key+" .btnUploadfile").click();
     fntInputFile();
    }
 }

 fntInputFile();
});

//Para mover el archivo
function fntInputFile(){
  let inputUploadfile = document.querySelectorAll(".inputUploadfile");
  inputUploadfile.forEach(function(inputUploadfile) {
      inputUploadfile.addEventListener('change', function(){
          let idProducto = document.querySelector("#codigo").value;
          let parentId = this.parentNode.getAttribute("id"); //obtiene el id del elemento del div de la imagen div189839
          let idFile = this.getAttribute("id");            
          let uploadFoto = document.querySelector("#"+idFile).value;
          let fileimg = document.querySelector("#"+idFile).files; //se refiere al input de tipo file y obtiene el archivo es decir, la foto que se cargo
          let prevImg = document.querySelector("#"+parentId+" .prevImage"); //estamos seleccionando el elemento que tinene previmage
          let nav = window.URL || window.webkitURL;
          if(uploadFoto !=''){ //si existe una imagen
              let type = fileimg[0].type; //tipo de archivo
              let name = fileimg[0].name; //nombre
              if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){ //si el archivo es diferente a esos tipos de iamagenes
                  prevImg.innerHTML = "Archivo no válido";
                  uploadFoto.value = "";
                  return false;
              }else{
                  let objeto_url = nav.createObjectURL(this.files[0]);
                  prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;

                              prevImg.innerHTML = `<img src="${objeto_url}">`;
                              document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",'a');
                              document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notblock");
                              document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
              }
          }

      });
  });
}


function fntDelItem(element){
  // let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
  // let idProducto = document.querySelector("#codigo").value;
              let itemRemove = document.querySelector(element);
              itemRemove.parentNode.removeChild(itemRemove);
}

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
