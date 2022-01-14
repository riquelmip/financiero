<?php 

    class ActivoFijo extends Controllers{

        //CONSTRUCTOR
        public function __construct()
        {
            parent::__construct();
            session_start();
            session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
            if (empty($_SESSION['login'])) {
                header('location: '.base_url().'/login');
            }
            getPermisos(4); 
        }

        //Utilizamos en la vista

        public function ActivoFijo()
        {

            if (empty($_SESSION['permisosMod']['leer'])) {
                header('location: '.base_url().'/dashboard');
            }
            $data['page_id'] = 3;
            $data['page_tag'] = "ActivoFijos";
            $data['page_name'] = "ActivoFijos";
            $data['page_title'] = "ActivoFijos";
            $data['page_functions_js'] = "funtions_activofijo.js";
            $this->views->getView($this,"ActivoFijo",$data);
        }

        

        public function getDetalles(){
            if ($_SESSION['permisosMod']['leer']) {
                $id=$_POST['codigo'];
                $arrData = $this->model->selectdetalles($id);
                // var_dump($arrData);
                $htmlDatosTabla = "";
                for ($i=0; $i < count($arrData); $i++) {
                    $btnEdit = "";
                    $btnDelete = "";
                    
                        //si tiene permiso de editar se agrega el botn
                        if ($_SESSION['permisosMod']['actualizar'] && $arrData[$i]['estado']==1) {
                    
                            $btnEdit = '<button class="btn btn-primary btn-sm depre" data-code="'.$arrData[$i]['codigo_correlativo'].'"  title="Ver Depreciación"><i class="fas fa-file-invoice-dollar"></i></button>';
                        }
    
                        if ($_SESSION['permisosMod']['eliminar'] && $arrData[$i]['estado']==1) {
                            $btnDelete = '<button class="btn btn-danger btn-sm estado" data-estado="'.$arrData[$i]['codigo_correlativo'].'"  title="Dar de baja"><i class="fas fa-exclamation-circle"></i></button>';
                        }
                    //ESTADO
                    if($arrData[$i]['estado']==1){
                    $arrData[$i]['estado']='<span class="badge badge-success">Activo</span>';
                    }else if($arrData[$i]['estado']==2){
                    $arrData[$i]['estado']='<span class="badge badge-info">Donado</span>';
                    }else if($arrData[$i]['estado']==3){
                    $arrData[$i]['estado']='<span class="badge badge-warning">Vendido</span>';
                    }else{
                    $arrData[$i]['estado']='<span class="badge badge-danger">Botado</span>';
                    }
                

                    if(empty($arrData[$i]['img'])){
                        $va=media().'/images/notfound.png';
                        $arr='<img src="'.$va.'"  style="width: 150px; margin-left: 50px;">';
                        
                    }else{
                        $va=media().'/images/uploads/'.$arrData[$i]['img'];
                        $arr='<img src="'.$va.'"  style="width: 150px; margin-left: 50px;">';
                    }
                    //agregamos los botones
                    $arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.'</div>';
                    $arrData[$i]['opciones2'] = '<div class="text-center">'.$btnDelete.'</div>';
                    $a=number_format($arrData[$i]['costo']);
                    $arrData[$i]['costo']=$a;
                    $htmlDatosTabla.='<tr>
                                        <td>'.$arrData[$i]['codigo_correlativo'].'</td>
                                        <td>'.$arrData[$i]['decripcion'].'</td>
                                        <td class="text-center">'.$arrData[$i]['estado'].'</td>
                                        <td>'.$arrData[$i]['opciones'].'</td>
                                        <td>'.$arrData[$i]['opciones2'].'</td>
                                      
                                     </tr>';

                }

                $arrayDatos = array('datosIndividuales' => $arrData,'arr'=>$arr,'htmlDatosTabla' => $htmlDatosTabla);
                echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function dataDepreciacion(){
            if ($_SESSION['permisosMod']['leer']) {
                $id=$_POST['codigo'];
                $arrData = $this->model->dataDepreciacion($id);
                
                $depA=floatval($arrData[0]['costo'])/intval($arrData[0]['vida_util']);
                $costo=$arrData[0]['costo'];
                $contador=0;
                $libro=0;
                $htmlDatosTabla = "";
                for ($i=0; $i <= intval($arrData[0]['vida_util']); $i++) {
                    
                    
                    

                    if($i==0){
                        $libro=$costo-$contador;
                        $htmlDatosTabla.='<tr>
                        <td>'.$i.'</td>
                        <td>'.'</td>
                        <td>'.'</td>
                        <td>'.number_format($costo).'</td>
                     </tr>';
                     
                    }else{
                        $contador=$contador+$depA;
                        $libro=$costo-$contador;
                        $htmlDatosTabla.='<tr>
                        <td>'.$i.'</td>
                        <td>'.number_format($depA).'</td>
                        <td>'.number_format($contador).'</td>
                        <td>'.number_format($libro).'</td>
                     </tr>';
                    }

                }

                $arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
                echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getActivoFijos()
        {
            if ($_SESSION['permisosMod']['leer']) {
                $arrData = $this->model->selectactivos();
                $htmlDatosTabla = "";
                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = "";
                    $btnEdit = "";
                   
                    
                    $var=$arrData[$i]['codigo'];
                    
                    if ($_SESSION['permisosMod']['leer']) {
                        $btnView = '<button class="btn btn-info btn-sm abr"  data-id="'.$var.'" title="Ver Detalles de los activos"><i class="fas fa-list"></i></button>';
                    }
                    //si tiene permiso de editar se agrega el botn
                    if ($_SESSION['permisosMod']['actualizar']) {
                    
                        $btnEdit = '<button class="btn btn-primary btn-sm btnEditActivoFijo" onClick="fntEditActivoFijo('.$arrData[$i]['codigo'].')" title="Editar"><i class="fas fa-plus"></i></button>';
                    }

                    //agregamos los botones
                    $arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' ' .$btnEdit.'</div>';
                    if(empty($arrData[$i]['img'])){
                        $foto= media().'/images/notfound.png';
                    }else{
                        $foto= media().'/images/uploads/'.$arrData[$i]['img'];
                    }
                   
                 //   $arrData[$i]['opciones2'] = '<div class="text-center">'.'<button class="btn btn-sm btnDelActivoFijo" style="background: gray;" data-estado=1 onClick="fntDelActivoFijo('.$arrData[$i]['codigo'].',2)" title="Deshabilitar"><i class="fas fa-cogs"></i></button>'.'</div>';

                    // <td><img class="minerva" src="'.$arrData[$i]['img'].'"></td>
                    $htmlDatosTabla.='<tr>
                                      <td><img class="minerva" src="'.$foto.'"></td>
                                        <td>'.$arrData[$i]['nombre'].'</td>
                                        <td>'.$arrData[$i]['codigo'].'</td>
                                        <td>'.$arrData[$i]['cantidad'].'</td>
                                        <td>'.$arrData[$i]['fecha_adquisicion'].'</td>
                                        <td>'.$arrData[$i]['opciones'].'</td>
                                      
                                     </tr>';

                }

                $arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
                echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function changeEstado(){
            $estado=strClean($_POST['valor']);
            $codigo=strClean($_POST['codigo']);
            $descrip=strClean($_POST['motivo']);
          
                    $requestchange = $this->model->changeActivoFijo($codigo,$descrip,$estado);
    
            if($requestchange>0)
            {
                $arrResponse = array('estado' => true, 'msg' => 'Cambio Realizado');
            }else{
                $arrResponse = array('estado' => false, 'msg' => 'Error al cambiar el estado ');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            die();
        }

    //     public function getActivoFijo(int $idActivoFijo)
    //     {
    //         if ($_SESSION['permisosMod']['leer']) {
    //             $intIdActivoFijo = intval(strClean($idActivoFijo));
    //             if($intIdActivoFijo > 0)
    //             {
    //                 $arrData = $this->model->selectActivoFijoid($intIdActivoFijo);
    //                 if(empty($arrData))
    //                 {
    //                     $arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
    //                 }else{
    //                     $arrResponse = array('estado' => true, 'data' => $arrData);
    //                 }
                    
    //                 echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    //             }
    //         }
    //         die();
    //     }

    //     public function setActivoFijo(){
            
    //         $intIdActivoFijo = intval($_POST['idActivoFijo']);
    //         $strDui =  strClean($_POST['txtDui']);
    //         $strNit =  strClean($_POST['txtNit']);
    //         $strNombre =  strClean($_POST['txtNombre']);
    //         $strApellido =  strClean($_POST['txtApellido']);
    //         $strDireccion = strClean($_POST['txtDireccion']);
    //         $telefono = strClean($_POST['txtTelefono']);
    //         $fecha = strClean( $_POST['txtFecha']);
    //         $porciones = explode("-", $fecha);
    //         $anio = intval($porciones[0]);
    //         $mes = intval($porciones[1]);
    //         $dia = intval($porciones[2]);
    //         $intestado=intval($_POST['listaEstado']);
    //         $intCargo = intval($_POST['listCargo']);


    //         if($intIdActivoFijo == 0)
    //         {
    //             $option = 1;
    //             if ($_SESSION['permisosMod']['escribir']) {
    //             //Crear
    //             $request_ActivoFijo = $this->model->insertActivoFijo($strDui,$strNit,$strNombre,$strApellido,$strDireccion,$telefono,$dia,$mes,$anio,$intestado,$intCargo);
    //             }
    //         }else{
    //             $option = 2;
    //             if ($_SESSION['permisosMod']['actualizar']) {
    //             //Actualizar
    //             $request_ActivoFijo = $this->model->updateActivoFijo($intIdActivoFijo, $strDui,$strNit,$strNombre,$strApellido,$strDireccion,$telefono,$dia,$mes,$anio,$intestado,$intCargo);
    //             }
    //         }
            
    //         if($request_ActivoFijo > 0 )
    //         {
    //             if($option == 1)
    //             {
    //                 $arrResponse = array('estado' => true, 'msg' =>'Datos Guardados correctamente.');
    //             }else{
    //                 $arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
    //             }
    //         }else if($request_ActivoFijo == 'exist'){
                
    //             $arrResponse = array('estado' => false, 'msg' => '¡Atención! El Dui ya existe.');
    //         }else if($request_ActivoFijo == 'exist2'){
                
    //             $arrResponse = array('estado' => false, 'msg' => '¡Atención! El Nit ya existe.');
    //         }else if($request_ActivoFijo == 'exist3'){
                
    //             $arrResponse = array('estado' => false, 'msg' => '¡Atención! El Telefono ya existe.');
    //         }else{
    //             $arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
    //         }
    //         echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            
    //         die();
    //     }

    //     public function delActivoFijo()
    //     {
    //         if($_POST){
    //             if ($_SESSION['permisosMod']['eliminar']) {

    //                 //$json=json_encode($_POST['idActivoFijo']);
    //                 $todo = strClean( $_POST['idActivoFijo']);
    //                 $porciones = explode(",", $todo);
    //                 $idActivoFijo = intval($porciones[0]);
    //                 $estado = intval($porciones[1]);

    //                 // dep($estado);
    //                 // die();

        
    //                 //console.log($intestado);
    //                 $requestDelete = $this->model->deleteActivoFijo($idActivoFijo,$estado);
    //                 if($requestDelete == 'ok')
    //                 {
    //                     $arrResponse = array('estado' => true, 'msg' => 'Dado de Baja');
    //                 }else if($requestDelete == 'exist'){
    //                     $arrResponse = array('estado' => false, 'msg' => 'No puede dar de baja al ActivoFijo');
    //                 }else{
    //                     $arrResponse = array('estado' => false, 'msg' => 'Error al cambiar el estado el ActivoFijo.');
    //                 }
    //                 echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    //             }
    //         }
    //         die();
    //     }

     }
 ?>