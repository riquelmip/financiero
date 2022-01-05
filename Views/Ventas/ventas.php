<?php 
    headerAdmin($data); 
    getModal('modalVentas',$data);
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-tags"></i> <?= $data['page_title'] ?>
              <?php if (!empty($_SESSION['permisosMod']['escribir'])) { ?>
                <a class="btn btn-success" type="button" href="Nuevaventa" ><i class="fas fa-plus-circle"></i> Nueva</a>
              <?php } ?>
            </h1>
        </div>
       
        <ul class="app-breadcrumb breadcrumb">
          
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/ventas"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="text-right">
                      <a onmouseover="mostrarAyuda();"><i class="fa fa-question fa-lg"></i></a>
                    </div>
                    <br>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableVentas">
                      <thead>
                        <tr>
                          <th>Venta</th>
                          <th>Fecha</th>
                          <th>Monto ($)</th>
                          <th>Cliente</th>
                          <th>Estado</th>
                          <th>Acciones</th>
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
    