<?php 

	class Roles extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(3); //tiene parametro 2 porque es el de usuario, osea que lo estamos poniendo junto, ya que si tiene acceso a usuario tiene a roles
		}

		public function Roles()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Roles Usuario";
			$data['page_name'] = "rol_usuario";
			$data['page_title'] = "Roles Usuario <small> Ferretería</small>";
			$data['page_functions_js'] = "functions_roles.js";
			$this->views->getView($this,"roles",$data);
		}

		public function getRoles()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectRoles();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";

					if($arrData[$i]['estado'] == 1)
					{
						$arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					
			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['actualizar']) {
						$btnView = '<button class="btn btn-info btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['idrol'].')" title="Permisos"><i class="fas fa-key"></i></button>';
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['idrol'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['idrol'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

		public function getRol(int $idrol)
		{
			if ($_SESSION['permisosMod']['leer']) {
				$intIdrol = intval(strClean($idrol));
				if($intIdrol > 0)
				{
					$arrData = $this->model->selectRol($intIdrol);
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

		public function setRol(){
			
			$intIdrol = intval($_POST['idRol']);
			$strRol =  strClean($_POST['txtNombre']);
			$strDescipcion = strClean($_POST['txtDescripcion']);
			$intestado = intval($_POST['listaEstado']);

			if($intIdrol == 0)
			{
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_rol = $this->model->insertRol($strRol, $strDescipcion,$intestado);
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intestado);
				}
			}

			if($request_rol > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_rol == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! El Rol ya existe.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function delRol()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['eliminar']) {
					$intIdrol = intval($_POST['idrol']);
					$requestDelete = $this->model->deleteRol($intIdrol);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('estado' => true, 'msg' => 'Se ha eliminado el Rol');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
					}else{
						$arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el Rol.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

	}
 ?>