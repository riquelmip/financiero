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


          <form name="formNuevoActivo" id="formNuevoActivo">
            <input type="hidden" name="bandera" id="bandera" value=<?= $data['bandera'] ?>>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombre">Nombre<span style="color: red;"> (*)</span></label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" autocomplete="off">
              </div>
              <div class="form-group col-md-6">
                <label for="codigo">Código Generado<span style="color: red;"> (*)</span></label>
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="EJEM: ELT-CAMION-ME-013">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="descripcion">Descripción<span style="color: red;"> (*)</span></label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" autocomplete="off"></textarea>
              </div>

            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="tipo">Clasificación<span style="color: red;"> (*)</span></label>
                <select id="tipo" name="tipo" class="form-control">
                  <option selected>Clasificación</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="proveedor">Proveedor<span style="color: red;"> (*)</span></label>
                <select id="proveedor" name="proveedor" class="form-control">
                  <option selected>Proveedores</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="fechaadqui">Fecha de adquisición<span style="color: red;"> (*)</span></label>
                <input type="date" class="form-control" id="fechaadqui" name="fechaadqui" autocomplete="off">
              </div>
              <div class="form-group col-md-4">
                <label for="garantia">Vida Útil(Años)<span style="color: red;"> (*)</span></label>
                <input type="number" class="form-control" id="garantia" name="garantia" autocomplete="off">
              </div>
              <div class="form-group col-md-4">
                <label for="costo">Costo Unitario<span style="color: red;"> (*)</span></label>
                <input type="number" step="0.01" class="form-control" id="costo" name="costo" autocomplete="off">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="cantidad">Cantidad<span style="color: red;"> (*)</span></label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" autocomplete="off">
              </div>
              <div class="form-group col-md-4" id="oc">
                <label for="estado" id="labelito">Estado<span style="color: red;"> (*)</span></label>
                <select id="estado" name="estado" class="form-control">
                  <option selected>Estado</option>
                  <option>Activo</option>
                  <option>Inactivo</option>

                </select>
              </div>
              <!-- <div class="form-group col-md-4">
                <label for="costo">Imagen</label>
                <button class="btnAddImage btn btn-success btn-sm">Seleccione una imagen</button>
              </div> -->
            </div>

            <div class="form-group col-md-12">
              <div id="containerGallery">
                <span>Agregar foto (440 x 545)</span>
                <button class="btnAddImage btn btn-success btn-sm"  type="button">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
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
                <button class="btn btn-danger " type="button"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <?php footerAdmin($data); ?>