<?php
headerAdmin($data);
getModal('modalEmpleado', $data);
?>
<main class="app-content">

  <body class="fixed-left">

    <div id="wrapper">

      <!-- Start right Content here -->
      <div class="content-page">
        <!-- Start content -->
        <div class="content">

          <!-- ==================
                         PAGE CONTENT START
                         ================== -->

          <div class="page-content-wrapper">

            <div class="container-fluid">

              <div class="row ">
                <div class="col-6">
                  <div class="card m-b-20">
                    <div class="card-body">
                      <form name="formulario_datos_factura" id="formulario_datos_factura">
                        <input type="hidden" id="ingreso_factura" name="ingreso_factura" value="si_dale">
                        <input type="hidden" id="id_factura" name="id_factura" value="">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Cliente *</label>
                              <input type="text" autocomplete="off" name="nombre_cliente" data-parsley-error-message="Campo requerido" id="nombre_cliente" class="form-control" required placeholder="Ingrese el nombre" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Empleado *</label>
                              <input type="text" autocomplete="off" name="nombre_empleado" data-parsley-error-message="Campo requerido" id="nombre_empleado" class="form-control" required placeholder="Ingrese su nombre" />
                            </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Clasificación *</label>
                                <select class="form-control select2" id="p_clasificacion" name="p_clasificacion">
                                  <option selected="">Gravada</option>
                                  <option>Exentas</option>
                                  <option>No Sujetas</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Condiciones *</label>
                                <select class="form-control select-chosen select2" id="p_condiciones" name="p_condiciones" required="">

                                  <option disabled="" value="-1">Seleccione...</option>
                                  <option value="1">Contado</option>
                                  <option value="2">Crédito</option>
                                </select>
                              </div>
                            </div>





                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Factura a nombre de *</label>
                                <input type="text" autocomplete="off" name="factura_nombre_de" data-parsley-error-message="Campo requerido" id="factura_nombre_de" class="form-control" required placeholder="Ingrese el nombre" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>NIT a nombre de *</label>
                                <input type="text" autocomplete="off" name="nit_factura" data-parsley-error-message="Campo requerido" id="nit_factura" class="form-control" required placeholder="Ingrese el nit" />
                              </div>
                            </div>


                          </div>


                        </div>
                    </div>
                  </div>


                  <div class="col-6">
                    <div class="card m-b-20">
                      <div class="card-body">

                        <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Factura # *</label>
                            <input type="text" autocomplete="off" name="numero_factura" data-parsley-error-message="Campo requerido" id="numero_factura" class="form-control" required placeholder="Ingrese el número" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tipo_de_documento">Tipo de Documento *</label>
                            <select class="form-control" id="tipo_de_documento" name="tipo_de_documento" required>

                            </select>
                          </div>
                        </div>


                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Fecha de Compra *</label>
                          <input type="text" autocomplete="off" name="fecha_cita" data-parsley-error-message="Campo requerido" id="fecha_compra" class="form-control" required placeholder="Fecha de compra" />
                        </div>
                      </div>


                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Fecha de factura *</label>
                          <input type="text" autocomplete="off" name="fecha_factura" data-parsley-error-message="Campo requerido" id="fecha_factura" class="form-control" value="" required placeholder="Ingrese la fecha" />
                        </div>
                      </div>




                      <div class="col-md-6" id="credito_dias" style="display: none;">
                        <div class="form-group">
                          <label>¿Crédito a cuantos días? *</label>
                          <input type="text" autocomplete="off" name="numero_dias_credito" onkeypress="return filterFloat(event,this);" data-parsley-error-message="Campo requerido" id="numero_dias_credito" class="form-control" required placeholder="Ingrese el número" />
                        </div>
                      </div>




                    </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>



            <div class="row" style="margin-left: 2px;margin-right: 2px;">
              <div class="col-12">
                <div class="row">

                  <div class="col-md-3 col-xl-3" id="btn_vista_previa" style="cursor: pointer;">
                    <div class="mini-stat clearfix bg-white">
                      <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="fa fa-file-text"></i></span>
                      <div class="mini-stat-info">
                        <span id="personas_registras" class="counter text-blue-grey">Vista previa</span>
                        <span class="span_ele">de Factura</span>
                      </div>
                      <div class="clearfix"></div>

                    </div>
                  </div>
                  <div class="col-md-3 col-xl-3" id="btn_imprimir_factura" style="cursor: pointer;">
                    <div class="mini-stat clearfix bg-white">
                      <span class="mini-stat-icon bg-info mr-0 float-right"><i class="fa fa-print"></i></span>
                      <div class="mini-stat-info">
                        <span id="personas_registras" class="counter text-info">Imprimir</span>
                        <span class="span_ele">Factura</span>
                      </div>
                      <div class="clearfix"></div>

                    </div>
                  </div>

                  <div class="col-md-3 col-xl-3" id="agregar_servicio" style="cursor: pointer;">
                    <div class="mini-stat clearfix bg-white">
                      <span class="mini-stat-icon bg-teal mr-0 float-right"><i class="fa fa-shopping-basket"></i></span>
                      <div class="mini-stat-info">
                        <span class="counter text-teal">Agregar</span>
                        <span class="span_ele">Servicio</span>
                      </div>
                      <div class="clearfix"></div>

                    </div>
                  </div>


                  <div class="col-md-3 col-xl-3" id="btn_pago_completo" style="cursor: pointer;">
                    <div class="mini-stat clearfix bg-white">
                      <span class="mini-stat-icon bg-warning mr-0 float-right"><i class="fa fa-dollar"></i></span>
                      <div class="mini-stat-info">
                        <span class="counter text-warning">Marcar Pago</span>
                        <span class="span_ele">Completado</span>
                      </div>
                      <div class="clearfix"></div>

                    </div>
                  </div>


                </div>

                <div class="card m-b-20">
                  <div class="card-body" id="aca_tabla_cobro">




                  </div>
                </div>
              </div>
            </div>


          </div><!-- container -->

        </div> <!-- Page content Wrapper -->

      </div> <!-- content -->



    </div>
    <!-- End Right content here -->

    <div class="modal fade" id="md_registrar_servicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo servicio<br><sub>Campos marcados con * son obligatorios</sub>
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form name="fm_add_servicio" id="fm_add_servicio">
              <input type="hidden" id="ingreso_nuevo_servicio" name="ingreso_nuevo_servicio" value="si_nuevo_servicio">
              <input type="hidden" id="id_consulta" name="id_consulta" value="">
              <input type="hidden" id="id_factura" name="id_factura" value="">
              <input type="hidden" id="nombre_servicio" name="nombre_servicio">
              <input type="hidden" id="id_servicio" name="id_servicio">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nombre *</label>
                    <select class="form-control select2" id="nombre_servicio_nuevo" name="nombre_servicio_nuevo" required="">


                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nombre identificativo en factura *</label>
                    <input type="text" autocomplete="off" name="nombre_en_factura" data-parsley-error-message="Campo requerido" id="nombre_en_factura" class="form-control" required placeholder="Ingrese el detalle para la factura" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Precio*</label>
                    <input type="text" onkeypress="return filterFloat(event,this);" autocomplete="off" name="precio_servicio" data-parsley-error-message="Campo requerido" id="precio_servicio" class="form-control" required placeholder="Ingrese el precio" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Descuento (%)</label>
                    <input type="text" autocomplete="off" onkeypress="return filterFloat(event,this);" name="el_descuento" id="el_descuento" class="form-control" required placeholder="Ingrese el descuento" />
                  </div>
                </div>





              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- END wrapper -->


  </body>

  <?php footerAdmin($data); ?>