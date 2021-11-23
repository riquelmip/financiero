
<div class="modal fade" id="modalFormCliente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formCliente" name="formCliente">
                <input type="hidden" id="idcliente" name="idcliente" value="">
                <div class="form-group">
                  <label class="control-label">DUI</label>
                  <input type="text" class="form-control" id="txtDui" data-mask="00000000-0" name="txtDui" type="text" placeholder="00000000-0" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input type="text" class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre" required="">
                  <p style="font-size: 13px;"><span id="msje1"></span></p>
                </div>
                <div class="form-group">
                  <label class="control-label">Apellido</label>
                  <input type="text" class="form-control" id="txtApellido" name="txtApellido" type="text" placeholder="Apellido" required="">
                  <p style="font-size: 13px;"><span id="msje2"></span></p>
                </div>
                <div class="form-group">
                  <label class="control-label">Telefóno</label>
                  <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" type="text" placeholder="0000-0000" data-mask="0000-0000"required="">
                </div>
                <input type="hidden" id="intEstado" name="intEstado" value="1">
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
