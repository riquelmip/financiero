let tableProducto;
let rowTable = "";
let divLoading = document.querySelector('#divLoading');
var arrayIdProductos = [];
var contadordet = 0;
document.addEventListener('DOMContentLoaded', function(){
    
    persona_natural();

//AL DAR CLIC EN EL BOTON DE AÑADIR CLIENTE SE ABRE EL MODAL
    $("#btnAddCliente").click(function(e) {
        e.preventDefault();
         $('#modalFormClienteventa').modal('show');
    });

//AL DAR CLIC EN EL FORM DE CLIENTE
    var formCliente = document.querySelector("#formClienteventa");
    formCliente.onsubmit = function(e) {
        e.preventDefault();


        var strDui = document.querySelector('#txtDuiv').value;
        var strNombre = document.querySelector('#txtNombrev').value;
        var strApellido = document.querySelector('#txtApellidov').value;
        var strTelefono = document.querySelector('#txtTelefonov').value;
        var intEstado = document.querySelector('#intEstadov').value;
    
        var mensaje1 =  document.getElementById('msje1');
        var mensaje2 =  document.getElementById('msje2');

        if(mensaje1.textContent == '* Solo letras'){
            swal("Atención", "Campo Nombre solo permite letras." , "error");
            return false;
        }else{
            if(mensaje2.textContent == '* Solo letras'){
                swal("Atención", "Campo Apellido solo permite letras." , "error");
                return false;
            }   
        }

        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Nuevaventa/setCliente'; 
        var formData = new FormData(formCliente);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado){

                    $("#listCliente").empty().html(objData.clientes);
                    $('#listCliente').selectpicker('refresh');
                    document.querySelector("#listCliente").value = objData.id;
                    $('#listCliente').selectpicker('render');

                    $('#modalFormClienteventa').modal("hide");
                    formCliente.reset();
                    swal("Datos Cliente", objData.msg ,"success");

                    
                    
                   
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }
    }

//AL IR ESCRIBIENDO EL CODIGO DE BARRA SE REALIZA LA BUSQUEDA
    $("#codigobarra").on("keyup",function(){

        var codigo = document.querySelector('#codigobarra').value;
        
        if (codigo.length >= 5) {
             $.ajax({
                dataType: "json",
                method: "POST",
                url: base_url+"/Nuevaventa/getProducto/"+codigo,
                
            }).done(function(json) {
                if (json.data.estado == true) {
                    $("#idproducto").val(json.data.idproducto);
                    $("#tasaoculta").val(json.data.tasa);
                    $("#descripcion").html(json.data.descripcion);
                    $("#stock").html(json.data.stock);
                    var precio = parseFloat(json.data.precio).toFixed(2);
                    $("#precio").html(precio);
                    $("#cantidad").val(1);
                    $("#cantidad").prop('disabled', false);
                    var preciot = parseFloat(json.data.precio).toFixed(2);
                    $("#preciot").html(preciot); 

                    
                    if (parseInt(json.data.stock)==0) {
                        $("#btnAgregarDetalle").prop('disabled', true);
                    }else{
                        $("#btnAgregarDetalle").prop('disabled', false);
                    }  
                }else{
                    $("#descripcion").empty();
                    $("#stock").empty();
                    $("#precio").empty();
                    $("#preciot").empty();
                    $("#cantidad").val("");
                    $("#btnAgregarDetalle").prop('disabled', true);
                }
                 
                   
            }).fail(function(){

            }).always(function(){
                divLoading.style.display = "none";
            });
        }else{
            $("#descripcion").empty();
            $("#stock").empty();
            $("#precio").empty();
            $("#preciot").empty();
            $("#cantidad").val("");
            $("#cantidad").prop('disabled', true);
            $("#btnAgregarDetalle").prop('disabled', true);
        }
       
      
    });

    $("#cantidad").on("change",function(){

        let cantidad = document.querySelector('#cantidad').value;
        let precio = document.querySelector('#precio').innerHTML;

        let preciototal = parseInt(cantidad) * parseFloat(precio);
        
        $("#preciot").html(preciototal.toFixed(2)); 
      
    });

// AL DAR CLIC EN EL BOTON DE AGREGAR SE AGREGA AL ARRAY DE DETALLES
    $("#btnAgregarDetalle").click(function(e) {
        e.preventDefault();
        $('#modalFormaPago').modal('show');
        
    });



    if (document.querySelector("#formProducto")) {
        let formProducto = document.querySelector("#formProducto");
            formProducto.onsubmit = function(e) {
                e.preventDefault();
                $("#listaDetalles").val(JSON.stringify(arrayIdProductos)); 
               // $("#listsub").val(JSON.stringify(arreglo)); 
              let intCliente = document.querySelector("#listCliente").value;
                if(arrayIdProductos.length==0)
                {
                    swal("Atención", "Todos los campos son obligatorios." , "error");
                    return false;
                }
    
                let elementsValid = document.getElementsByClassName("valid");
                for (let i = 0; i < elementsValid.length; i++) { 
                    if(elementsValid[i].classList.contains('is-invalid')) { 
                        swal("Atención", "Por favor verifique los campos en rojo." , "error");
                        return false;
                    } 
                }          
                divLoading.style.display = "flex";
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url+'/Nuevaventa/setVenta'; 
                let formData = new FormData(formProducto);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
    
                    if(request.readyState == 4 && request.status == 200){
                  
                        let objData = JSON.parse(request.responseText);
                        if(objData.estado)
                        {
                            formProducto.reset();

                            swal({
                                title: 'Venta Realizada',
                                text: objData.msg,
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok!'
                              }, 
                              function(){
                                
                                   window.location.href = base_url+"/Ventas";

                              });
                            window.open(base_url+"/Consultas/imprimirticket/"+objData.idventa);
                           
                        }else{
                            swal("Error", objData.msg , "error");
                            
                        }
                    }
                    divLoading.style.display = "none";
                
                    return false;
                   
                }
    
            }
        }

        $("#listFormaPago").on("change",function(){

            let forma = document.querySelector('#listFormaPago').value;

            
            
            if (forma == 1) {
                $("#txttasa").prop('disabled', true); 
                $("#txtcuota").prop('disabled', true); 
                $("#txtmeses").prop('disabled', true); 
                document.querySelector('#txtmeses').value = "";
                document.querySelector('#txttasa').value = "";
                document.querySelector('#txtcuota').value = "";

            }else{
                $("#txttasa").prop('disabled', true); 
                $("#txtcuota").prop('disabled', true); 
                $("#txtmeses").prop('disabled', false);

                document.querySelector('#txtmeses').value = 1;

                document.querySelector('#txttasa').value = document.querySelector('#tasaoculta').value;

                let montop = parseFloat(document.querySelector('#preciot').innerHTML);
                let tasap = parseFloat(document.querySelector('#txttasa').value);
                let duracionp = parseInt(document.querySelector('#txtmeses').value);
                let cuotap = calcularCuotaModal(montop, tasap, duracionp); 
                document.querySelector('#txtcuota').value = cuotap;
            }
            
            
          
        });

        
        $("#txtmeses").on("change",function(){
            document.querySelector('#txttasa').value = document.querySelector('#tasaoculta').value;

            let montop = parseFloat(document.querySelector('#preciot').innerHTML);
            let tasap = parseFloat(document.querySelector('#txttasa').value);
            let duracionp = parseInt(document.querySelector('#txtmeses').value);
            let cuotap = calcularCuotaModal(montop, tasap, duracionp); 
            document.querySelector('#txtcuota').value = cuotap;
            
           
          
        });

        if (document.querySelector("#formFormaPago")) {
            let formFormaPago = document.querySelector("#formFormaPago");
            formFormaPago.onsubmit = function(e) {
                e.preventDefault();
                let idproducto = document.querySelector('#idproducto').value;
                let codigo = document.querySelector('#codigobarra').value;
                let cantidad = document.querySelector('#cantidad').value;
                let precio = document.querySelector('#precio').innerHTML;
                let preciot = document.querySelector('#preciot').innerHTML;
                let descripcion = document.querySelector('#descripcion').innerHTML;
                let stock = document.querySelector('#stock').innerHTML;

                if (parseInt(stock) == 0) {
                    swal({
                        title: "No hay existencias de este producto",
                        type: "warning",
                        confirmButtonText: "¡Cerrar!"
                      });
                      
                    
                }

               
                   
                   if (parseInt(cantidad) > parseInt(stock)) {
                        swal({
                            title: "Las existencias no alcanzan!",
                            type: "warning",
                            confirmButtonText: "¡Cerrar!"
                          });
                   }else{
                        let cuota;
                        let forma = parseInt(document.querySelector('#listFormaPago').value);
                        let tipoventa;
                        let estadopago;
                        if (forma == 1) {
                            cuota = parseFloat(0.00);
                            estadopago = null;
                            tipoventa = "Contado";
                        }else{
                            cuota = parseFloat(document.querySelector('#txtcuota').value);
                            tipoventa = "Crédito";
                            estadopago = "";
                            preciot = cuota * parseInt(document.querySelector('#txtmeses').value); 
                        }

                        contadordet++;
                        $("#tableProductosDet>tbody").append(
                                '<tr id="tr-'+idproducto+'-'+contadordet+'">'+
                                    '<td class="col-md-2 text-center" id="codigobarra-'+idproducto+'">'+codigo+'</td>'+
                                    '<td class="text-center" id="descripcion-'+idproducto+'">'+descripcion+'</td>'+
                                    '<td class="col-md-1 text-center" id="stock-'+idproducto+'">'+stock+'</td>'+
                                    '<td class="col-md-1 text-center" id="cantidad-'+idproducto+'">'+cantidad+'</td>'+
                                    '<td class="col-md-1 text-center" id="precio-'+idproducto+'">'+precio+'</td>'+
                                    '<td class="col-md-1 text-center" id="preciot-'+idproducto+'">'+preciot.toFixed(2)+'</td>'+
                                    '<td class="col-md-1 text-center" id="tipoventa-'+idproducto+'">'+tipoventa+'</td>'+
                                    '<td class="col-md-1 text-center" id="cuota-'+idproducto+'">'+cuota.toFixed(2)+'</td>'+
                                    '<td class="col-md-1 text-center"><button onClick="fntDel(\'' +idproducto+'-'+contadordet+ '\')" class="btn btn-danger btnEliminarDet" type="button"><i class="fas fa-trash-alt"></i></button></td>'+
                                '</tr>'
                            );
                        
                        
                        $("#codigobarra").val("");
                        $("#descripcion").empty();
                        $("#stock").empty();
                        $("#precio").empty();
                        $("#preciot").empty();
                        $("#cantidad").val("");
                        $("#cantidad").prop('disabled', true);
                        $("#btnAgregarDetalle").prop('disabled', true);
                        arrayIdProductos.push({ 
                                        "identificador" : idproducto+'-'+contadordet,
                                        "id" : idproducto,
                                        "codigobarra": codigo,
                                        "descripcion" : descripcion,
                                        "stock" : stock,
                                        "cantidad": cantidad,
                                        "precio": parseFloat(precio).toFixed(2),
                                        "preciototal":parseFloat(preciot).toFixed(2),
                                        "cuota": parseFloat(cuota).toFixed(2),
                                        "tipoventa": parseInt(forma),
                                        "meses": parseInt(document.querySelector('#txtmeses').value),
                                        "estadopago": estadopago
                                        });
                   } //fin else
                    

                
                calcularTotal();

                 console.log(arrayIdProductos);


                $('#modalFormaPago').modal('hide');
                formFormaPago.reset();
                $("#txttasa").prop('disabled', true); 
                $("#txtcuota").prop('disabled', true); 
                $("#txtmeses").prop('disabled', true); 
            }
        }


    
    }, false);


function fntSelects(){
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Nuevaventa/getClientesSelects';
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            document.querySelector('#listCliente').innerHTML = objData.clientes;
            $('#listCliente').selectpicker('render');
          
        }
    }
    
       
}


function persona_natural(){
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Nuevaventa/getSelectPersonaN';
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            document.querySelector('#listCliente').innerHTML = objData.personan;
            $('#listCliente').selectpicker('refresh');
            $('#listCliente').selectpicker('render');

            document.querySelector('#tipocliente').value = 1;
          
        }
    }
    
       
}

function persona_juridica(){
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Nuevaventa/getSelectPersonaJ';
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            document.querySelector('#listCliente').innerHTML = objData.personaj;
            $('#listCliente').selectpicker('refresh');
            $('#listCliente').selectpicker('render');

            document.querySelector('#tipocliente').value = 2;
          
        }
    }
    
       
}



//SOLO LETRAS
$(function(){

    var mayus = new RegExp("^(?=.*[A-Z])");
    var lower = new RegExp("^(?=.*[a-z])");
     var numbers = new RegExp("^(?=.*[0-9])");
    $("#txtNombrev").on("keyup",function(){
        var text = $("#txtNombrev").val();

        if(mayus.test(text) || lower.test(text)){
            $("#msje1").text("");
        }else{
            $("#msje1").text("* Solo letras").css("color","red");
        }

        if(numbers.test(text)){
            $("#msje1").text("* Solo letras").css("color","red");
        }else{
            $("#msje1").text("");
        }
    });

    $("#txtApellidov").on("keyup",function(){
        var text = $("#txtApellidov").val();

        if(mayus.test(text) || lower.test(text)){
            $("#msje2").text("");
        }else{
            $("#msje2").text("* Solo letras").css("color","red");
        }

        if(numbers.test(text)){
            $("#msje2").text("* Solo letras").css("color","red");
        }else{
            $("#msje2").text("");
        }
    });

});


function fntDel(identi){

    let identifi = identi;
    $("#tr-"+identifi).remove();
    console.log(identifi);
    for (var i = 0; i < arrayIdProductos.length; i++) {
        if (arrayIdProductos[i].identificador == identifi) {
          arrayIdProductos.splice(i, 1);
          break;
        }
      }
      calcularTotal();
      console.log(arrayIdProductos);

}

function calcularTotal(){
    let porcentajeiva = parseFloat(0.13);
    let subtotal = parseFloat(0);
    let iva = parseFloat(0);
    let total = parseFloat(0);
    for (var i = 0; i < arrayIdProductos.length; i++) {
        subtotal = subtotal + parseFloat(arrayIdProductos[i].preciototal);
      }

      $("#subtotal").empty().html(subtotal.toFixed(2));
      $("#inputsubtotal").val(subtotal.toFixed(2));

      iva = subtotal * porcentajeiva;
      total = iva + subtotal;

      $("#iva").empty().html(iva.toFixed(2));
      $("#inputiva").val(iva.toFixed(2));
      $("#total").empty().html(total.toFixed(2));
      $("#inputtotal").val(total.toFixed(2));
}

function calcularCuotaModal(monto, tasa, duracion){

    //calculamos la couta mediante la formula R = P[(i(1+i)^n)/((1+i)^n–1)]
    //Donde:
    //R = renta (cuota)
    //P = principal (préstamo adquirido)
    //i = tasa de interés mensual
    //n = número de periodos (meses)

    let P = parseFloat(monto); 
    let i = parseFloat(tasa); 
    let n = parseInt(duracion); 

    //convertimos la tasa a un portentaje
    let ipor = parseFloat(i/100); 
    //convertirmos la tasa que es anual, a mensual
    let im = parseFloat(ipor/12); 


    //$pot=pow((1+$im),$n);
    //$R = $P*(($im*($pot)/($pot-1)));
    let R = parseFloat(P*((im*(Math.pow((1+im), n)))/((Math.pow((1+im), n)) - 1))); 
    //$R = $P*(($im*(pow((1+$im), $n)))/((pow((1+$im), $n)) - 1));
    //pow((1+$i), $im);
    //$cuota=round($R, 2);
    let cuota = R.toFixed(2);

  
    return cuota;
}


function mostrarAyuda(){
    $('#modalAyuda').modal('show');
}

