<div class="modal fade" id="modalActivarPagos" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <table class="table" id="tableActivarPagos">
                        <thead class="text-dark">
                          <tr>
                            <th style="text-align: center; color: black;">Cuota($)</th>
                            <th style="text-align: center; color: black;">Capital($)</th>
                            <th style="text-align: center; color: black;">Intereses($)</th>
                            <th style="text-align: center; color: black;">Mora($)</th>
                            <th style="text-align: center; color: black;">Total Abono($)</th>
                            <th style="text-align: center; color: black;">Saldo($)</th>
                            <th style="text-align: center; color: black;">Activar</th>
                          </tr>
                        </thead>
                        <tbody id="datos_tabla_activar" style="text-align: center">
                        </tbody>
                      </table>
                    </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>