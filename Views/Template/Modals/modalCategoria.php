<!-- Modal -->
<div class="modal fade" id="modalFormCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Cargo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formCategoria" name="formCategoria">
                <input type="hidden" id="idCategoria" name="idCategoria" value="">
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" autocomplete="off"  id="txtNombre" name="txtNombre" type="text" placeholder="Nombre de la categoria" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Tasa de interés anual</label>
                  <input class="form-control" autocomplete="off"  id="txttasa" name="txttasa" type="text" placeholder="Tasa" required="">
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

