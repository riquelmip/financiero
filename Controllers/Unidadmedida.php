<?php 

	class Unidadmedida extends Controllers{

		//CONSTRUCTOR
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(12); 
		}

		//Utilizamos en la vista

		public function Unidadmedida()
		{

			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Unidadmedida";
			$data['page_name'] = "Unidad Medida";
			$data['page_title'] = "Unidad Medida";
			$data['page_functions_js'] = "functions_Unidadmedida.js";
			$this->views->getView($this,"Unidadmedida",$data);
		}

		//Para acceder a los Moddelos


		public function getunidades()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectUnidades();

				for ($i=0; $i < count($arrData); $i++) {

					$btnEdit = "";
					$btnDelete = "";	
			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['actualizar']) {
					
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditUnidad" onClick="fntEditUnidad('.$arrData[$i]['idunidad'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelunidad" onClick="fntDelunidad('.$arrData[$i]['idunidad'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getUnidad(int $idUnidad)
		{
			if ($_SESSION['permisosMod']['leer']) {
				$intIdUnidad = intval(strClean($idUnidad));
				if($intIdUnidad > 0)
				{
					$arrData = $this->model->selectUnidadid($intIdUnidad);
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

		public function setUnidad(){
			
			$intIdUnidad = intval($_POST['idunidad']);
			$strUnidad =  strClean($_POST['txtNombre']);

			if($intIdUnidad == 0)
			{
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_unidad = $this->model->insertunidad($strUnidad);
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				$request_unidad = $this->model->updateunidad($intIdUnidad, $strUnidad);
				}
			}

			if($request_unidad > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_unidad == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! La Unidad de Medida ya existe.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function setUnidadProd(){
			
			
			$strUnidad =  strClean($_POST['txtNombre']);

			
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_unidad = $this->model->insertunidad($strUnidad);
				}
			

			if($request_unidad > 0 )
			{
				//OPTIONS SELECTS DE UNIDAD DE MEDIDA
				$htmlUnidad = "";
				$arrDataUnidad = $this->model->selectUnidades();
				if(count($arrDataUnidad) > 0 ){
					for ($i=0; $i < count($arrDataUnidad); $i++) { 
					
						$htmlUnidad .= '<option value="'.$arrDataUnidad[$i]['idunidad'].'">'.$arrDataUnidad[$i]['nombre'].'</option>';
						
					}
				}

				$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.', 'id' => $request_unidad, 'listaUnidades' => $htmlUnidad);
				
			}else if($request_unidad == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! La Unidad de Medida ya existe.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function delUnidad()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['eliminar']) {
					$intIdunidad = intval($_POST['idunidad']);
					$requestDelete = $this->model->deleteunidad($intIdunidad);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('estado' => true, 'msg' => 'Se ha eliminado la unidad');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => 'Aún existen registros de productos asociados a esta Unidad');
					}else{
						$arrResponse = array('estado' => false, 'msg' => 'Error al eliminar la unidad.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

	}
 ?>