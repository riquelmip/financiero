<?php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Incio</a></li>

        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="text-white text-center bg-warning mb-3">
                      <div class="card-header">Título</div>
                        <div class="card-body">
                          <h5 class="card-title"><span id="totalCreditos">$9999</span></h5>
                          <p class="card-text">AAAAAAAAAAAA</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="text-white text-center bg-success mb-3">
                    <?php
                            $btnVerVentas = '<button class="btn btn-primary btn-sm btnPermisosRol" onClick="" title="Permisos"><i class="fas fa-eye"></i></button>';
                    ?>
                      <div class="card-header">Título</div>
                        <div class="card-body">
                          <h5 class="card-title"><span id="totalVentas">$9999</span></h5>                
                          <p class="card-text"> AAAAAAAAAAAA</p>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="text-white bg-primary text-center mb-3">
                      <div class="card-header">Título</div>
                        <div class="card-body">
                          <h5 class="card-title"><span id="totalCompras">$9999</span></h5>
                          <p class="card-text">AAAAAAAAAAAA</p>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        
      <div class="col-md-6">
              <div class="tile">
                <div class="tile-body">
                     <div id="graficoPastel"  style=" width: 400px; height: 200px; margin: auto; display: flex; align-items: letf; justify-content: left; position: relative;"></div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6" >
              <div class="tile">
                <div class="tile-body">
                      <div id="graficoBarras"  style=" width: 100%;">
                      </div>
                </div>
              </div>
              </div>
        </div>

        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div id="graficoLinea" style=" margin: auto; display: flex; align-items: center; justify-content: center; position: relative;"></div>        
                </div>
              </div>
            </div>
        </div>
      
        
</main>
<?php footerAdmin($data); ?>
    