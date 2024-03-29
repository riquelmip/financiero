<?php 
    headerAdmin($data); 
    getModal('modalCompras',$data);
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-tags"></i> <?= $data['page_title'] ?>
              <?php if (!empty($_SESSION['permisosMod']['escribir'])) { ?>
                <a class="btn btn-success" type="button" href="Nuevacompra" ><i class="fas fa-plus-circle"></i> Nuevo</a>
              <?php } ?>
            </h1>
        </div>
       
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/compra"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table">
                    <table class="table table-hover table-bordered" id="tableCompra">
                      <thead>
                        <tr>
                          <th>IdCompra</th>
                          <th>Fecha de Compra</th>
                          <th>Monto pagado</th>
                          <th>Credito</th>
                          <th>Fecha de Credito</th>
                          <th>Detalles</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div> 
        <script type="text/javascript" src="<?= media(); ?>../js/jquery.mask.js"></script>
<?php footerAdmin($data); ?>
    