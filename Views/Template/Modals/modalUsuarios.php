<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formUsuario" name="formUsuario" class="form-horizontal">
              <input type="hidden" id="idUsuario" name="idUsuario" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listRolid">Empleado</label>
                    <select class="form-control" data-live-search="true" id="listEmpleados" name="listEmpleados" required >
                    </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                <label for="txtEmail">Email</label>
                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtPassword">Contraseña</label>
                  <input type="password" class="form-control" id="txtPassword" name="txtPassword" maxlength="20" autocomplete="off">
                  <p style="font-size: 13px;"><span id="msje"></span></p>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listRolid">Tipo usuario</label>
                    <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required >
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="listStatus">Estado</label>
                    <select class="form-control selectpicker" id="listEstado" name="listEstado" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
             </div>
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>DUI Empleado:</td>
              <td id="celDui">654654654</td>
            </tr>
            <tr>
              <td>NIT Empleado:</td>
              <td id="celNit">654654654</td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre">Jacob</td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celApellido">Jacob</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celTelefono">Larry</td>
            </tr>
            <tr>
              <td>Email (Usuario):</td>
              <td id="celEmail">Larry</td>
            </tr>
            <tr>
              <td>Tipo Usuario:</td>
              <td id="celTipoUsuario">Larry</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado">Larry</td>
            </tr>
            <tr>
              <td>Fecha registro:</td>
              <td id="celFechaRegistro">Larry</td>
            </tr>
          </tbody>
        </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

