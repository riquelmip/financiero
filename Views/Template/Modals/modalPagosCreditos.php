<div class="modal fade" id="modalPagosCreditos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header headerRegister">
            <h5 class="modal-title h4" >Control pago de Cuotas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
              <div class="tile">
                    <p><h4 class="modal-title h4" >Producto: </h4><h4 class="modal-title h4" id="nombreProducto"></h4></p>
                    <br>
                    <div class="table-responsive">
                      <table class="table" id="tablePagosCreditos">
                        <thead class="text-dark">
                          <tr>
                            <th style="text-align: center; color: black;">Cuota Mensual($)</th>
                            <th style="text-align: center; color: black;">Dia de Pago</th>
                            <th style="text-align: center; color: black;">Monto Crédito ($)</th>
                            <th style="text-align: center; color: black;">Pagar Cuota / Abono Capital</th>
                          </tr>
                        </thead>
                        <tbody id="datos_tabla" style="text-align: center">
                        </tbody>
                      </table>
                    </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>