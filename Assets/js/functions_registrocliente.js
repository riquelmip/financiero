let tableProducto;
let rowTable = "";
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    if (document.querySelector("#formregistroclientente")) {
        let formregistroclientente = document.querySelector("#formregistroclientente");
    formregistroclientente.onsubmit = function(e) {
        e.preventDefault();
        console.log("1");

    


        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Registrocliente/setRegistroCliente'; 
        var formData = new FormData(formregistroclientente);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.estado){


                    swal("Datos Cliente", objData.msg ,"success");
                 
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }
    }

 }
   });












$(document).on("change","#radio1",function(e){
    var radio1 = $("#radio1").val();
    document.querySelector('#bandera').value = 1;
     /*$.ajax({
       dataType: "json",
       method: "POST",
       url: base_url+"/Consultas/clientemayorcomprasfiltradaporfecha/"+fecha_fin,
     
   }).done(function(json) {
       console.log("EL consultar",json);
       
       $("#datos_tabla").empty().html(json.htmlDatosTabla);
      
       inicializar_tabla("tableConsul");
   
   }).fail(function(){
   
   }).always(function(){
   
   });*/
    
   
   
   });

   $(document).on("change","#radio2",function(e){
    var radio2 = $("#radio2").val();
    document.querySelector('#bandera').value = 2;

     /*$.ajax({
       dataType: "json",
       method: "POST",
       url: base_url+"/Consultas/clientemayorcomprasfiltradaporfecha/"+fecha_fin,
     
   }).done(function(json) {
       console.log("EL consultar",json);
       
       $("#datos_tabla").empty().html(json.htmlDatosTabla);
      
       inicializar_tabla("tableConsul");
   
   }).fail(function(){
   
   }).always(function(){
   
   });*/
    
   
   
   });



