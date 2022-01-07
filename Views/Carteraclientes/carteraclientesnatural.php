<?php
headerAdmin($data);
getModal('modalCliente', $data);
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<div id="contentAjax"></div>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-user-o"></i> <?= $data['page_title'] ?>
        <?php if (!empty($_SESSION['permisosMod']['escribir'])) { ?>
          <button class="btn btn-success" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Ingresar nuevo cliente</button>
        <?php } ?>
      </h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tab" role="tabpanel">
        <ul class="nav nav-tabs " role="tablist">
          <li role="presentation" class="active"><a href="#javatab" aria-controls="home" role="tab" data-toggle="tab">Cliente A</a></li>
          <li role="presentation"><a href="#jquerytab" aria-controls="profile" role="tab" data-toggle="tab">Cliente B</a></li>
          <li role="presentation"><a href="#ctab" aria-controls="messages" role="tab" data-toggle="tab">Cliente C</a></li>
          <li role="presentation"><a href="#mysqltab" aria-controls="settings" role="tab" data-toggle="tab">Cliente D</a></li>
        </ul>
      </div>

      <div class="tile">
        <div class="tile-body">
          <div class="btn-group mb-2" role="group" aria-label="Basic example">
            <button type="button" onclick="persona_natural()" class="btn btn-success">Persona Natural</button>
            <button type="button" onclick="persona_juridica()" class="btn btn-warning">Persona Jurídica</button>
          </div>

          <div class="table-responsive" id="tabla1">
            <table class="table table-hover table-bordered" id="tableClientes">
              <thead>
                <tr>
                  <th>Código Persona Natural</th>
                  <th>DUI</th>
                  <th>Nombre Completo</th>
                  <th>Dirección</th>
                  <th>Teléfono</th>
                  <th>Estado Civil</th>
                  <th>Lugar de Trabajo</th>
                  <th>Ingresos</th>
                  <th>Egresos</th>
                  <th>Boleta de Pagos</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="datos_tabla">
              </tbody>
            </table>
          </div>

          <div class="table-responsive" id="tabla2">
            <table class="table table-hover table-bordered" id="tableClientesJuridica">
              <thead>
                <tr>
                  <th>Código Persona Juridica</th>
                  <th>Nombre de la Empresa</th>
                  <th>Dirección</th>
                  <th>Télefono</th>
                  <th>Balance General</th>
                  <th>Estado de Resultado</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="datos_tabla_juridica">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tab" role="tabpanel">
        <ul class="nav nav-tabs " role="tablist">
          <li role="presentation" class="active"><a href="#javatab" aria-controls="home" role="tab" data-toggle="tab">Cliente A</a></li>
          <li role="presentation"><a href="#jquerytab" aria-controls="profile" role="tab" data-toggle="tab">Cliente B</a></li>
          <li role="presentation"><a href="#ctab" aria-controls="messages" role="tab" data-toggle="tab">Cliente C</a></li>
          <li role="presentation"><a href="#mysqltab" aria-controls="settings" role="tab" data-toggle="tab">Cliente D</a></li>
        </ul>
      </div>

      <div class="tile">
        <div class="tile-body">
          <div class="btn-group mb-2" role="group" aria-label="Basic example">
            <button type="button" onclick="persona_natural()" class="btn btn-success">Persona Natural</button>
            <button type="button" onclick="persona_juridica()" class="btn btn-warning">Persona Jurídica</button>
          </div>

          <div class="table-responsive" id="tabla1">
            <table class="table table-hover table-bordered" id="tableClientes">
              <thead>
                <tr>
                  <th>Código Persona Natural</th>
                  <th>DUI</th>
                  <th>Nombre Completo</th>
                  <th>Dirección</th>
                  <th>Teléfono</th>
                  <th>Estado Civil</th>
                  <th>Lugar de Trabajo</th>
                  <th>Ingresos</th>
                  <th>Egresos</th>
                  <th>Boleta de Pagos</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="datos_tabla">
              </tbody>
            </table>
          </div>

          <div class="table-responsive" id="tabla2">
            <table class="table table-hover table-bordered" id="tableClientesJuridica">
              <thead>
                <tr>
                  <th>Código Persona Juridica</th>
                  <th>Nombre de la Empresa</th>
                  <th>Dirección</th>
                  <th>Télefono</th>
                  <th>Balance General</th>
                  <th>Estado de Resultado</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="datos_tabla_juridica">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php footerAdmin($data); ?>