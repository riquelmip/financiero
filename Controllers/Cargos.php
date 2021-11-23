<?php 

	class Cargos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(14); //tiene parametro 2 porque es el de usuario, osea que lo estamos poniendo junto, ya que si tiene acceso a usuario tiene a roles
		}

		public function Cargos()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Cargos";//Nombre superior
			$data['page_name'] = "cargo_cargo";//Nombre de la pagina 
			$data['page_title'] = "Cargos"; //Nombre del titulo en la vista
			$data['page_functions_js'] = "functions_cargos.js";// Funcion de js para las acciones
			$this->views->getView($this,"cargos",$data);//Se refiere al nombre de la vista
		}

		
		public function getCargos() //Obtiene todas las categorias para cargarlas a la tabla de datos
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectCargos();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['actualizar']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditCargos" onClick="fntEditCargos('.$arrData[$i]['idcargo'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelCargos" onClick="fntDelCargos('.$arrData[$i]['idcargo'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getCargo(int $idcate) //Obtiene una categoria especifica
		{
			if ($_SESSION['permisosMod']['leer']) {
				$intIdcate = intval(strClean($idcate));
				if($intIdcate > 0)
				{
					$arrData = $this->model->selectCargo($intIdcate);
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


		public function setCargos(){ //Hace la insercion y edita
			
			$intId = intval($_POST['idCargo']);
			$strCat =  strClean($_POST['txtNombre']);

			if($intId == 0)
			{
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_cat = $this->model->insertCargo($strCat);
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				$request_cat = $this->model->updateCargo($intId, $strCat);
				}
			}

			if($request_cat > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_cat == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! El cargo ya existe.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function delCargos() //Elimina la categoria
		{
			if($_POST){
				if ($_SESSION['permisosMod']['eliminar']) {
					$intIdcatee = intval($_POST['idcargo']);
					$requestDelete = $this->model->deleteCargo($intIdcatee);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('estado' => true, 'msg' => 'Se ha eliminado el cargo');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => 'No es posible eliminar un cargo asociado a un empleado.');
					}else{
						$arrResponse = array('estado' => false, 'msg' => 'Error al eliminar la cargo.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}


	}
 ?>