<?php 
    headerAdmin($data); 
    getModal('modalConfiguracion',$data);
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-tags"></i> <?= $data['page_title'] ?>
              <?php if (!empty($_SESSION['permisosMod']['escribir'])) { ?>
                <button class="btn btn-success" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nueva Configuracion</button>
              <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/cargos"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableConfiguracion">
                      <thead>
                        <tr>                        
                          <th>Tiempo de Incobrabilidad</th>
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
<?php footerAdmin($data); ?>
    