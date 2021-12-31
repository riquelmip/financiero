
<div class="modal fade" id="modalFormClienteventa" tabindex="-1" role="dialog" aria-hidden="true">
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
              <p>Los campos con <span style="color: red;">(*)</span> son obligatorios.</p>
              <form id="formClienteventa" name="formClienteventa">
                <div class="form-group">
                  <label class="control-label">DUI</label>
                  <input type="text" class="form-control" id="txtDuiv" data-mask="00000000-0" name="txtDuiv" type="text" placeholder="00000000-0">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombre <span style="color: red;">(*)</span></label>
                  <input type="text" class="form-control" id="txtNombrev" name="txtNombrev" type="text" placeholder="Nombre" required="">
                  <p style="font-size: 13px;"><span id="msje1"></span></p>
                </div>
                <div class="form-group">
                  <label class="control-label">Apellido <span style="color: red;">(*)</span></label>
                  <input type="text" class="form-control" id="txtApellidov" name="txtApellidov" type="text" placeholder="Apellido" required="">
                  <p style="font-size: 13px;"><span id="msje2"></span></p>
                </div>
                <div class="form-group">
                  <label class="control-label">Telefóno</label>
                  <input type="text" class="form-control" id="txtTelefonov" name="txtTelefonov" type="text" placeholder="0000-0000" data-mask="0000-0000">
                </div>
                <input type="hidden" id="intEstadov" name="intEstadov" value="1">
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span>Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modalAyuda" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5>Ayuda</h5>
        <hr>
        <h5>Pasos para realizar la venta:</h5>
        <p><b>1. Seleccionar cliente:</b></p>
        <p>Primeramente, debe seleccionar el cliente al que se le hará la venta, si éste no aparece, debe ingresar un nuevo cliente, para eso, debe dar click en el botón de "Agregar cliente", tal como se muestra en la siguiente imagen.</p>
        <img src="<?= media(); ?>/images/ayuda/crearcliente-nuevaventa.png" alt="" width="450">
        <p style="color: blue;">Nota. Puede registrar un cliente llenando todos los campos o solo llenando el nombre y apellido.</p>

        <p><b>2. Buscar producto y agregarlo al carrito:</b></p>
        <p>En el campo "Código" debe ingresar el código del producto y automáticamente se pondrán los datos de ese producto en los campos correspondientes.</p>
        <p>Puede cambiar la cantidad que se venderá en el campo "Cantidad".</p>
        <p>Al dar "click" en el botón con el símbolo de (+), ese producto se agrega al carrito de venta.</p>
        <img src="<?= media(); ?>/images/ayuda/buscarproducto-nuevaventa.png" alt="" width="450">

        <br><br>
        <p><b>3. Carrito de ventas y eliminar producto del carrito:</b></p>
        <p>Luego de haber añadido los productos al carrito, automáticamente se calcula el subtotal, iva y total de la venta.</p>
        <p>Al dar "click" en el botón "eliminar", ese producto se quita del carrito de venta.</p>
        <img src="<?= media(); ?>/images/ayuda/carritoventa-nuevaventa.png" alt="" width="450">

        <br><br>
        <p><b>4. Realizar la venta:</b></p>
        <p>Al dar "click" en el botón "Guardar", la venta se realiza y se crea el ticket.</p>


      </div>
      
    </div>
  </div>
</div>

