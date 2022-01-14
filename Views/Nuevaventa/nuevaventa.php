<?php 
    headerAdmin($data); 
    getModal('modalNuevaventa',$data);
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-shopping-cart" style="color: red;"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/nuevaventa"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>


         <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <form id="formProducto" name="formProducto" class="form-horizontal">
                    <input type="hidden" id="idproducto" name="idproducto"  value="">
                    <input type="hidden" id="inputsubtotal" name="inputsubtotal"  value="">
                    <input type="hidden" id="inputiva" name="inputiva"  value="">
                    <input type="hidden" id="inputtotal" name="inputtotal"  value="">
                    <input type="hidden"  id="listaDetalles" name="listaDetalles">
                    <input type="hidden"  id="tasaoculta" name="tasaoculta">
                    <input type="hidden"  id="tipocliente" name="tipocliente">
                      
                    <div class="text-right">
                      <a onmouseover="mostrarAyuda();"><i class="fa fa-question fa-lg"></i></a>
                    </div>
                    <label><h4><b>Fecha : <?php echo date("d-m-Y"); ?></b></h4></label>

                    
                   

                  <div class="form-row">
                    <div class="btn-group mb-2" role="group" aria-label="Basic example" id="botones1">
                      <button type="button" onclick="persona_natural()" class="btn btn-success">Persona Natural</button>
                      <button type="button" onclick="persona_juridica()" class="btn btn-warning">Persona Jurídica</button>
                    </div>
                </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listCliente">Cliente : </label>
                    <div class="input-group">
                      <select class="form-control" id="listCliente" name="listCliente"  data-live-search="true" required=""></select>
                    </div>
                </div>    
              </div>

                    
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="divDetalles" ></label><br>
                        
                        <div class="table-responsive">
                          

                          <table class="table">
                            <thead>
                              <tr>
                                <th class="text-center">Código</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Existencia</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Precio $</th>
                                <th class="text-center">Total $</th>
                                <th class="text-center">Acción</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="col-md-2"><input type="text" class="form-control"  id="codigobarra" name="codigobarra"></td>
                                <td class="text-center"><label id="descripcion"></label></td>
                                <td  class="col-md-1 text-center"><label id="stock"></label></td>
                                <td class="col-md-1"><input type="number" class="form-control" disabled="" id="cantidad" name="cantidad"  min="1" max="5000"></td>
                                <td  class="col-md-1 text-center"><label id="precio"></label></td>
                                <td class="col-md-1 text-center"><label id="preciot"></label></td>
                                <td class="col-md-1 text-center"><button class="btn btn-primary" id="btnAgregarDetalle" disabled="" type="submit"><i class="fas fa-plus"></i></button></td>
                              </tr>
                            </tbody>
                          </table>

                          <table class="table"  id="tableProductosDet">
                            <thead>
                              <tr>
                                <th class="text-center">Código</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Existencia</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Precio $</th>
                                <th class="text-center">Total $</th>
                                <th class="text-center">Venta</th>
                                <th class="text-center">Cuota $</th>
                                <th class="text-center">Acción</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                          </table>
                        </div>
                        
                      </div>
                    </div>
                    
                    <div class="row text-center">
                      <div class="col-md-12">
                        <div class="tile-footer">
                          <div class="text-right">
                            <label><b>SUBTOTAL : $</b></label>
                            <label id="subtotal"></label>
                          </div>
                          <div class="text-right">
                            <label><b>IVA (13%) : $</b></label>
                            <label id="iva"></label>
                          </div>
                          <div class="text-right">
                            <label><h3><b>TOTAL : $</b></h3></label>
                            <label><h3><b  id="total"></b></h3> </label>
                          </div>
                            
                          <input type="hidden"  id="listsub" name="listsub">
               
                      
                         

                          <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                        </div>

                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
        </div>
</main>
<?php footerAdmin($data); ?>