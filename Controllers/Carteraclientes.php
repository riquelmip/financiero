<?php 

	class Carteraclientes extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); 
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(8); 
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
			$this->views->getView($this,"carteraclientes",$data);
		}

		public function getUsuario($idpersona){
			if ($_SESSION['permisosMod']['leer']) {


					$arrData = $this->model->selectUsuarioNatural($idpersona);
					if(empty($arrData))
					{
						$arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('estado' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			}
			die();
		}	

		public function getUsuario2($idpersona){
			if ($_SESSION['permisosMod']['leer']) {
		

					$arrData = $this->model->selectUsuarioJuridico($idpersona);
					if(empty($arrData))
					{
						$arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('estado' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			}
			die();
		}	


		public function getPruebas($idpersona){
			if ($_SESSION['permisosMod']['leer']) {
				$idusuario = $idpersona;

					$arrData = $this->model->selectUsuarioJuridico($idusuario);
						
							$ventas_netas = $arrData['ventas_netas'];
							$activos_corrientes = $arrData['activos_corrientes'];
							$inventarios = $arrData['inventarios'];
							$costos_de_ventas = $arrData['costos_de_ventas'];
							$pasivos_corrientes = $arrData['pasivos_corrientes'];
							$cuentas_cobrar = $arrData['cuentas_cobrar'];

							$Razon_circulante = $activos_corrientes/$pasivos_corrientes;
							$Prueba_acida = ($activos_corrientes-$inventarios)/$pasivos_corrientes;
							$Razoncuentaxcobrar = $ventas_netas / $cuentas_cobrar;
							$Razoncuentaxcobrardias = 360 / $Razoncuentaxcobrar ;
							$Rotacion_inventarios = $costos_de_ventas / $inventarios;
							$Rotacion_inventariosdias = 360 / $Rotacion_inventarios;
							$signo = "$";
							$arrData['ventas_netas'] = $signo . (round($Razon_circulante * 100) /100);
							$arrData['activos_corrientes'] = $signo .  (round($Prueba_acida * 100) /100);
							$arrData['inventarios'] = $signo . (round($Razoncuentaxcobrar * 100) /100);
							$arrData['costos_de_ventas'] = $signo .  (round($Razoncuentaxcobrardias * 100) /100);
							$arrData['pasivos_corrientes'] = $signo .  (round($Rotacion_inventarios * 100) /100);
							$arrData['cuentas_cobrar'] = $signo .  (round($Rotacion_inventariosdias * 100) /100);

						$arrResponse = array('estado' => true, 'data' => $arrData);
				
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
		}

		public function personanaturalA()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$comillas = "'";
				$arrData = $this->model->selectPersonaNaturalA();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
				 $dato = $arrData[$i]['codigo_persona_natural'];
				  
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$comillas.$dato.$comillas.')" title="Ver Datos del Cliente"><i class="far fa-eye"></i></button>';
					$btnEmbargo = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntFiador('.$comillas.$dato.$comillas.')" title="Agregar Fiador"><i class="fas fa-edit"></i></button>';

					

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEmbargo.'</div>';
					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_natural'].'</td>
										<td>'.$arrData[$i]['dui_persona_natural'].'</td>
			                            <td>'.$arrData[$i]['nombre_completo'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function personanaturalB()
		{
			$comillas = "'";
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalB();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_natural'];
					 
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$comillas.$dato.$comillas.')" title="Ver Datos del Cliente"><i class="far fa-eye"></i></button>';
					   $btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$comillas.$dato.$comillas.')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					   $btnEmbargo = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntFiador('.$comillas.$dato.$comillas.')" title="Agregar Fiador"><i class="fas fa-edit"></i></button>';   

					

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEmbargo.'</div>';
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_natural'].'</td>
										<td>'.$arrData[$i]['dui_persona_natural'].'</td>
			                            <td>'.$arrData[$i]['nombre_completo'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function personanaturalC()
		{
			$comillas = "'";
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalC();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
				 $dato = $arrData[$i]['codigo_persona_natural'];
				  
				 $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$comillas.$dato.$comillas.')" title="Ver Datos del Cliente"><i class="far fa-eye"></i></button>';
					$btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$comillas.$dato.$comillas.')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					$btnEmbargo = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntFiador('.$comillas.$dato.$comillas.')" title="Agregar Fiador"><i class="fas fa-edit"></i></button>';	

					

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEmbargo.'</div>';
					
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_natural'].'</td>
										<td>'.$arrData[$i]['dui_persona_natural'].'</td>
			                            <td>'.$arrData[$i]['nombre_completo'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function personanaturalD()
		{
			$comillas = "'";
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalD();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
				 $dato = $arrData[$i]['codigo_persona_natural'];
				  
				 $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$comillas.$dato.$comillas.')" title="Ver Datos del Cliente"><i class="far fa-eye"></i></button>';
				 $btnEmbargo = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntFiador('.$comillas.$dato.$comillas.')" title="Agregar Fiador"><i class="fas fa-edit"></i></button>';	

				

				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.'  '.$btnEmbargo.'</div>';
					
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_natural'].'</td>
										<td>'.$arrData[$i]['dui_persona_natural'].'</td>
			                            <td>'.$arrData[$i]['nombre_completo'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}






		public function PersonaJuridicaA()
		{
			$comillas = "'";
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaA();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_juridica'];
					 
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario2('.$comillas.$dato.$comillas.')" title="Ver Datos del Cliente"><i class="far fa-eye"></i></button>';
					$btnFiador = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntFiador('.$comillas.$dato.$comillas.')" title="Agregar Fiador"><i class="fas fa-edit"></i></button>';
					
					   $btnRazon = '<button class="btn btn-success btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$comillas.$dato.$comillas.')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					  

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnRazon.' '.$btnFiador.'</div>';

					
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_juridica'].'</td>
										<td>'.$arrData[$i]['nombre_empresa_persona_juridica'].'</td>>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function PersonaJuridicaB()
		{
			$comillas = "'";
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaB();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_juridica'];
					 
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario2('.$comillas.$dato.$comillas.')" title="Ver Datos del Cliente"><i class="far fa-eye"></i></button>';
					   $btnRazon = '<button class="btn btn-success btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$comillas.$dato.$comillas.')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					   $btnEmbargo = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntFiador('.$comillas.$dato.$comillas.')" title="Agregar Fiador"><i class="fas fa-edit"></i></button>';   

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnRazon.' '.$btnEmbargo.'</div>';
					
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_juridica'].'</td>
										<td>'.$arrData[$i]['nombre_empresa_persona_juridica'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setFiador(){ //Hace la insercion y edita
			
			$codigo =  $_POST['id_fiador'];
			$nombrefiador =  $_POST['nombre_fiador'];
			$direccionfiador =  $_POST['direccion_fiador'];
			$duifiador =  $_POST['dui_fiador'];
			$telefonofiador =  $_POST['telefono_fiador'];
			if(isset($_FILES['boletapagofiador']) && $_FILES['boletapagofiador']['type']=='application/pdf'){
				$userfile_extn = explode(".", strtolower($_FILES['boletapagofiador']['name']));
				move_uploaded_file ($_FILES['boletapagofiador']['tmp_name'] , $_SERVER['DOCUMENT_ROOT'] .'/financiero/Assets/images/pdf/'. strClean($duifiador) . '.' . $userfile_extn[1]);
			}
			$variable = strClean($duifiador) . '.' . $userfile_extn[1];
				$option = 1;
			

				$request_cat = $this->model->insertarfiador($nombrefiador,$direccionfiador,$duifiador,$telefonofiador,$variable,$codigo);

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




		public function setEmbargo(){ //Hace la insercion y edita
			
			$intId = 1;
			$strCat =  $_POST['codigo2'];
			$strCat2 =  $_POST['codigo22'];
			$strCat3 =  $_POST['codigo23'];
			if(isset($_FILES['documento12']) && $_FILES['documento12']['type']=='application/pdf'){
				$userfile_extn = explode(".", strtolower($_FILES['documento12']['name']));
				move_uploaded_file ($_FILES['documento12']['tmp_name'] , $_SERVER['DOCUMENT_ROOT'] .'/financiero/Assets/images/pdf/'. strClean($strCat) . '.' . $userfile_extn[1]);
			}
			$variable = strClean($strCat) . '.' . $userfile_extn[1];
				$option = 1;
			

				$request_cat = $this->model->insertCargo($strCat,$variable,$strCat2,$strCat3);

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

		public function PersonaJuridicaC()
		{
			$comillas = "'";
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaC();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_juridica'];
					 
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario2('.$comillas.$dato.$comillas.')" title="Ver Datos del Cliente"><i class="far fa-eye"></i></button>';
					$btnEmbargo = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntFiador('.$comillas.$dato.$comillas.')" title="Agregar Fiador"><i class="fas fa-edit"></i></button>';
					   $btnRazon = '<button class="btn btn-success btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$comillas.$dato.$comillas.')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnRazon.' '.$btnEmbargo.'</div>';
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_juridica'].'</td>
										<td>'.$arrData[$i]['nombre_empresa_persona_juridica'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function PersonaJuridicaD()
		{
			$comillas = "'";
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaD();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_juridica'];
					 
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario2('.$comillas.$dato.$comillas.')" title="Ver Datos del Cliente"><i class="far fa-eye"></i></button>';
					$btnEmbargo = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntFiador('.$comillas.$dato.$comillas.')" title="Agregar Fiador"><i class="fas fa-edit"></i></button>';
					   $btnRazon = '<button class="btn btn-success btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$comillas.$dato.$comillas.')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnRazon.' '.$btnEmbargo.'</div>';
					
				

					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigo_persona_juridica'].'</td>
										<td>'.$arrData[$i]['nombre_empresa_persona_juridica'].'</td>
										<td>'.$arrData[$i]['categoria'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}




				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function marcarincobrablePN()
		
		{
			if($_POST){
				if ($_SESSION['permisosMod']['eliminar']) {

					//$json=json_encode($_POST['idEmpleado']);
					$todo = strClean( $_POST['idEmpleado']);

					$porciones = explode(",", $todo);
					$idempleado = $porciones[0];
					$estado = intval($porciones[1]);
					$requestDelete = $this->model->deleteEmpleado($idempleado,$estado);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('estado' => true, 'msg' => 'Dado de Baja');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => 'No puede dar de baja al Empleado');
					}else{
						$arrResponse = array('estado' => false, 'msg' => 'Error al cambiar el estado el Empleado.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}



	}
