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
				$idusuario = $idpersona;
				if($idusuario > 0)
				{
					$arrData = $this->model->selectUsuarioNatural($idusuario);
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

		public function getUsuario2($idpersona){
			if ($_SESSION['permisosMod']['leer']) {
				$idusuario = $idpersona;
				if($idusuario > 0)
				{
					$arrData = $this->model->selectUsuarioJuridico($idusuario);
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

		public function personanaturalA()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalA();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
				 $dato = $arrData[$i]['codigo_persona_natural'];
				 $datoint = explode('-',$dato);
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$datoint[1].')" title="Ver Datos Cliente"><i class="far fa-eye"></i></button>';
					$btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$datoint[1].')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
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
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalB();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_natural'];
					$datoint = explode('-',$dato);
					   $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$datoint[1].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
					   $btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$datoint[1].')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					   $arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
					
				

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
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalC();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
				 $dato = $arrData[$i]['codigo_persona_natural'];
				 $datoint = explode('-',$dato);
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$datoint[1].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
					$btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$datoint[1].')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
					
				

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
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalD();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
				 $dato = $arrData[$i]['codigo_persona_natural'];
				 $datoint = explode('-',$dato);
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$datoint[1].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
					
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
					
				

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
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaA();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_juridica'];
					$datoint = explode('-',$dato);
					   $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario2('.$datoint[1].')" title="Ver usuario"><i class="far fa-eye"></i></button>';	
					
					   $btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$datoint[1].')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					   $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnRazon.'</div>';
					
				

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
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaB();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_juridica'];
					$datoint = explode('-',$dato);
					   $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario2('.$datoint[1].')" title="Ver usuario"><i class="far fa-eye"></i></button>';	
					   $btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$datoint[1].')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					   $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnRazon.'</div>';
					
				

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

		public function PersonaJuridicaC()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaC();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_juridica'];
					$datoint = explode('-',$dato);
					   $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario2('.$datoint[1].')" title="Ver usuario"><i class="far fa-eye"></i></button>';	
					
					   $btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$datoint[1].')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					   $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnRazon.'</div>';
					
				

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
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaD();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$dato = $arrData[$i]['codigo_persona_juridica'];
					$datoint = explode('-',$dato);
					   $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario2('.$datoint[1].')" title="Ver usuario"><i class="far fa-eye"></i></button>';	
					
					   $btnRazon = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntRazonFinanciera('.$datoint[1].')" title="Ver Razones"><i class="fas fa-highlighter"></i></button>';
					   $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnRazon.'</div>';
					
				

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


	}

    

 ?>