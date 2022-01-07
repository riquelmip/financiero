<?php 

	class Carteraclientes extends Controllers{
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

		public function Carteraclientes()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 11;
			$data['page_tag'] = "Cartera de Clientes";
			$data['page_name'] = "Cartera de Clientes";
			$data['page_title'] = "Cartera de Clientes";
			$data['page_functions_js'] = "functions_carteraclientes.js";
			$this->views->getView($this,"carteraclientesnatural",$data);
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
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditCliente" onClick="fntEditCliente('.$arrData[$i]['codigo_cliente_natural'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelCliente" onClick="fntDelCliente('.$arrData[$i]['codigo_cliente_natural'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.' ' .$btnDelete.'</div>';

				
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getProductos()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalA();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_natural'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
				
			
				//agregamos los botones
				$arrData[$i]['options'] = '<div class="text-center">'.$btnAdd.'</div>';
					
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_natural'].'</td>
										<td>'.$arrData[$i]['dui_persona_natural'].'</td>
			                            <td>'.$arrData[$i]['nombre_completo'].'</td>
										<td>'.$arrData[$i]['direccion_persona_natural'].'</td>
										<td>'.$arrData[$i]['telefono_persona_natural'].'</td>
										<td>'.$arrData[$i]['estado_civil_persona_natural'].'</td>
										<td>'.$arrData[$i]['lugar_trabajo_persona_natural'].'</td>
										<td>'.$arrData[$i]['ingreso_persona_natural'].'</td>
										<td>'.$arrData[$i]['egresos_persona_natural'].'</td>
										<td>'.$arrData[$i]['id_boleta_de_pago__persona_natural'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getProductos2()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaA();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_juridica'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
				
			
				//agregamos los botones
				$arrData[$i]['options'] = '<div class="text-center">'.$btnAdd.'</div>';
					
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_juridica'].'</td>
										<td>'.$arrData[$i]['nombre_empresa_persona_juridica'].'</td>
			                            <td>'.$arrData[$i]['direccion_persona_juridica'].'</td>
										<td>'.$arrData[$i]['idtelefono_persona_juridica'].'</td>
										<td>'.$arrData[$i]['idbalancegeneral_persona_juridica'].'</td>
										<td>'.$arrData[$i]['idestadoresultado_persona_juridica'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		//Obtener un registro Cliente
		public function getCliente(int $codigo_cliente_natural)
		{
			if ($_SESSION['permisosMod']['leer']) {
				$intcodigo_cliente_natural = intval(strClean($codigo_cliente_natural));
				if($intcodigo_cliente_natural > 0){

					$arrData = $this->model->selectCliente($intcodigo_cliente_natural);
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
			
			$intcodigo_cliente_natural = intval($_POST['codigo_cliente_natural']);
			$strDui =  strClean($_POST['txtDui']);
			$strNombre =  strClean($_POST['txtNombre']);
			$strApellido =  strClean($_POST['txtApellido']);
			$strTelefono =  strClean($_POST['txtTelefono']);
           	$intEstado = intval($_POST['intEstado']);

			if($intcodigo_cliente_natural == 0){
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
					//Crear
					$request_cliente = $this->model->insertCliente($strDui,$strNombre,$strApellido,$strTelefono,$intEstado);
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				 $request_cliente= $this->model->updateCliente($intcodigo_cliente_natural,$strDui,$strNombre,$strApellido,$strTelefono,$intEstado);
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
					$intcodigo_cliente_natural = intval($_POST['codigo_cliente_natural']);
					$requestDelete = $this->model->deleteCliente($intcodigo_cliente_natural);
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