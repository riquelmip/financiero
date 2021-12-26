<?php
headerAdmin($data);
?>
<div id="contentAjax"></div>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"><i class="fas fa-user-check" style="color: black; "></i> <?= $data['page_title'] ?></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <form id="formProducto" name="formProducto" class="form-horizontal">
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium;  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Código de Cliente : </label>
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 185px; height: 30px; margin-left: -10px;" id="codigocliente" name="codigocliente" type="text" readonly>
              </div>
              <div class="form-group col-md-2">
                
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
              </div>
              <div class="form-group col-md-2">
              <label for="codigocliente" style="font-size: medium;  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Código de Cliente : </label>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Nombres : </label>
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 185px; height: 30px; margin-left: -10px;" id="codigocliente" name="codigocliente" type="text" >
              </div>
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium;  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; margin-left: 40px;">Apellido : </label>
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 185px; height: 30px; margin-left: -10px;" id="codigocliente" name="codigocliente" type="text" >
              </div>
            </div>
          </form>




        </div>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>