<?php 
    headerAdmin($data); 
    getModal('modalPagos',$data);
    getModal('modalActivarCredito',$data);
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-user-o"></i> <?= $data['page_title'] ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/creditos"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
         
        <div class="row">
            <div class="col-md-12">
              <br>
              <div class="tile">
                <div class="tile-body">
                  <br>
                    <div class="form-row">
                    <div class="btn-group mb-2" role="group" aria-label="Basic example" id="botones1">
                      <button type="button" onclick="persona_natural()" class="btn btn-success">Persona Natural</button>
                      <button type="button" onclick="persona_juridica()" class="btn btn-warning">Persona Juridica</button>
                    </div>
                </div>
                <br>
                <br>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableCreditosIncobrables">
                      <thead >
                        <tr>
                          <th>Código</th>
                          <th>Cliente</th>
                          <th>Producto</th>
                          <th>Fecha Credito</th>
                          <th>Monto</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="datos_tabla">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
  
<?php footerAdmin($data); ?>

