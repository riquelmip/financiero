<?php 

	class Proveedor extends Controllers{

		//CONSTRUCTOR
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(10); 
		}

		//Utilizamos en la vista

		public function Proveedor()
		{

			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Proveedores";
			$data['page_name'] = "proveesores";
			$data['page_title'] = "Proveedores";
			$data['page_functions_js'] = "functions_proveedor.js";
			$this->views->getView($this,"Proveedor",$data);
		}

		//Para acceder a los Moddelos


		public function getproveedores()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectproveedor();

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
					
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditproveedor" onClick="fntEditproveedor('.$arrData[$i]['idproveedor'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelproveedor" onClick="fntDelproveedor('.$arrData[$i]['idproveedor'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getproveedor(int $idproveedor)
		{
			if ($_SESSION['permisosMod']['leer']) {
				$intIdproveedor = intval(strClean($idproveedor));
				if($intIdproveedor > 0)
				{
					$arrData = $this->model->selectproveedorid($intIdproveedor);
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

		public function setproveedor(){
			
			$intIdproveedor = intval($_POST['idProveedor']);
			$strproveedor =  strClean($_POST['txtNombre']);
			$strDescripcion = strClean($_POST['txtDescripcion']);
			$intestado = intval($_POST['listaEstado']);
			$telefono = strClean($_POST['txtNumero']);
			$contacto = strClean($_POST['txtContacto']);

			if($intIdproveedor == 0)
			{
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_proveedor = $this->model->insertproveedor($strproveedor, $strDescripcion,$intestado,$telefono,$contacto);
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				$request_proveedor = $this->model->updateproveedor($intIdproveedor, $strproveedor, $strDescripcion, $intestado,$telefono,$contacto);
				}
			}

			if($request_proveedor > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_proveedor == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! El proveedor ya existe.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function delproveedor()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['eliminar']) {
					$intIdproveedor = intval($_POST['idproveedor']);
					$requestDelete = $this->model->deleteproveedor($intIdproveedor);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('estado' => true, 'msg' => 'El proveedor ha sido dado de baja');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => 'Aún existen registros de compras asociados a este proveedor');
					}else{
						$arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el proveedor.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

	}
 ?>