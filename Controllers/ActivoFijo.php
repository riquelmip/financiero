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
            $data['page_functions_js'] = "functions_activofijo.js";
            $this->views->getView($this,"ActivoFijo",$data);
        }

        

        //Para acceder a los Moddelos



        public function getActivoFijos()
        {
            if ($_SESSION['permisosMod']['leer']) {
                $arrData = $this->model->selectActivoFijos();
                $htmlDatosTabla = "";
                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = "";
                    $btnEdit = "";
                    $btnDelete = "";
                    //concatenamos la fecha XD
                    $fecha= $arrData[$i]['dia'] ."/". $arrData[$i]['mes'] ."/". $arrData[$i]['anio'];
                    $arrData[$i]['dia']=$fecha;
                    if($arrData[$i]['estado'] == 1)
                    {
                        $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                
                    
                    }else{
                        $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                    }

                    
                    if ($_SESSION['permisosMod']['leer']) {
                        $btnView = '<button class="btn btn-info btn-sm btnViewActivoFijo" onClick="fntViewActivoFijo('.$arrData[$i]['idActivoFijo'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
                    }
                    //si tiene permiso de editar se agrega el botn
                    if ($_SESSION['permisosMod']['actualizar']) {
                    
                        $btnEdit = '<button class="btn btn-primary btn-sm btnEditActivoFijo" onClick="fntEditActivoFijo('.$arrData[$i]['idActivoFijo'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                    }

                    if ($_SESSION['permisosMod']['eliminar']) {
                        $btnDelete = '<button class="btn btn-danger btn-sm btnDelActivoFijo" data-estado=1 onClick="fntDelActivoFijo('.$arrData[$i]['idActivoFijo'].',2)" title="Deshabilitar"><i class="fas fa-exclamation-circle"></i></button>';
                    }
                    //si tiene permiso de eliminar se agrega el boton
                    
                    //agregamos los botones
                    $arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' ' .$btnEdit.' ' .$btnDelete.'</div>';

                    $htmlDatosTabla.='<tr>
                                        <td>'.$arrData[$i]['dui'].'</td>
                                        <td>'.$arrData[$i]['nombre'].'</td>
                                        <td>'.$arrData[$i]['apellido'].'</td>
                                        <td>'.$arrData[$i]['nombrecargo'].'</td>
                                        <td>'.$arrData[$i]['estado'].'</td>
                                        <td>'.$arrData[$i]['opciones'].'</td>
                                     </tr>';

                }

                $htmlOptions = "";
                $arrDataCargos = $this->model->selectCargos();
                if(count($arrDataCargos) > 0 ){
                    for ($y=0; $y < count($arrDataCargos); $y++) { 
                        
                        $htmlOptions .= '<option value="'.$arrDataCargos[$y]['idcargo'].'">'.$arrDataCargos[$y]['nombre'].'</option>';
                        
                    }
                }

                $arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla, 'listacargos' => $htmlOptions);
                echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        public function getActivoFijo(int $idActivoFijo)
        {
            if ($_SESSION['permisosMod']['leer']) {
                $intIdActivoFijo = intval(strClean($idActivoFijo));
                if($intIdActivoFijo > 0)
                {
                    $arrData = $this->model->selectActivoFijoid($intIdActivoFijo);
                    if(empty($arrData))
                    {
                        $arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
                    }else{
                        $arrResponse = array('estado' => true, 'data' => $arrData);
                    }
                    
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

        public function setActivoFijo(){
            
            $intIdActivoFijo = intval($_POST['idActivoFijo']);
            $strDui =  strClean($_POST['txtDui']);
            $strNit =  strClean($_POST['txtNit']);
            $strNombre =  strClean($_POST['txtNombre']);
            $strApellido =  strClean($_POST['txtApellido']);
            $strDireccion = strClean($_POST['txtDireccion']);
            $telefono = strClean($_POST['txtTelefono']);
            $fecha = strClean( $_POST['txtFecha']);
            $porciones = explode("-", $fecha);
            $anio = intval($porciones[0]);
            $mes = intval($porciones[1]);
            $dia = intval($porciones[2]);
            $intestado=intval($_POST['listaEstado']);
            $intCargo = intval($_POST['listCargo']);


            if($intIdActivoFijo == 0)
            {
                $option = 1;
                if ($_SESSION['permisosMod']['escribir']) {
                //Crear
                $request_ActivoFijo = $this->model->insertActivoFijo($strDui,$strNit,$strNombre,$strApellido,$strDireccion,$telefono,$dia,$mes,$anio,$intestado,$intCargo);
                }
            }else{
                $option = 2;
                if ($_SESSION['permisosMod']['actualizar']) {
                //Actualizar
                $request_ActivoFijo = $this->model->updateActivoFijo($intIdActivoFijo, $strDui,$strNit,$strNombre,$strApellido,$strDireccion,$telefono,$dia,$mes,$anio,$intestado,$intCargo);
                }
            }
            
            if($request_ActivoFijo > 0 )
            {
                if($option == 1)
                {
                    $arrResponse = array('estado' => true, 'msg' =>'Datos Guardados correctamente.');
                }else{
                    $arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
                }
            }else if($request_ActivoFijo == 'exist'){
                
                $arrResponse = array('estado' => false, 'msg' => '¡Atención! El Dui ya existe.');
            }else if($request_ActivoFijo == 'exist2'){
                
                $arrResponse = array('estado' => false, 'msg' => '¡Atención! El Nit ya existe.');
            }else if($request_ActivoFijo == 'exist3'){
                
                $arrResponse = array('estado' => false, 'msg' => '¡Atención! El Telefono ya existe.');
            }else{
                $arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            
            die();
        }

        public function delActivoFijo()
        {
            if($_POST){
                if ($_SESSION['permisosMod']['eliminar']) {

                    //$json=json_encode($_POST['idActivoFijo']);
                    $todo = strClean( $_POST['idActivoFijo']);
                    $porciones = explode(",", $todo);
                    $idActivoFijo = intval($porciones[0]);
                    $estado = intval($porciones[1]);

                    // dep($estado);
                    // die();

        
                    //console.log($intestado);
                    $requestDelete = $this->model->deleteActivoFijo($idActivoFijo,$estado);
                    if($requestDelete == 'ok')
                    {
                        $arrResponse = array('estado' => true, 'msg' => 'Dado de Baja');
                    }else if($requestDelete == 'exist'){
                        $arrResponse = array('estado' => false, 'msg' => 'No puede dar de baja al ActivoFijo');
                    }else{
                        $arrResponse = array('estado' => false, 'msg' => 'Error al cambiar el estado el ActivoFijo.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

    }
 ?>