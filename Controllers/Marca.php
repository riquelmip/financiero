<?php 

	class Marca extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(11); //tiene parametro 2 porque es el de usuario, osea que lo estamos poniendo junto, ya que si tiene acceso a usuario tiene a roles
		}

		public function Marca()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 11;
			$data['page_tag'] = "Marca";
			$data['page_name'] = "marca_producto";
			$data['page_title'] = "Marca <small> Producto</small>";
			$data['page_functions_js'] = "functions_marca.js";
			$this->views->getView($this,"marca",$data);
		}

		public function getMarcas()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectMarcas();


				for ($i=0; $i < count($arrData); $i++) {
					$btnEdit = "";
					$btnDelete = "";

                    if($arrData[$i]['estado'] == 1){

                        $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                    }else{
                        $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                    }      
					
			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['actualizar']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditMarca" onClick="fntEditMarca('.$arrData[$i]['idmarca'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelMarca" onClick="fntDelMarca('.$arrData[$i]['idmarca'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getMarca(int $idmarca)
		{
			if ($_SESSION['permisosMod']['leer']) {
				$intIdmarca = intval(strClean($idmarca));
				if($intIdmarca > 0){

					$arrData = $this->model->selectMarca($intIdmarca);
					if(empty($arrData)){
						$arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('estado' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function setMarca(){
			
			$intIdmarca = intval($_POST['idmarca']);
			$strMarca =  strClean($_POST['txtNombreMarca']);
            $intestadoMarca =  intval($_POST['marcaEstado']);

			if($intIdmarca == 0){
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_marca = $this->model->insertMarca($strMarca,$intestadoMarca);
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				  $request_marca = $this->model->updateMarca($intIdmarca, $strMarca, $intestadoMarca);
				}
			}

			if($request_marca > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_marca == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! ya existe Un registro con esos datos.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

	public function setMarcaProd(){
			
			
			$strMarca =  strClean($_POST['txtNombreMarca']);
            $intestadoMarca =  intval($_POST['marcaEstado']);

			
			
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_marca = $this->model->insertMarca($strMarca,$intestadoMarca);
				}
			
			if($request_marca > 0 )
			{
				$htmlMarca = "";
				$arrDataMarca = $this->model->selectMarcasProd();
				if(count($arrDataMarca) > 0 ){
					for ($i=0; $i < count($arrDataMarca); $i++) { 
					
						$htmlMarca .= '<option value="'.$arrDataMarca[$i]['idmarca'].'">'.$arrDataMarca[$i]['nombre'].'</option>';
						
					}
				}

				$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.', 'id' => $request_marca, 'listaMarcas' => $htmlMarca);
				
			}else if($request_marca == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! ya existe Un registro con esos datos.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}


		public function delMarca(int $idmarca){

            if ($_SESSION['permisosMod']['leer']) {
				$intIdmarca = intval(strClean($idmarca));

					$arrData = $this->model->updateEstadoMarca($intIdmarca,0);
					if($arrData > 0){
						$arrResponse = array('estado' => true, 'msg' => 'Se ha eliminado el Rol');
					}else{
					  $arrResponse = array('estado' => false, 'msg' => 'No es posible eliminar una Marca asociado a Producto.');
					}	
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				die();
		}
			
		

        public function setEstadoMarca(int $idmarca){

            $intIdmarca = intval(strClean($idmarca));
            $intestadoMarca = 0;

            if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				  $request_marca = $this->model->updateEstadoMarca($intIdmarca, $intestadoMarca);


			}

            if ($_SESSION['permisosMod']['leer']) {
                $intIdmarca = intval(strClean($idmarca));
                if($intIdmarca > 0){
    
                    $arrData = $this->model->selectMarca($intIdmarca);
                    if(empty($arrData)){
                        $arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
                    }else{
                        $arrResponse = array('estado' => true, 'data' => $arrData);
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

	}

 ?>