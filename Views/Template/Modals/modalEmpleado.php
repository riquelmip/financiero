<!-- Modal -->
<?php
date_default_timezone_set("America/El_Salvador");


?>

<div class="modal fade" id="modalFormEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formEmpleado" name="formEmpleado" class="form-horizontal">
              <input type="hidden" id="idEmpleado" name="idEmpleado" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>
              
              <div class="form-row">
                <div class="form-group col-md-6">
                <label for="txtDui">DUI</label>
                  <input type="text" data-mask="00000000-0" class="form-control phone"  id="txtDui" name="txtDui"  required autocomplete="off" >
                </div>


                <div class="form-group col-md-6">
                  <label for="txtNit">NIT</label>
                  <input type="text" data-mask="0000-000000-000-0" class="form-control" id="txtNit" name="txtNit"  required autocomplete="off">
                </div>
                  <!-- //esto va más abajo -->

                 <div class="form-group col-md-6">
                  <label for="txtNombre">Nombre</label>
                  <input type="text" class="form-control" maxlength="50" id="txtNombre" name="txtNombre"  required autocomplete="off">
                  <p style="font-size: 13px;"><span id="msje1"></span></p>
                </div>

                   <div class="form-group col-md-6">
                  <label for="txtApellido">Apellido</label>
                  <input type="text" class="form-control" maxlength="50" id="txtApellido" name="txtApellido"  required autocomplete="off">
                  <p style="font-size: 13px;"><span id="msje2"></span></p>
                </div>

                  <div class="form-group col-md-6">
                  <label for="txtDireccion">Direccion</label>
                  <textarea type="text" class="form-control" id="txtDireccion" name="txtDireccion" required autocomplete="off"></textarea>
                </div>

                 <div class="form-group col-md-6">
                  <label for="txtTelefono">Telefono</label>
                  <input type="tel"  class="form-control" data-mask="0000-0000" id="txtTelefono" name="txtTelefono" required autocomplete="off" >
                </div>

                <div class="form-group col-md-6">
                  <label for="txtFecha">Fecha Nacimiento</label>
                  <!-- solo aceptamos a gente que tenga maximo 30 años y 18 años jajaja -->
                  <input type="date" class="form-control" min="1961-01-01" max="2003-12-31" id="txtFecha" name="txtFecha"  required autocomplete="off">
                </div>


                
              
                <div class="form-group col-md-6">
                    <label for="listCargo">Cargo</label>
                    <select class="form-control" data-live-search="true" id="listCargo" name="listCargo" required >
                    </select>

                </div>


                   <div class="form-group col-md-6">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="listaEstado" name="listaEstado" required="">
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
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


<!-- MODAL PARA MOSTRAR EMPLEADOS -->
<div class="modal fade" id="modalViewEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Empleado</h5>
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
              <td>Direccion:</td>
              <td id="celDireccion">Jacob</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celTelefono">Larry</td>
            </tr>
              <td>Estado:</td>
              <td id="celEstado">Larry</td>
            </tr>
            <tr>
              <td>Fecha :</td>
              <td id="celFechaRegistro">Larry</td>
            </tr>
             <tr>
              <td>Cargo:</td>
              <td id="celCargo">Larry</td>
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

