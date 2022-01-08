<?php 

    class NuevoActivoFijo extends Controllers{

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

        public function NuevoActivoFijo()
        {

            if (empty($_SESSION['permisosMod']['leer'])) {
                header('location: '.base_url().'/dashboard');
            }
            $data['page_id'] = 3;
            $data['page_tag'] = "Nuevo Activo Fijo";
            $data['page_name'] = "Nuevo Activo Fijo";
            $data['page_title'] = "Nuevo Activo Fijo";
            $data['page_functions_js'] = "nuevoactivofijo.js";
            $this->views->getView($this,"NuevoActivoFijo",$data);
        }

        public function getSelects(){
            $htmltipos="";
            $htmlprovee="";
            $arrayTipos = $this->model->getTipo();
            if(count($arrayTipos) > 0 ){
                for ($i=0; $i < count($arrayTipos); $i++) { 
                    $htmltipos .= '<option value="'.$arrayTipos[$i]['idtipoactivo'].'">'.$arrayTipos[$i]['nombre'].'</option>';
                }
            }
            

            $arrayProvee = $this->model->getProveedores();
            if(count($arrayTipos) > 0 ){
                for ($i=0; $i < count($arrayProvee); $i++) { 
                    $htmlprovee .= '<option value="'.$arrayProvee[$i]['idproveedor'].'">'.$arrayProvee[$i]['nombre'].'</option>';
                }
            }

            $arrResponse = array('tipos' => $htmltipos,'proveedores' => $htmlprovee);
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();	
        }

        //Para acceder a los Moddelos

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
            
            $bandera =  strClean($_POST['bandera']);
            $codigo =  strClean($_POST['codigo']);
            $nombre =  strClean($_POST['nombre']);
            $descripcion =  strClean($_POST['descripcion']);
            $tipo =  intval($_POST['tipo']);
            $proveedor = strClean($_POST['proveedor']);
            $fecha = strClean($_POST['fechaadqui']);
            $garantia=intval($_POST['garantia']);
            $costo=strClean($_POST['costo']);
            $cantidad=strClean($_POST['cantidad']);
            $estado=intval($_POST['estado']);
            // $img=intval($_POST['img']);
            $option="";
            if($bandera == 0)
            {
                $option = 1;
                if ($_SESSION['permisosMod']['escribir']) {
               // $estado=1;
                $request_ActivoFijo = $this->model->insertActivoFijo($codigo,$nombre,$descripcion,$tipo,$proveedor,$fecha,$garantia,$costo,$cantidad,$estado);
                }
            }else{
                $option = 2;
                if ($_SESSION['permisosMod']['actualizar']) {
                //Actualizar
                $request_ActivoFijo = $this->model->updateActivoFijo($codigo,$nombre,$descripcion,$tipo,$proveedor,$fecha,$garantia,$costo,$cantidad,$estado);
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
            }else if($request_ActivoFijo == 'exist'){//si fallo
                
                $arrResponse = array('estado' => false, 'msg' => '¡Atención! El Dui ya existe.');
        
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