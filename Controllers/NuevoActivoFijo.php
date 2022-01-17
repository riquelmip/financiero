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
            getPermisos(15); 
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
            $data['bandera'] = 0;
            $data['page_functions_js'] = "nuevoactivofijo.js";
            $this->views->getView($this,"NuevoActivoFijo",$data);
        }

        public function generarcode(){// generator codeeeee!!!
            $tipo =  strClean($_POST['tipo']);
            $nombre =  strClean($_POST['nombre']);
            $partes= explode(' ',$nombre);
            $nombre=$partes[0]; 
            $num= $this->model->foundnumber(intval($tipo));
            // var_dump($num);
            $codtipo=$this->model->codetipo($tipo);
            $indicador="";

            if(intval($num[0]['num'])>=0 && intval($num[0]['num'])<=9){
                $i=intval($num[0]['num'])+1;
              $indicador='00'.$i;
            }else if(intval($num[0]['num'])>=10 && intval($num[0]['num'])<=99){
                $i=intval($num[0]['num'])+1;
                $indicador='0'.$i;
            }else{
                $i=intval($num[0]['num'])+1;
                $indicador=$i;
            }

             $codigo='ELT-'.$nombre.'-'.$codtipo[0]['codigo'].'-'.$indicador;
             $arrResponse=array("codigo" => $codigo);
             echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
             die();
        }

        public function getSelects(){
            $htmltipos="";
            $htmlprovee="";
            $arrayTipos = $this->model->getTipo();
            if(count($arrayTipos) > 0 ){
                $htmltipos .= '<option value=-1>Seleccione</option>';
                for ($i=0; $i < count($arrayTipos); $i++) { 
                    $htmltipos .= '<option value="'.$arrayTipos[$i]['idtipoactivo'].'">'.$arrayTipos[$i]['nombre'].'</option>';
                }
            }
            

            $arrayProvee = $this->model->getProveedores();
            if(count($arrayTipos) > 0 ){
                $htmlprovee .= '<option value=-1>Seleccione</option>';
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

        //set imagen
        public function setImage(){
			if($_POST){
				if(empty($_POST['codigo'])){
					$arrResponse = array('status' => false, 'msg' => 'Antes ingrese datos');
				}else{
					$idProducto = intval($_POST['idproducto']);
					$foto      = $_FILES['foto'];
					$imgNombre = 'ac_'.md5(date('d-m-Y H:i:s')).'.jpg';
					$request_image = $this->model->insertImage($idProducto,$imgNombre);
					if($request_image){
						$uploadImage = uploadImage($foto,$imgNombre);
						$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
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
            $cantidad=intval($_POST['cantidad']);
            $estado=intval($_POST['estado']);
            // $img=intval($_POST['img']);
            $foto='';
            if(!empty($_FILES['foto'])){
            $foto      = $_FILES['foto'];
            $imgNombre = 'ac_'.md5(date('d-m-Y H:i:s')).'.jpg';
            }else{
                $imgNombre=null;
            }

            $option="";
            if($bandera == 0)
            {
                $option = 1;
                $estado=1;
                if ($_SESSION['permisosMod']['escribir']) {
               // $estado=1;
                $request_ActivoFijo = $this->model->insertActivoFijo($codigo,$nombre,$descripcion,$tipo,$proveedor,$fecha,$garantia,$costo,$cantidad,$estado,$imgNombre);
                }
            }else{
                $option = 2;
                if ($_SESSION['permisosMod']['actualizar']) {
                //Actualizar
                $request_ActivoFijo = $this->model->updateActivoFijo($codigo,$nombre,$descripcion,$tipo,$proveedor,$fecha,$garantia,$costo,$cantidad,$estado);
                }
            }
            
            if($request_ActivoFijo > 0 ){
                if($foto!=''){//Condicionando si la variable va vacia LOL
                $uploadImage = uploadImage($foto,$imgNombre);
                }
                for ($i=0; $i <$cantidad ; $i++) { 
                    $a=$i+1;
                    $code=$codigo.'-'.$a;
                    $request_Detalle = $this->model->insertDetalle($code,$codigo,$descripcion,$estado,$garantia);
                }
            }

            if($request_Detalle > 0 )
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