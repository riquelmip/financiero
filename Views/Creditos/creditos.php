<?php 
    headerAdmin($data); 
    getModal('modalPagosCreditos',$data);
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
                  <div class="form-group col-md-4">
                    <h4>Tipo Persona</h4> 
                    <select class="form-control" id="listaTipo" name="listaTipo" required="" onchange="ftnDatos();">
                      <option value="0">Seleccione</option>
                      <option value="1">Persona natural</option>
                      <option value="2">Persona juridica</option>
                    </select>
                </div>
                <br>
                <br>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableCreditos">
                      <thead >
                        <tr>
                          <th>Código</th>
                          <th>Cliente</th>
                          <th>Producto</th>
                          <th>Fecha Venta</th>
                          <th>%Completado</th>
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
    