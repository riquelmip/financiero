<?php 
    headerAdmin($data); 
    
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-shopping-cart" style="color: red;"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/nuevacompra"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

      <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <form id="formProducto" name="formProducto" class="form-horizontal">
                    <input type="hidden" id="idCadena" name="idCadena"  value="">
                    <p  style="text-align: left; font-size: large;" >Fecha : <?php echo date("d-m-Y"); ?></p>
                   

              <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="listProve" style="font-size: medium;">Proveedor : </label>
                    <select class="form"  style="width: 200px; height: 30px;"   data-live-search="true" id="listProve" name="listProve"  required >
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="listProve" style="font-size: medium;">Credito : </label>
                    
                </div>
                <div class="form-group col-md-2">
                    <input class="form-control"  style="width: 185px; height: 30px; margin-left: -100px;" step=".01" autocomplete="off" id="credito" name="credito" type="number"  placeholder="Ingrese la cantidad" >
                </div>
                
                <div class="form-group col-md-2">
                    <label for="listProve" style="font-size: medium;  ">Fecha a Pagar : </label>
                   
                </div>
                <div class="form-group col-md-2">
                <input class="form-control"  min="<?= date('Y-m-d'); ?>" style="width: 185px; height: 30px; margin-left: -60px;"   id="fechacredito"   name="fechacredito" type="date" >
                </div>
              </div>

                    
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="divDetalles" ></label><br>
                        <table border="1px;"   style="text-align: center; font-size: medium; border-color: #E5E5E5;" ><thead><tr><th style="width: 80px;">Eliminar</th><th style="width: 475px;" >Producto agregado a compra</th><th style="width: 100px;">Cantidad</th><th style="width: 120px;">Precio Compra</th><th style="width: 120px;">Precio Venta</th><th style="width: 120px;">Sub Total</th></tr></thead><tbody></tbody></table>
                        <input type="hidden"  id="listaProducto" name="listaProducto">
                      <div id="divDetalles" name="divDetalles"></div>
                      </div>
                    </div>
                    
                    <div class="row text-center">
                      <div class="col-md-12">
                        <div class="tile-footer">
                        <div class="row text-right">
                          
                        <p id="total" style="text-align: left; font-size: medium; margin-left: 810px;">Total a pagar</p>
                        <label id="toti" ></label>
                        <p id="totalfinal" name="totalfinal"  style="text-align: right; font-size: medium;  margin-left: 55px; "></p>
                        </div>
                        <input type="hidden"  id="listsub" name="listsub">
                          <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                        </div>
                      </div>
                    </div>
                  </form>

                  <p class="text-primary">Seleccione los productos a comprar</p>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                        <div class="table-responsive">
                          <table class="table table-hover table-bordered" id="tableProducto">
                            <thead>
                                <tr>
                                <th style="width: 100px;">Codigo de Barra</th>
                                  <th>Nombre</th>
                                  <th>Stock</th>
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
            </div>
        </div>
</main>
<?php footerAdmin($data); ?>