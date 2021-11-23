<?php 

	class Cliente extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(8); //tiene parametro 2 porque es el de usuario, osea que lo estamos poniendo junto, ya que si tiene acceso a usuario tiene a roles
		}

		public function Cliente()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 11;
			$data['page_tag'] = "Cliente";
			$data['page_name'] = "cliente";
			$data['page_title'] = "Cliente <small> Ferretería</small>";
			$data['page_functions_js'] = "functions_cliente.js";
			$this->views->getView($this,"cliente",$data);
		}

		//Obtener total de CLientes...
		public function getClientes(){

			if ($_SESSION['permisosMod']['leer']) {

				$arrData = $this->model->selectClientes();

				for ($i=0; $i < count($arrData); $i++) {
					$btnEdit = "";
					$btnDelete = "";

                    /*if($arrData[$i]['estado'] == 1){

                        $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                    }else{
                        $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                    } */
					
			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['actualizar']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditCliente" onClick="fntEditCliente('.$arrData[$i]['idcliente'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelCliente" onClick="fntDelCliente('.$arrData[$i]['idcliente'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.' ' .$btnDelete.'</div>';

				
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		//Obtener un registro Cliente
		public function getCliente(int $idcliente)
		{
			if ($_SESSION['permisosMod']['leer']) {
				$intIdcliente = intval(strClean($idcliente));
				if($intIdcliente > 0){

					$arrData = $this->model->selectCliente($intIdcliente);
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

		public function setCliente(){
			
			$intIdcliente = intval($_POST['idcliente']);
			$strDui =  strClean($_POST['txtDui']);
			$strNombre =  strClean($_POST['txtNombre']);
			$strApellido =  strClean($_POST['txtApellido']);
			$strTelefono =  strClean($_POST['txtTelefono']);
           	$intEstado = intval($_POST['intEstado']);

			if($intIdcliente == 0){
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
					//Crear
					$request_cliente = $this->model->insertCliente($strDui,$strNombre,$strApellido,$strTelefono,$intEstado);
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				 $request_cliente= $this->model->updateCliente($intIdcliente,$strDui,$strNombre,$strApellido,$strTelefono,$intEstado);
				}
			}

			if($request_cliente > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_cliente == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! ya existe Un registro con esos datos.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function delCliente(){
			if($_POST){
				if ($_SESSION['permisosMod']['eliminar']) {
					$intIdcliente = intval($_POST['idcliente']);
					$requestDelete = $this->model->deleteCliente($intIdcliente);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('estado' => true, 'msg' => 'Se ha eliminado el Registro Cliente');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => 'No es posible eliminar un Cliente asociado a una Venta');
					}else{
						$arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el Registro Cliente');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
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