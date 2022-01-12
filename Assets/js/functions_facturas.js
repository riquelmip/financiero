var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){
});

$(document).on("click","#agregar_servicio",function(e){
    e.preventDefault();
    $("#md_registrar_servicio").modal("show");

});