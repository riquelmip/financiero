
    <?php 
  headerAdmin($data); 
  // getModal('modalActivoFijo',$data);
?> 
<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/NuevoActivoFijo"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

 <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
           

<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombre">Nombre (*)</label>
      <input type="text" class="form-control" id="nombre" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
      <label for="codigo">Código Generado(*)</label>
      <input type="text" class="form-control" id="codigo" placeholder="EJEM: SILLA-2021-2912-1">
    </div>
  </div>

    <div class="form-row">
  <div class="form-group col-md-6">
    <label for="categoria">Categoría(*)</label>
      <select id="categoria" class="form-control">
        <option selected>Categoría</option>
        <option>...</option>
      </select>
  </div>
   <div class="form-group col-md-6">
    <label for="codigo">Descripción(*)</label>
    <textarea class="form-control" id="codigo" rows="3"></textarea>
  </div>

   </div>

  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="categoria">Clasificación(*)</label>
      <select id="categoria" class="form-control">
        <option selected>Clasificación</option>
        <option>...</option>
      </select>
  </div>

    <div class="form-group col-md-6">
    <label for="proveedor">Proveedor(*)</label>
      <select id="proveedor" class="form-control">
        <option selected>Proveedores</option>
        <option>...</option>
      </select>
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="fechaadqui">Fecha de adquisición(*)</label>
      <input type="date" class="form-control" id="fechaadqui">
    </div>
    <div class="form-group col-md-4">
      <label for="garantia">Garantía(Años)(*)</label>
    <input type="text" class="form-control" id="garantia">
    </div>
    <div class="form-group col-md-4">
      <label for="costo">Costo Unitario(*)</label>
      <input type="text" class="form-control" id="costo">
    </div>
  </div>

    <div class="form-row">
    <div class="form-group col-md-4">
      <label for="cantidad">Cantidad(*)</label>
      <input type="text" class="form-control" id="cantidad">
    </div>
    <div class="form-group col-md-4">
      <label for="estado">Estado(Años)(*)</label>
    <select id="estado" class="form-control">
        <option selected>Estado</option>
        <option>Activo</option>
  <option>Inactivo</option>

        </select>
    </div>
    <div class="form-group col-md-4">
      <label for="costo">Imagen(*)</label>
      <button class="btnAddImage btn btn-success btn-sm">Seleccione una imagen</button>
    </div>
  </div>

   <div class="form-group col-md-12">
 <hr>
                     <div id="containerImages">

                          </div>
                 </div>

   <div class="row">
    <div class="form-group col-md-4"></div>
                       <div class="form-group col-md-2">
                           <button id="btnActionForm" class="btn btn-success " type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                       </div> 
                       <div class="form-group col-md-2">
                           <button class="btn btn-danger " type="button" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                       </div> 
                    </div> 
</form>

              </div>
              </div>
              </div>
              </div>
<?php footerAdmin($data); ?>
    