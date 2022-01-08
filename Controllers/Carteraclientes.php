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
			$this->views->getView($this,"carteraclientesnatural",$data);
		}

	

		public function personanaturalA()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalA();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_natural'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
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

		public function personanaturalB()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalB();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_natural'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
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

		public function personanaturalC()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalC();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_natural'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
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

		public function personanaturalD()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaNaturalD();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_natural'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
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






		public function PersonaJuridicaA()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaA();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_juridica'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
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

		public function PersonaJuridicaB()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaB();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_juridica'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
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

		public function PersonaJuridicaC()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaC();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_juridica'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
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

		public function PersonaJuridicaD()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectPersonaJuridicaD();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
					$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['codigo_persona_juridica'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
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


	}

    

 ?>