<?php
headerAdmin($data);
getModal('modalCarteraclientes',$data);
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<div id="contentAjax"></div>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-user-o"></i> <?= $data['page_title'] ?>
      </h1>
    </div>
  </div>

  <div class="row" id="tablacompleta1">
    <div class="col-md-12">
      <div class="tab" role="tabpanel">
        <ul class="nav nav-tabs " role="tablist">
          <li role="presentation" class="active"><a onclick="clientea()" style="cursor: pointer;"  aria-controls="home" role="tab" data-toggle="tab">Cliente A</a></li>
          <li role="presentation"><a onclick="clienteb()" style="cursor: pointer;" aria-controls="profile" role="tab" data-toggle="tab">Cliente B</a></li>
          <li role="presentation"><a onclick="clientec()" style="cursor: pointer;" aria-controls="messages" role="tab" data-toggle="tab">Cliente C</a></li>
          <li role="presentation"><a onclick="cliented()" style="cursor: pointer;" aria-controls="settings" role="tab" data-toggle="tab">Cliente D</a></li>
        </ul>
      </div>

      <div class="tile">
        <div class="tile-body">
          <div class="btn-group mb-2" role="group" aria-label="Basic example" id="botones1">
            <button type="button" onclick="persona_naturalA()" class="btn btn-success">Persona Natural A</button>
            <button type="button" onclick="persona_juridicaA()" class="btn btn-warning">Persona Jurídica A</button>
          </div>
          <div class="btn-group mb-2" role="group" aria-label="Basic example" id="botones2">
            <button type="button" onclick="persona_naturalB()" class="btn btn-success">Persona Natural B</button>
            <button type="button" onclick="persona_juridicaB()" class="btn btn-warning">Persona Jurídica B</button>
          </div>
          <div class="btn-group mb-2" role="group" aria-label="Basic example" id="botones3">
            <button type="button" onclick="persona_naturalC()" class="btn btn-success">Persona Natural C</button>
            <button type="button" onclick="persona_juridicaC()" class="btn btn-warning">Persona Jurídica C</button>
          </div>
          <div class="btn-group mb-2" role="group" aria-label="Basic example" id="botones4">
            <button type="button" onclick="persona_naturalD()" class="btn btn-success">Persona Natural D</button>
            <button type="button" onclick="persona_juridicaD()" class="btn btn-warning">Persona Jurídica D</button>
          </div>

          <div class="table-responsive" id="tabla1">
            <table class="table table-hover table-bordered" id="tableClientes">
              <thead>
                <tr>
                  <th>Código Persona Natural</th>
                  <th>DUI</th>
                  <th>Nombre Completo</th>
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
</main>
<?php footerAdmin($data); ?>