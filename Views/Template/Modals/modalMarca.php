<!-- Modal -->
<div class="modal fade" id="modalFormMarca" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formMarca" name="formMarca">
                <input type="hidden" id="idmarca" name="idmarca" value="">
                <div class="form-group">
                  <label class="control-label">Nombre Marca</label>
                  <input class="form-control" id="txtNombreMarca" name="txtNombreMarca" type="text" placeholder="Marca" required="">
                  <p style="font-size: 13px;"><span id="msje"></span></p>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="marcaEstado" name="marcaEstado" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
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

