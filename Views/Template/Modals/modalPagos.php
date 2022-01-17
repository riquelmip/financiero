<div class="modal fade" id="modalVerPagos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header headerRegister">
            <h5 class="modal-title h4" >Ver registro pago de cuotas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
              <div class="tile">
                    <div class="table-responsive">
                      <table class="table" id="tablePagos">
                        <thead class="text-dark">
                          <tr>
                            <th style="text-align: center; color: black;">Mes</th>
                            <th style="text-align: center; color: black;">Fecha Pago</th>
                            <th style="text-align: center; color: black;">Fecha Pagó</th>
                            <th style="text-align: center; color: black;">Cuota($)</th>
                            <th style="text-align: center; color: black;">Capital($)</th>
                            <th style="text-align: center; color: black;">Intereses($)</th>
                            <th style="text-align: center; color: black;">Mora($)</th>
                            <th style="text-align: center; color: black;">Abono Capital($)</th>
                            <th style="text-align: center; color: black;">Total Abono($)</th>
                            <th style="text-align: center; color: black;">Saldo($)</th>
                            <th style="text-align: center; color: black;">Estado</th>
                          </tr>
                        </thead>
                        <tbody id="datos_tabla_pago" style="text-align: center">
                        </tbody>
                      </table>
                    </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEmbargo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Embargo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formFiador2" name="formFiador2">
                <input type="hidden" id="id_fiador" name="id_fiador" value="">
                <div class="form-group">
                  <label class="control-label">Carta de Embargo</label>
                  <input type="file" name="documento12">
                </div>
                <div class="form-group">
               
                  <input class="form-control" autocomplete="off"  id="codigo2" name="codigo2" type="text" placeholder="Tasa" hidden>
                </div>
                <div class="form-group">
           
                  <input class="form-control" autocomplete="off"  id="codigo22" name="codigo22" type="text" placeholder="Tasa" hidden>
                </div>
                <div class="form-group">
                  <input class="form-control" autocomplete="off"  id="codigo23" name="codigo23" type="text" placeholder="Tasa" hidden>
                </div>
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>