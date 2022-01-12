            <!--Extra Large Modal -->
            <div class="modal fade text-left w-100" id="modalDetalleActivofijo" style="overflow:hidden;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title white" id="myModalLabel16"><div id="titulo">Detalles del Activo Fijo</div></h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="font-size: 25px;"><b>Datos Generales</b></p> <br>
                            <div class="row">
                            <div class="col-md-4 mx-auto" id="imagen">
                            </div>
                            <div class="col-md-4 ">
                            <b>Nombre del Activo:</b><p style="margin-right: 10px;" id="nombre1" name="nombre1"></p>  
                            <b>Costo:</b><p style="margin-right: 10px;" id="costo" name="costo">  $400.99</p>  
                            </div>
                            <div class="col-md-4 ">
                            <b>Vida Uttil:</b><p style="margin-right: 10px;" id="anios" value="anios"> 5 años</p> 
                            <b>Fecha de Adquisición:</b><p style="margin-right: 10px;" id="fecha" name="fecha">01/01/2022</p> 

                            </div>
                            </div>
                            <form class="row" id="formDetalle" name="formDetalle">
                                <div class="col- col-12">

                                <div class="modal-body">
                          <table class="table table-striped" id="tabledetalle">
                                            <thead>
                                                <tr>
                                                  <th>Código</th>
                                                  <th>Descripción</th>
                                                  <th>Estado</th>
                                                  <th>Ver Depreciación</th>
                                                  <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="datos_detalle">  

                                            </tbody >
                                        </table>

              </div>
      
                                </div>
                             
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Cancelar</span>
                            </button>
                        
                        </div>
                        </form>
                    </div>
                </div>


            </div>