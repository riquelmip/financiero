<!-- Modal -->
<div class="modal fade" id="modalFormUnidades" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Unidad Medida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formUnidades" name="formUnidades">
                <input type="hidden" id="idunidad" name="idunidad" value="">
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" maxlength="100" autocomplete="off"  id="txtNombre" name="txtNombre" type="text" placeholder="Nombre de la unidad medida" required="">
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

