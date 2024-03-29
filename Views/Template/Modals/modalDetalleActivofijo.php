            <!--Extra Large Modal -->
            <div class="modal fade text-left w-100" id="modalDetalleActivofijo" style="overflow:hidden;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title white" id="myModalLabel16">
                                <div id="titulo">Detalles del Activo Fijo</div>
                            </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="font-size: 25px;"><b>Datos Generales</b></p> <br>
                            <div class="row">
                                <div class="col-md-4 mx-auto" id="imagen">
                                </div>
                                <div class="col-md-4 ">
                                    <b>Nombre del Activo:</b>
                                    <p style="margin-right: 10px;" id="nombre1" name="nombre1"></p>
                                    <b>Costo:</b>
                                    <p style="margin-right: 10px;" id="costo" name="costo"> $400.99</p>
                                </div>
                                <div class="col-md-4 ">
                                    <b>Vida Uttil:</b>
                                    <p style="margin-right: 10px;" id="anios" value="anios"> 5 años</p>
                                    <b>Fecha de Adquisición:</b>
                                    <p style="margin-right: 10px;" id="fecha" name="fecha">01/01/2022</p>

                                </div>
                            </div>
                            <form class="row" id="formDetalle" name="formDetalle">
                                <div class="col- col-12">

                                    <div class="modal-body">
                                        <table class="table table-striped" id="tabledetalle">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Estado</th>
                                                    <th>Ver Depreciación</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="datos_detalle">

                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Cancelar</span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL PARA MOSTRAR DEPRECIACIÓN -->
<div class="modal fade" id="modalViewDepre" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header header-secondary">
      <h5 class="modal-title" id="titleModal">Depreciación de el Activo Fijo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped" id="tableDepre">
        <thead>
            <tr>
                <th>N</th>
                <th>Dep. Anual</th>
                <th>Dep. Acumulada</th>
                <th>Valor en Libro</th>
            </tr>
        </thead>
          <tbody id="detalle_depre">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

                <!-- MODAL PARA CAMBIAR ESTADO -->
<div class="modal fade" id="modalEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header header-secondary">
      <h5 class="modal-title" id="titleModal">Cambiar estado del Activo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="codigoCorre" id="codigoCorre" value="0">
        <label for="motivo">Descripción:</label>
      <textarea class="form-control" id="motivo" name="motivo" rows="2" autocomplete="off"></textarea>
      <br>
        <table class="table table-striped">
     
          <tbody>
            <tr>
              <div class="row">
              <td class="text-center"><button class="btn btn-info donar"><i class="fas fa-hands-helping"></i></button><p><b>DONAR</b></p></label></td>
              <td class="text-center"><button class="btn btn-warning vender"><i class="fas fa-hand-holding-usd"></i></button><p><b>VENDER</b></p></td>
              <td class="text-center"><button class="btn btn-danger botar"><i class="far fa-trash-alt"></i></button><p><b>BOTAR</b></p></td>

              </div>
            </tr>

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditarA" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formEditar" name="formEditar" class="form-horizontal">
              <input type="hidden" id="modificando" name="modificando" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>
              
              <div class="form-row">
                <div class="form-group col-md-6">
                <label for="txtCosto">Costo</label>
                  <input type="number"  class="form-control phone"  id="txtCosto" name="txtCosto"  required autocomplete="off" >
                </div>


                <div class="form-group col-md-6">
                  <label for="txtVida">Vida Útil</label>
                  <input type="number" class="form-control" id="txtVida" name="txtVida"  required autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="txtFecha">Fecha Adquisición</label>
                  <!-- solo aceptamos a gente que tenga maximo 30 años y 18 años jajaja -->
                  <input type="date" class="form-control"  id="txtFecha" name="txtFecha"  required autocomplete="off">
                </div>



             </div>
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-success guardarEditar" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>
