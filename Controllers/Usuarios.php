<?php 

	class Usuarios extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(2);
		}

		public function Usuarios()
		{
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Usuarios";
			$data['page_title'] = "USUARIOS <small> Ferretería</small>";
			$data['page_name'] = "usuarios";
			$data['page_functions_js'] = "functions_usuarios.js";
			$this->views->getView($this,"usuarios",$data);
		}

		public function setUsuario(){
			if($_POST){
				
				if(empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listEstado']) || empty($_POST['listEmpleados']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$idUsuario = intval($_POST['idUsuario']);
					$intEmpleadoId = intval(strClean($_POST['listEmpleados']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$intTipoId = intval(strClean($_POST['listRolid']));
					$intEstado = intval(strClean($_POST['listEstado']));
					$request_user = "";
					if($idUsuario == 0)
					{
						$option = 1;
						$strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
						if ($_SESSION['permisosMod']['escribir']) {
							$request_user = $this->model->insertUsuario($strEmail,
																				$strPassword, 
																				$intTipoId, 
																				$intEstado,
																				$intEmpleadoId );
						}
					}else{
						$option = 2;
						$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
						if ($_SESSION['permisosMod']['actualizar']) {
							$request_user = $this->model->updateUsuario($idUsuario,
																		$strEmail,
																		$strPassword, 
																		$intTipoId, 
																		$intEstado,
																		$intEmpleadoId
																		);
						}

					}

					if($request_user > 0 )
					{
						if($option == 1){
							$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_user == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			
			die();
		}

		public function getUsuarios()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectUsuarios();
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
					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['leer']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idusuario'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
					}
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['actualizar']) {
						//Para que un usuario admin no pueda editar informacion de otro usuario admin, solo los que no son admin puede editar
						if (($_SESSION['idUser'] == 1 AND $_SESSION['userData']['idrol'] == 1) || ($_SESSION['userData']['idrol'] == 1 AND $arrData[$i]['idrol'] != 1) ) {
							$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditUsuario(this,'.$arrData[$i]['idusuario'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
						}else{
							$btnEdit = '<button class="btn btn-secondary  btn-sm " disabled><i class="fas fa-pencil-alt"></i></button>';
						}
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						//Para que un usuario admin no pueda editar informacion de otro usuario admin, solo los que no son admin puede editar, yla ultima validacion es para bloquearle al usuario root la opcion de eliminarse a si mismo
						if (($_SESSION['idUser'] == 1 AND $_SESSION['userData']['idrol'] == 1) || ($_SESSION['userData']['idrol'] == 1 AND $arrData[$i]['idrol'] != 1) AND ($_SESSION['userData']['idusuario'] != $arrData[$i]['idusuario'])) {
							$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idusuario'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
					}else{
							$btnDelete = '<button class="btn btn-secondary  btn-sm " disabled><i class="fas fa-trash-alt"></i></button>';
						}
					}
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getUsuario($idpersona){
			if ($_SESSION['permisosMod']['leer']) {
				$idusuario = intval($idpersona);
				if($idusuario > 0)
				{
					$arrData = $this->model->selectUsuario($idusuario);
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



		public function getSelects()
		{
			$htmlEmpleados = "";
			$arrDataEmpleados = $this->model->selectEmpleados();
			if(count($arrDataEmpleados) > 0 ){
				for ($i=0; $i < count($arrDataEmpleados); $i++) { 
					if($arrDataEmpleados[$i]['estado'] == 1 ){
					$htmlEmpleados .= '<option value="'.$arrDataEmpleados[$i]['idempleado'].'">'.$arrDataEmpleados[$i]['dui']." - ".$arrDataEmpleados[$i]['nombre'].$arrDataEmpleados[$i]['apellido'].'</option>';
					}
				}
			}

			$htmlRoles = "";
			$arrDataRoles = $this->model->selectRoles();
			if(count($arrDataRoles) > 0 ){
				for ($i=0; $i < count($arrDataRoles); $i++) { 
					if($arrDataRoles[$i]['estado'] == 1 ){
					$htmlRoles .= '<option value="'.$arrDataRoles[$i]['idrol'].'">'.$arrDataRoles[$i]['nombrerol'].'</option>';
					}
				}
			}
			$arrResponse = array('roles' => $htmlRoles, 'empleados' => $htmlEmpleados);
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();		
		}

		public function delUsuario()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['eliminar']) {
					$intIdpersona = intval($_POST['idUsuario']);
					$requestDelete = $this->model->deleteUsuario($intIdpersona);
					if($requestDelete)
					{
						$arrResponse = array('estado' => true, 'msg' => 'Se ha eliminado el usuario');
					}else{
						$arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el usuario.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function perfil(){
			$data['page_tag'] = "Perfil";
			$data['page_title'] = "Perfil de Usuario";
			$data['page_name'] = "perfil";
			$data['page_functions_js'] = "functions_usuarios.js";
			$this->views->getView($this,"perfil",$data);
		}

		public function putPerfil(){
			if ($_POST) {
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono'])) {
					$arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
				}else{
					$idUsuario = intval($_SESSION['idUser']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = strClean($_POST['txtNombre']);
					$strApellido = strClean($_POST['txtApellido']);
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strPassword = "";
					if (!empty($_POST['txtPassword'])) {
						$strPassword = hash("SHA256",$_POST['txtPassword']);
					}

					$request_user = $this->model->updatePerfil($idUsuario,
																	$strIdentificacion, 
																	$strNombre,
																	$strApellido, 
																	$intTelefono, 
																	$strPassword);
					
					if ($request_user) {
						//funcion helper
						sessionUser($_SESSION['idUser']);
						$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

					}else{
						$arrResponse = array('status' => false, 'msg' => 'No es posible actualizar los datos.');
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function putDFiscal(){
			if ($_POST) {
				if (empty($_POST['txtNit']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDirFiscal'])) {
					$arrResponse = array('status' => false, 'msg' => 'Error de datos.');
				}else{
					$idUsuario = $_SESSION['idUser'];
					$strNit = strClean($_POST['txtNit']);
					$strNombreFiscal = strClean($_POST['txtNombreFiscal']);
					$strDirFiscal = strClean($_POST['txtDirFiscal']);
					$request_dataFiscal = $this->model->updateDataFiscal($idUsuario,$strNit,$strNombreFiscal,$strDirFiscal);

					if ($request_dataFiscal) {
						//funcion helper
						sessionUser($_SESSION['idUser']);//para actualizar los datos de sesion
						$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'No es posible actualizar los datos.');
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>