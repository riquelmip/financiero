<?php 
    headerAdmin($data); 
    getModal('modalProveedores',$data);
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
              <?php if (!empty($_SESSION['permisosMod']['escribir'])) { ?>
                <button class="btn btn-success" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
              <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/proveedores"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableProveedor">
                      <thead>
                        <tr>
                          
                          <th>Nombre</th>
                          <th>Dirección</th>
                          <th>Telefono</th>
                          <th>Contacto Vendedor</th>
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
  
<?php footerAdmin($data); ?>
    