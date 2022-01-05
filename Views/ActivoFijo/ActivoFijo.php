
    <?php 
  headerAdmin($data); 
  // getModal('modalActivoFijo',$data);
?> 
<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
            <?php if (!empty($_SESSION['permisosMod']['escribir'])) { ?>
                <button class="btn btn-success" type="button" href="NuevoActivoFijo" ><i class="fas fa-plus-circle"></i> Nuevo</button>
            <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/Empleado"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableActivoFijo">
                      <thead>
                        <tr>
                          <th>Imagen</th>
                          <th>Nombre</th>        
                          <th>Código</th>
                          <th>Costo</th>
                          <th>Fecha Adquisición</th>
                          <th>Acciones</th>
                          <th>Mantenimiento</th>
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
    