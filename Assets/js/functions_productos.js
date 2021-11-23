document.write(`<script src="${base_url}/Assets/js/plugins/JsBarcode.all.min.js"></script>`);
let tableProductos;
let rowTable = "";
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});




tableProductos = $('#tableProductos').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/Productos/getProductos",
        "dataSrc":""
    },
    "columns":[

        {"data":"codigobarra"},
        {"data":"imagenes"},
        {"data":"descripcion"},
        {"data":"stock"},
        {"data":"estado"},
        {"data":"options"}
    ],
    "columnDefs": [
                    { 'className': "textcenter", "targets": [ 1 ] },
                    { 'className': "textcenter", "targets": [ 2 ] },
                    { 'className': "textright", "targets": [ 3 ] },
                    { 'className': "textcenter", "targets": [ 4 ] }
                  ],       
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr":"Copiar",
            "className": "btn btn-primary",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3] 
            }
        },{
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Exportar a Excel",
            "className": "btn btn-primary",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3] 
            }
        },{
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr":"Exportar a PDF",
            "className": "btn btn-primary",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3] 
            }
        },{
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr":"Exportar a CSV",
            "className": "btn btn-primary",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3] 
            }
        }
    ],
    "responsive":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]  
});
window.addEventListener('load', function() {
    

    if(document.querySelector("#formProductos")){
        let formProductos = document.querySelector("#formProductos");
        formProductos.onsubmit = function(e) {
            e.preventDefault();
            let strDescripcion = document.querySelector('#txtDescripcion').value;
            let intCodigo = document.querySelector('#txtCodigo').value;
            let intEstado = document.querySelector('#listEstado').value;
            let intCat = document.querySelector('#listCategoria').value;
            let intMarca = document.querySelector('#listMarca').value;
            let intUnidad = document.querySelector('#listUnidad').value;
            if(strDescripcion == '' || intCodigo == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
            if(intCodigo.length < 5){
                swal("Atención", "El código debe ser mayor que 5 dígitos." , "error");
                return false;
            }
            divLoading.style.display = "flex";

            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Productos/setProducto'; 
            let formData = new FormData(formProductos);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);

                    if(objData.estado)
                    {
                        swal("", objData.msg ,"success");
                        document.querySelector("#idProducto").value = objData.idproducto;
                        document.querySelector("#containerGallery").classList.remove("notblock");

                        if(rowTable == ""){
                            tableProductos.api().ajax.reload();
                        }else{
                           htmlStatus = intEstado == 1 ? 
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = intCodigo;
                            rowTable.cells[2].textContent = strDescripcion;                            rowTable.cells[4].innerHTML =  htmlStatus;
                            rowTable = ""; 
                        }
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    if(document.querySelector(".btnAddImage")){
       let btnAddImage =  document.querySelector(".btnAddImage");
       btnAddImage.onclick = function(e){
        let key = Date.now(); //id unico para el div de cada imagen que se agregue
        let newElement = document.createElement("div");
        newElement.id= "div"+key; //el id del div quedaria algo asi: div12523682887
        newElement.innerHTML = `
            <div class="prevImage"></div>
            <input type="file" name="foto" id="img${key}" class="inputUploadfile">
            <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
            <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
        document.querySelector("#containerImages").appendChild(newElement); //todo lo del div de cada imagen se agrega al contenedor de imagenes
        document.querySelector("#div"+key+" .btnUploadfile").click();
        fntInputFile();
       }
    }

    //setInterval(fntCarousel(), 1000);
    //$('.carousel').carousel();
    fntInputFile();
    fntSelects();
    $('#modalFormProductos').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });

}, false);

if(document.querySelector("#txtCodigo")){
    let inputCodigo = document.querySelector("#txtCodigo");
    inputCodigo.onkeyup = function() {
        if(inputCodigo.value.length >= 5){ //si lo que hay en el inpuit es maypor a 5 caracteres
            document.querySelector('#divBarCode').classList.remove("notblock");
            fntBarcode();
       }else{
            document.querySelector('#divBarCode').classList.add("notblock");
       }
    };
}

/*
tinymce.init({
	selector: '#txtDescripcion',
	width: "100%",
    height: 400,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
}); */

function fntInputFile(){
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function(){
            let idProducto = document.querySelector("#idProducto").value;
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

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/Productos/setImage'; 
                    let formData = new FormData();
                    formData.append('idproducto',idProducto);
                    formData.append("foto", this.files[0]);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);
                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status){
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                                document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notblock");
                                document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
                                tableProductos.api().ajax.reload();
                            }else{
                                swal("Error", objData.msg , "error");
                            }
                        }
                    }

                }
            }

        });
    });
}

function fntDelItem(element){
    let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
    let idProducto = document.querySelector("#idProducto").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/delFile'; 

    let formData = new FormData();
    formData.append('idproducto',idProducto);
    formData.append("file",nameImg);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                swal("", objData.msg , "error");
            }
        }
    }
}

function fntViewInfo(idProducto){
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.estado)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                let estadoProducto = objProducto.estado == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celCodigo").innerHTML = objProducto.codigobarra;
                document.querySelector("#celDescripcion").innerHTML = objProducto.descripcion;
                document.querySelector("#celStock").innerHTML = objProducto.stock;
                document.querySelector("#celCategoria").innerHTML = objProducto.categoria;
                document.querySelector("#celMarca").innerHTML = objProducto.marca;
                document.querySelector("#celUnidad").innerHTML = objProducto.unidadmedida;
                document.querySelector("#celEstado").innerHTML = estadoProducto;
               

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        htmlImage +=`<img src="${objProductos[p].url_image}"></img>`;
                    }
                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $('#modalViewProducto').modal('show');

            }else{
                swal("Error", objData.msg , "error");
            }
        }
    } 
}

function fntEditInfo(element,idProducto){
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Producto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.estado)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                document.querySelector("#idProducto").value = objProducto.idproducto;
                document.querySelector("#txtDescripcion").value = objProducto.descripcion;
                document.querySelector("#txtCodigo").value = objProducto.codigobarra;
                document.querySelector("#listCategoria").value = objProducto.idcategoria;
                document.querySelector("#listMarca").value = objProducto.idmarca;
                document.querySelector("#listUnidad").value = objProducto.idunidadmedida;
                document.querySelector("#listEstado").value = objProducto.estado;
                //tinymce.activeEditor.setContent(objProducto.descripcion); 
                $('#listCategoria').selectpicker('render');
                $('#listMarca').selectpicker('render');
                $('#listUnidad').selectpicker('render');
                $('#listEstado').selectpicker('render');
                fntBarcode();

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        let key = Date.now()+p;
                        htmlImage +=`<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objProductos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage; 
                document.querySelector("#divBarCode").classList.remove("notblock");
                document.querySelector("#containerGallery").classList.remove("notblock");           
                $('#modalFormProductos').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntDelInfo(idProducto){
    swal({
        title: "Eliminar Producto",
        text: "¿Realmente quiere eliminar el producto?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Productos/delProducto';
            let strData = "idProducto="+idProducto;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableProductos.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}



function fntSelects(){
   
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Productos/getSelects';
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
    
                
                document.querySelector('#listMarca').innerHTML = objData.marca;
                $('#listMarca').selectpicker('render');
                document.querySelector('#listCategoria').innerHTML = objData.categoria;
                $('#listCategoria').selectpicker('render');
                document.querySelector('#listUnidad').innerHTML = objData.unidad;
                $('#listUnidad').selectpicker('render');
              
            }
        }
    
       
}

function fntBarcode(){
    let codigo = document.querySelector("#txtCodigo").value;
    JsBarcode("#barcode", codigo);
}

function fntPrintBarcode(area){
    let elemntArea = document.querySelector(area);
    let vprint = window.open(' ', 'popimpr', 'height=400,width=600');
    vprint.document.write(elemntArea.innerHTML );
    vprint.document.close();
    vprint.print();
    vprint.close();
}

function openModal()
{
    rowTable = "";
    document.querySelector('#idProducto').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    document.querySelector("#formProductos").reset();
    document.querySelector("#divBarCode").classList.add("notblock");
    document.querySelector("#containerGallery").classList.add("notblock");
    document.querySelector("#containerImages").innerHTML = "";
    $('#modalFormProductos').modal('show');

}

function fntCarousel(){
    //Validaciones de los campos
    let elementos = document.getElementsByClassName("carousel-item");
    console.log(elementos);
    for (let i = 0; i < elementos.length; i++) { 
        if(elementos[i].classList.contains('active')) { 
             elementos[i].removeClass('active');
        }
    } 
                
}

function fntAñadirMarca(){
  
    swal({
      title: "Nueva Marca!",
      text: "Ingrese el nombre de la marca a agregar:",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      animation: "slide-from-top",
      inputPlaceholder: "Ingrese la marca"
    },
    function(inputValue){
     if (inputValue===false) {
        return false;
    }else  if (inputValue === "" || inputValue === null) {
        swal.showInputError("Por favor, llene el campo!");
        return false;
      }else{
        divLoading.style.display = "flex";
        var datos = {"txtNombreMarca": inputValue, "marcaEstado": 1};
        $.ajax({
            dataType: "json",
            method: "POST",
            url: base_url+"/Marca/setMarcaProd",
            data : datos,
        }).done(function(json) {
            console.log("EL consultar",json);
            
            if (json.estado) {
                $("#listMarca").empty().html(json.listaMarcas);
                $('#listMarca').selectpicker('refresh');
                document.querySelector("#listMarca").value = json.id;
                $('#listMarca').selectpicker('render');
                

                swal("Marca!", json.msg, "success");
            }else{
                swal("Marca!", json.msg, "error");
            }


        }).fail(function(){

        }).always(function(){
            divLoading.style.display = "none";
        });

      }
      
        

    });

    
                
}


function fntAñadirCategoria(){
  
    swal({
      title: "Nueva Categoria!",
      text: "Ingrese el nombre de la categoria a agregar:",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      animation: "slide-from-top",
      inputPlaceholder: "Ingrese la categoria"
    },
    function(inputValue){
    if (inputValue===false) {
        return false;
    }else  if (inputValue === "" || inputValue === null) {
        swal.showInputError("Por favor, llene el campo!");
        return false;
      }else{
        divLoading.style.display = "flex";
        var datos = {"txtNombre": inputValue};
        $.ajax({
            dataType: "json",
            method: "POST",
            url: base_url+"/Categoria/setCategoriaProd",
            data : datos,
        }).done(function(json) {
            console.log("EL consultar",json);
            
            if (json.estado) {
                $("#listCategoria").empty().html(json.listaCategorias);
                $('#listCategoria').selectpicker('refresh');
                document.querySelector("#listCategoria").value = json.id;
                $('#listCategoria').selectpicker('render');
                

                swal("Categorias!", json.msg, "success");
            }else{
                swal("Categorias!", json.msg, "error");
            }


        }).fail(function(){

        }).always(function(){
            divLoading.style.display = "none";
        });

      }
      
        

    });

    
                
}


function fntAñadirUnidad(){
  
    swal({
      title: "Nueva Unidad de Medida!",
      text: "Ingrese el nombre de la Unidad de Medida a agregar:",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      animation: "slide-from-top",
      inputPlaceholder: "Ingrese la Unidad de Medida"
    },
    function(inputValue){
    if (inputValue===false) {
        return false;
    }else  if (inputValue === "" || inputValue === null) {
        swal.showInputError("Por favor, llene el campo!");
        return false;
      }else{
        divLoading.style.display = "flex";
        var datos = {"txtNombre": inputValue};
        $.ajax({
            dataType: "json",
            method: "POST",
            url: base_url+"/Unidadmedida/setUnidadProd",
            data : datos,
        }).done(function(json) {
            console.log("EL consultar",json);
            
            if (json.estado) {
                $("#listUnidad").empty().html(json.listaUnidades);
                $('#listUnidad').selectpicker('refresh');
                document.querySelector("#listUnidad").value = json.id;
                $('#listUnidad').selectpicker('render');
                

                swal("Unidad de Medida!", json.msg, "success");
            }else{
                swal("Unidad de Medida!", json.msg, "error");
            }


        }).fail(function(){

        }).always(function(){
            divLoading.style.display = "none";
        });

      }
      
        

    });

    
                
}