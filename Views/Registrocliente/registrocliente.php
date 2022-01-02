<?php
headerAdmin($data);
?>
<div id="contentAjax"></div>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1 id="dato" style="font-family: Arial, Helvetica, sans-serif;"> </h1>

    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <form method="post" id="formregistrocliente" name="formregistrocliente" class="form-horizontal">
            <div class="form-row">
              <input class="form-control" value=1 id="bandera" name="bandera" type="text" hidden>
              <div class="form-group col-md-3">
                <label for="1" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif">Tipo de Registro de Cliente</label>
              </div>
              <div class="form-check col-md-2" style="font-family: Arial, Helvetica, sans-serif; margin-left: 20px;">
                <input type="radio" class="form-check-input" id="radio1" name="optradio" value="1" checked>Persona Natural
                <label class="form-check-label" for="radio1"></label>
              </div>
              <div class="form-check col-md-2" style="font-family: Arial, Helvetica, sans-serif;">
                <input type="radio" class="form-check-input" id="radio2" name="optradio" value="2">Persona Juridica
                <label class="form-check-label" for="radio2"></label>
              </div>
            </div>

            <div class="form-row" id="variablenatural">
              <div class="form-group col-md-2">
                <label for="1" style="font-size: medium; font-family: Arial, Helvetica, sans-serif;">Código</label>
              </div>
              <div class="form-group col-md-2">
                <label for="1" id="labelnombre" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">Nombre </label>
              </div>
              <div class="form-group col-md-2">
                <label for="1" id="labelapellido" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">Apellido </label>
              </div>
              <div class="form-group col-md-2">
                <label for="1" id="labeldireccion" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">Dirección </label>
              </div>
            </div>
            <div class="form-row" id="variablenatural2">
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="codigocliente" name="codigocliente" type="text" readonly>
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="nombrecliente" name="nombrecliente" type="text">
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="apellidocliente" name="apellidocliente" type="text">
              </div>
              <div class="form-group col-md-2">
                <textarea class="form-control" style="width: 400px; height: 60px; " id="direccioncliente" name="direccioncliente" type="text"></textarea>
              </div>
            </div>

            <div class="form-row" id="variablejuridica">
              <div class="form-group col-md-2">
                <label for="1" style="font-size: medium; font-family: Arial, Helvetica, sans-serif;">Código</label>
              </div>
              <div class="form-group col-md-4">
                <label for="1" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">Nombre de la Empresa</label>
              </div>
              <div class="form-group col-md-2">
                <label for="1" style="font-size: medium; margin-left: -75px;  font-family: Arial, Helvetica, sans-serif;">Teléfono </label>
              </div>
              <div class="form-group col-md-2">
                <label for="1" style="font-size: medium; margin-left: -75px; font-family: Arial, Helvetica, sans-serif;">Dirección </label>
              </div>
            </div>
            <div class="form-row" id="variablejuridica2">
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="codigoclientejuridico" name="codigoclientejuridico" type="text" readonly>
              </div>
              <div class="form-group col-md-4">
                <input class="form-control" style="width: 200px; height: 30px;" id="nombreclientejuridico" name="nombreclientejuridico" type="text">
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px;margin-left: -75px; height: 30px; " id="telefonoclientejuridico" name="telefonoclientejuridico" type="text">
              </div>
              <div class="form-group col-md-2">
                <textarea class="form-control" style="width: 400px; margin-left: -75px; height: 60px; " id="direccionclientejuridico" name="direccionclientejuridico" type="text"></textarea>
              </div>
            </div>

            <div class="form-row" id="variablenatural3">
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium; font-family: Arial, Helvetica, sans-serif;">Telefono</label>
              </div>
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">DUI </label>
              </div>
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">Estado Civil </label>
              </div>
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">Lugar de Trabajo </label>
              </div>
            </div>
            <div class="form-row" id="variablenatural4">
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="telefonocliente" name="telefonocliente" maxlength="9" type="text">
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="duicliente" name="duicliente" maxlength="10" type="text">
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="estadocivilcliente" name="estadocivilcliente" type="text">
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 400px; height: 30px; " id="lugardetrabajocliente" name="lugardetrabajocliente" type="text">
              </div>
            </div>

            <div class="form-row" id="variablenatural5">
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium; font-family: Arial, Helvetica, sans-serif;">Ingreso</label>
              </div>
              <div class="form-group col-md-2">
                <label for="codigocliente" style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">Egresos </label>
              </div>
            </div>

            <div class="form-row" id="variablenatural6">
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="ingresoscliente" name="ingresoscliente" step="0.01" type="number">
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="egresoscliente" name="egresoscliente" step="0.01" type="number">
              </div>
              <div class="form-group col-md-2">
                <button id="btnActionForm" class="btn btn-primary" style="margin-left: 40px;" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
              </div>
            </div>

            <div class="form-row" id="variablejuridica3">
              <div class="form-group col-md-2">
                <label style="font-size: medium; font-family: Arial, Helvetica, sans-serif;">Ingreso</label>
              </div>
              <div class="form-group col-md-2">
                <label style="font-size: medium;  font-family: Arial, Helvetica, sans-serif;">Egresos </label>
              </div>
            </div>

            <div class="form-row" id="variablejuridica4">
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="balance" name="balance" type="text">
              </div>
              <div class="form-group col-md-2">
                <input class="form-control" style="width: 120px; height: 30px;" id="estado" name="estado" type="text">
              </div>
              <div class="form-group col-md-2">
                <button id="btnActionForm" class="btn btn-primary" style="margin-left: 40px;" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>