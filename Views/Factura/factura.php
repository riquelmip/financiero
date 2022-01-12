<?php 
  headerAdmin($data); 
  getModal('modalEmpleado',$data);
?> 
<main class="app-content">
      
<body class="fixed-left">



        <!-- Begin page -->
        <div id="wrapper">
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper">

                        <div class="container-fluid">
                          <form id="fm_datos" method="post" accept-charset="utf-8">
                              <input type="hidden" name="pertenece_a" value="">
                              <input type="hidden" name="id_pertenece" value="">
                        	<div class="row">
                              
                                <div class="col-md-6 col-xl-6">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-human"></i></span>
                                        <div class="mini-stat-info">
                                            <span id="personas_registras" class="counter text-blue-grey">DETALLE DEL CLIENTE</span>
                                         

                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="row">
                                           
                                          <div class="form-group" style="width: 100%;">
                                              <label for="cliente" >Cliente:</label>
                                              <select style="width: 100% !important;" id="cliente" name="cliente" data-toggle="tooltip" class="select2 form-control" required data-placeholder="Seleccione...">
                                              </select>                  
                                          </div>
                                      
                                          
                                          <div class="row">
                                              <div class="form-group col-md-4">
                                                  <label for="sector">Sector</label>
                                                  <input type="text" class="form-control" id="sector" readonly="" value="">
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="dui">DUI</label>
                                                  <input type="text" class="form-control" id="dui" name="dui" readonly="" value="">
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="nit">NIT</label>
                                                  <input type="text" class="form-control" id="nit" name="nit" readonly="" value="">
                                              </div>
                                              <div class="form-group col-md-4 div_nrc">
                                                  <label for="nrc">NRC</label>
                                                  <input type="text" class="form-control" id="nrc" name="nrc" readonly="" value="">
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="telefono">Teléfono</label>
                                                  <input type="text" class="form-control" id="telefono" name="telefono" readonly="" value="">
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="form-group col-md-12">
                                                  <label for="correo">Correo</label>
                                                  <input type="text" class="form-control" id="correo" name="correo" readonly="" value="">
                                              </div>
                                              <div class="form-group col-md-12 div_reprecentante_legal">
                                                  <label for="reprecentante_legal">Reprecentante Legal</label>
                                                  <input type="text" class="form-control" id="reprecentante_legal" name="reprecentante_legal" readonly="" value="">
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label for="departamento">Departamento</label>
                                                  <input type="text" class="form-control" id="departamento" name="departamento" readonly="" value="">
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label for="municipio">Municipio</label>
                                                  <input type="text" class="form-control" id="municipio" name="municipio" readonly="" value="">
                                              </div>
                                              <div class="form-group col-md-12">
                                                  <label for="direccion">Dirección</label>
                                                  <textarea class="form-control" id="direccion" name="direccion" rows="3" readonly=""></textarea>
                                              </div>
                                          </div>
                                        </div>    
                                          
                                    </div>
                                </div>
                                 
                                <div class="col-md-6 col-xl-6" id="registrar_usuario" style="cursor: pointer;">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-teal mr-0 float-right"><i class="fa fa-file"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-teal">DETALLE DE FACTURACIÓN</span>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="row">
                                          <div class="form-group col-md-4">
                                              <label for="t_doc">Tipo de Documento *</label>
                                              <select class="form-control select-chosen" id="t_doc" name="t_doc" required="">
                                                 
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="n_doc">Número de Factura</label>
                                              <input type="number" class="form-control" id="n_doc" name="n_doc"  value="">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="p_fecha">Fecha *</label>
                                              <input type="text" class="form-control fecha_validar_mask" id="p_fecha" name="p_fecha" required="" value="">
                                              <input type="hidden" name="p_hora" value="">
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6 p_clasificacion">
                                              <label for="">Clasificación</label>
                                              <select class="form-control select-chosen" id="p_clasificacion" name="p_clasificacion" >
                                                  <option selected="">Gravada</option>
                                                  <option >Exentas</option>
                                                  <option >No Sujetas</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="">Condiciones *</label>
                                              <select class="form-control select-chosen" id="p_condiciones" name="p_condiciones" required="">
                                                 
                                                  <option disabled="" value="-1" <?=$selected[2]?>>Seleccione...</option>
                                                  <option value="1" >Contado</option>
                                                  <option value="2" >Crédito</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6 p_credito hide">
                                              <label for="n_placa">Días de plazo *</label>
                                              <div class="input-group">
                                                  <span class="input-group-btn">
                                                      <button type="button" class="btn btn-primary  increment" data-quantity="minus" data-field="p_credito"><i class="fa fa-minus"></i></button>
                                                  </span>
                                              <input type="number" max="90" min="1" class="form-control" value="0" id="p_credito" name="p_credito"  value="" required=''>
                                                  <span class="input-group-btn">
                                                      <button type="button" class="btn btn-primary  increment" data-quantity="plus" data-field="p_credito"><i class="fa fa-plus"></i></button>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                        
                                    </div>
                                </div>
                              
                          </div>
                          </form>


                            <div class="row">
                              <div class="col-12">
                                <div class="card m-b-20">
                                  <div class="card-body">
                                    <div id="aqui_tabla">
                                      <a style=" float: right; margin-bottom: 10px; " href="javascript:void(0)" class="btn btn-primary" id="btn_add_trabajo"><i class="fa fa-plus"></i> Agregar proceso a factura</a>
                                      <table class="table table-bordered table-striped table-vcenter">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Código</th>
                                              <th>Detalle</th>
                                              <th class="text-right">Precio($)</th>
                                              <th class="hidden-xs ">Cantidad</th>
                                              <th class="text-right">Descuento($)</th>
                                              <th class="text-right">Total($)</th>
                                              <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_procesos">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th class="hidden-xs text-right" colspan="6">Neto</th>
                                              <th class="text-right"><span  id="total_general"></span></th>
                                              <th class="text-center"></th>
                                            </tr>
                                            <tr>
                                              <th class="hidden-xs  text-right"  colspan="6">IVA</th>
                                              <th class="text-right"><span  id="total_iva"></span></th>
                                              <th class="text-center"></th>
                                            </tr>
                                            <tr>
                                              <th class="hidden-xs text-right"  colspan="6">1% RET.</th>
                                              <th class="text-right"><span  id="total_ret"></span></th>
                                              <th class="text-center"></th>
                                            </tr>
                                            <tr>
                                              <th class="hidden-xs text-right"  colspan="6">Subtotal</th>
                                              <th class="text-right"><span  id="total_subt"></span></th>
                                              <th class="text-center"></th>
                                            </tr>
                                            <tr>
                                              <th class="hidden-xs text-right"  colspan="6">Total</th>
                                              <th class="text-right"><span  id="total_total"></span></th>
                                              <th class="text-center"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                  <div class="card m-b-20">
                                    <div class="card-body">
                                       <div class="" style="height: 50px; ">
                                          <div class="text-center">
                                              <button type="button" id="btn_guardar_factura" class="btn btn-primary">CREAR FACTURA</button>
                                          </div>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                        	<div id="aqui_tabla">
                                            
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

              

            </div>
            <!-- End Right content here -->
            <div class="modal fade modal-side-fall" id="md_add_proceso" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Agregar Detalle 
                              <a href="javascript:void(0)" class="btn btn-sm btn-success" data-toggle="tooltip" title="" data-original-title="Agregar Trabajo" id="btn_addn_trabajo"><i class="gi gi-plus"></i> Nuevo trabajo</a> 

                              <a href="javascript:void(0)" class="btn btn-sm btn-warning hide" data-toggle="tooltip" title="" data-original-title="Agregar Trabajo" id="btn_cancelar_trabajo"><i class="fa fa-minus-circle"></i> Regresar</a></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                          
                      </div>
                      <div class="modal-body ">
                          <form method="post" accept-charset="utf-8" id="fm_add_trabajo" enctype="multipart/form-data">

                              <input type="hidden" id="inputRadiosChecked1" name="np_estado" checked="" value="1"  />
                              
                              <div id="add_trabajo1">
                                  <div class="row">
                                      <div class="form-group col-md-8">
                                          <label for="">Buscar Servicio</label>
                                          <select class="form-control select-chosen" id="buscar_servicio">
                                            
                                          </select>
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label for="">Código</label>
                                          <input type="text" class="form-control" id="cod_servicio" value="" placeholder="" readonly="">
                                      </div>
                                  </div>
                              </div>
                              <div id="add_trabajo2">
                                  <div class="row">
                                      <div class="form-group col-md-8 hide nombre">
                                          <label for="">Nombre</label>
                                          <input type="text" class="form-control" id="md_nombre" name="md_nombre" placeholder="" value="">
                                      </div>
                                      <div class="form-group col-md-4 hide nombre">
                                          <label for="">Código</label>
                                          <input type="text" class="form-control" id="md_codigo" name="md_codigo" placeholder="" >
                                      </div>
                                      <div class="form-group col-md-8">
                                          <label for="md_precio">Precio($)</label>
                                          <input type="number" class="form-control" id="md_precio" name="md_precio" step="any" min="0" max="10000.00" placeholder="">
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label for="">Descuento(%)</label>
                                          <div class="input-group">
                                              <span class="input-group-btn">
                                                  <button type="button" class="btn btn-primary" data-quantity="minus" data-field="md_descuento"><i class="fa fa-minus"></i></button>
                                              </span>
                                              <input type="number" class="form-control" id="md_descuento" name="md_descuento" value="0" step="1" min="0" max="100" placeholder="" readonly="">
                                              <span class="input-group-btn">
                                                  <button type="button" class="btn btn-primary" data-quantity="plus" data-field="md_descuento"><i class="fa fa-plus"></i></button>
                                              </span>
                                          </div>
                                      </div>
                                      <div class="col-md-8">
                                          
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label for="">Sub-Total($)</label>
                                          <input type="number" class="form-control" id="sub_total"  readonly="" placeholder="">
                                      </div>
                                  </div>
                              </div>
                              <br> <br> <br><br><br>
                          </form>
                      </div>
                      <div class="modal-footer"><!-- margin-0 -->
                          <a href="javascript:void(0)" class="btn btn-primary" id="btn_aplicar_proceso"> Aplicar</a>
                          <a href="javascript:void(0)" class="btn btn-default btn-pure" id="btn_cancelar_nc" data-dismiss="modal" aria-label="Close">Cancelar</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal fade" id="md_registrar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro nuevo usuario<br><sub>Campos marcados con * son obligatorios</sub>
                        </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      
                     <form name="formulario_registro" id="formulario_registro">
                        <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                        <input type="hidden" name="llave_persona" id="llave_persona" value="">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nombre *</label>
                                <input type="text" autocomplete="off" name="nombre" data-parsley-error-message="Campo requerido" id="nombre" class="form-control" required placeholder="Ingrese su nombre"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Email *</label>
                                <input type="email"  data-parsley-error-message="Campo requerido" autocomplete="off" name="email" id="email" class="form-control" required placeholder="Ingrese su email"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>DUI *</label>
                                <input type="text" autocomplete="off" name="dui" id="dui" data-parsley-error-message="Campo requerido" class="form-control" required placeholder="Ingrese su dui"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Teléfono *</label>
                                <input type="text" autocomplete="off" name="telefono" data-parsley-error-message="Campo requerido" id="telefono" class="form-control" required placeholder="Ingrese su telefono"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Fecha nacimiento *</label>
                                <input type="text" autocomplete="off" name="fecha" data-parsley-error-message="Campo requerido" id="fecha" class="form-control" required placeholder="Ingrese su fecha"/>
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Tipo persona *</label>
                                <select id="tipo_persona" name="tipo_persona" class="form-control select2">
                                     
                                    <option value="1" >Administrador</option>
                                    <option value="2" selected>Empleado</option>
                                    <option value="3" selected>Médico</option>
                                    <option value="4" selected>Asistente</option>
                                </select>               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Usuario <span class="eliminar_obligaroio">*</span></label>
                                <input maxlength="20" type="text" autocomplete="off" name="usuario" id="usuario" data-parsley-error-message="Campo requerido" class="form-control" required placeholder="Ingrese su usuario"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Contraseña<span class="eliminar_obligaroio">*</span></label>
                                <input maxlength="50" minlength="5" type="password" data-parsley-error-message="Campo requerido" autocomplete="off" name="contrasenia" id="contrasenia" class="form-control" required placeholder="Ingrese su contraseña"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Departamento *</label>
                                <select id="depto" name="depto" class="form-control select2">
                                     
                                </select>               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Municipios *</label>
                                <select id="municipio" name="municipio" class="form-control select2">
                                     
                                </select>               
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label>Seleccione la imagen</label>
                                  <input id="imagen_persona" type="file" class="filestyle" data-buttonText="Seleccionar" data-buttonname="btn-secondary">
                                  <label style="display: none;color: red;" id="error_en_la_imagen">Archivo invalido</label>
                                  
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Porcentaje de ganancia (%)<span>*</span></label>
                                <input  min="0" max="100" type="number" data-parsley-error-message="Número requerido entre 0 y 100" autocomplete="off" name="porcentaje_ganancia" id="porcentaje_ganancia" class="form-control" required placeholder="75" />
                              </div>
                            </div>





                          </div>
                     
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit"  class="btn btn-primary">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          <div class="modal fade modal-side-fall" id="md_imprimir" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer"><!-- margin-0 -->
                        <a href="javascript:void(0)" class="btn btn-primary" id="btn_imprimir2" onclick="document.getElementById('PDF_doc2').focus(); document.getElementById('PDF_doc2').contentWindow.print();"> Imprimir</a>
                        <a href="javascript:void(0)" class="btn btn-default btn-pure" id="btn_cancelar_nc" data-dismiss="modal" aria-label="Close">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- END wrapper -->

    </body>
  
<?php footerAdmin($data); ?>
    