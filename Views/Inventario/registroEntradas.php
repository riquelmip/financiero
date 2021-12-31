<?php 
    headerAdmin($data); 
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-dolly-flatbed"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fas fa-dolly-flatbed fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/inventario"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableEntradas">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Código</th>
                          <th>Descripción</th>
                          <th>Marca</th>
                          <th>Categoria</th>
                          <th>Cantidad</th>
                          <th>Costo Unitario ($)</th>
                          <th>Monto ($)</th>
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
    