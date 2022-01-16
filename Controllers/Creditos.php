<?php 

	class Creditos extends Controllers{
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

		public function Creditos()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 11;
			$data['page_tag'] = "Ventas al crédito";
			$data['page_name'] = "credito";
			$data['page_title'] = "Ventas al crédito";
			$data['page_functions_js'] = "functions_creditos.js";
			$this->views->getView($this,"creditos",$data);
		}

		//Obtener total de CLientes...
		public function getCreditos(){

			if ($_SESSION['permisosMod']['leer']) {

				$arrData = $this->model->selectCreditos();

				for ($i=0; $i < count($arrData); $i++) {
					$btnEdit = "";					
			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['escribir']) {
						$btnEdit = '<button class="btn btn-warning btn-sm btnVerTablaPagos" onClick="fntPagosCredito('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-donate"></i></button>';
					}

					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.'</div>';

				
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCreditosDos(){

			if ($_SESSION['permisosMod']['leer']) {

				$arrData = $this->model->selectCreditosDos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnEdit = "";					
			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['escribir']) {
						$btnEdit = '<button class="btn btn-warning btn-sm btnVerTablaPagos" onClick="fntPagosCredito('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-donate"></i></button>';
					}

					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCreditoPagar(){

			if ($_SESSION['permisosMod']['leer']) {

				$iddetalle = strClean($_POST['iddetalle']);
				$mes = strClean($_POST['mes']);
				$arrData = $this->model->selectCreditoPagar(intval($iddetalle),intval($mes));

				if($arrData[0]['saldofinal'] < $arrData[0]['cuota']){
					$arrData[0]['cuota'] = $arrData[0]['saldofinal'] + ($arrData[0]['saldofinal'] * (($arrData[0]['tasa']/100)/12));
				}else{
					$arrData[0]['cuota'] = $arrData[0]['cuota'];
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		//Obtener un registro Cliente
 public function getCredito(){

  if ($_SESSION['permisosMod']['leer']) {

	$iddetalle = $_POST['iddetalle'];
	if($iddetalle > 0){

		$arrData = $this->model->selectCredito(intval(strClean($iddetalle)));
		$htmlDatosTabla = "";
		if(empty($arrData)){
		   $arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
		}else{

			$totalRegistros = count($arrData);
			$mes = $arrData[0]['mesPago'];
			$anio = $arrData[0]['anio'];
			$diaPago=$arrData[0]['dia'];
			$id=$arrData[0]['iddetalle'];
			$cantcuotas = $arrData[0]['meses'] - ($mes);

			if($mes==1){
				$mesInicio = $arrData[0]['mesinicio'];
			}else{
				$mesInicio = $arrData[0]['mesinicio'] + ($mes);
			}


			if($arrData[0]['saldofinal'] < $arrData[0]['cuota']){
				$arrData[0]['cuota'] = $arrData[0]['saldofinal'] + ($arrData[0]['saldofinal'] * (($arrData[0]['tasa']/100)/12));
			}else{
				$arrData[0]['cuota'] = $arrData[0]['cuota'];
			}

			$arrData[0]['totalCuotas'] = $totalRegistros;

			for ($i = 0; $i < $cantcuotas; $i++) {
				

				$btnPago = "";
				//si tiene permiso de editar se agrega el botn
				
				if($i < $totalRegistros){
					if ($_SESSION['permisosMod']['escribir']) {
					$btnPago = '<button class="btn btn-success btn-sm btnVerTablaPagos" onClick="fntPagoCuota('.$arrData[$i]['iddetalle'].','.$arrData[$i]['mesPago'].')" title="Pagar"><i class="fas fa-dollar-sign"></i></button>';
					}else{
						$btnPago = '<button class="btn btn-secondary btn-sm btnPagoCuota" disabled title="Cuotas"><i class=" fas fa-dollar-sign"></i></button>';
					}
					$arrData[$i]['opciones'] = '<div class="text-center">' . $btnPago . '</div>';
				$arrData[$i]['dia'] = $diaPago.'-'.$mesInicio.'-'.$anio;

				$htmlDatosTabla .= '<tr>
						<td>' . round($arrData[$i]['cuota']) . '</td>
						<td>' . $arrData[$i]['dia'] . '</td>
						<td>' . $arrData[$i]['totalCredito'] . '</td>
						<td>' . $arrData[$i]['opciones'] . '</td>
						</tr>';
					//onClick="gotoNode(\'' + result.name + '\')"
				}else{
					if($arrData[0]['saldofinal'] > $arrData[0]['cuota']){
							$btnPago = '<button class="btn btn-secondary btn-sm btnPagoCuota" disabled title="Cuotas"><i class=" fas fa-dollar-sign"></i></button>';

						$arrData[$i]['opciones'] = '<div class="text-center">' . $btnPago . '</div>';

						$arrData['dia'] = $diaPago.'-'.$mesInicio.'-'.$anio;
						$htmlDatosTabla .= '<tr>
							<td>' . $arrData[0]['cuota'] . '</td>
							<td>' . $arrData['dia'] . '</td>
							<td>' . $arrData[0]['totalCredito'] . '</td>
							<td>' . $arrData[$i]['opciones'] . '</td>
							</tr>';
					 }
					
					}
						if($mesInicio<12){
							$mesInicio=$mesInicio+1;
						}else{
							$mesInicio=$mesInicio-11;
							$anio=$anio+1;
						}

				
			}

			$arrResponse = array('datosIndividuales' => $arrData, 'htmlDatosTabla' => $htmlDatosTabla);
		}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	  }
	}
	die();
 }

		public function setPagoCredito(){


			
			$iddetalle = intval($_POST['iddetalle']);
			$mes = intval($_POST['mes']);
			$fecha =  strClean($_POST['fecha']);
			$cuota =  $_POST['cuota'];
			$saldofinal =  $_POST['saldofinal'];
			$tasa =  $_POST['tasa'];
           	$meses = intval($_POST['meses']);
           	$abonoCapital = $_POST['abonoCapital'];
           	$fechapago = date("Y-m-d");

	        $arrData = $this->model->selectCredito(intval(strClean($iddetalle)));
			$cuotaspendientes = count($arrData);
           	
           		$intereses = round(($saldofinal * (($tasa/100)/12)),2);
			    $capital = round(($cuota - $intereses),2);
			    $totalabono = round(($intereses + $capital),2);
			    $saldof = round(($saldofinal-$capital),2);
			    $saldofin = round(($saldof-$abonoCapital),2);
		

			if($saldof<=0 || $saldofin<=0){
			 	$request_estado = $this->model->updateEstadoCredito(intval(strClean($iddetalle)));

			 	$request_estado_pago = $this->model->updateEstadoPago(strClean($fecha),strClean($fechapago),intval(strClean($iddetalle)),intval(strClean($mes)));

			 	$request_estado_pago = $this->model->insertPagoCuota($iddetalle,($mes+1),$fecha,$fechapago,$cuota,$capital,$intereses,0,$totalabono,$saldof,1);

			}else{

				if($abonoCapital == 0){
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
					//Crear
						if($cuotaspendientes > 1){
							$request_estado_pago = $this->model->updateEstadoPago(strClean($fecha),strClean($fechapago),intval(strClean($iddetalle)),intval(strClean($mes)));
						}else{
							
							$request_estado_pago = $this->model->updateEstadoPago(strClean($fecha),strClean($fechapago),intval(strClean($iddetalle)),intval(strClean($mes)));

							$request_estado_pago = $this->model->insertPagoCuota($iddetalle,($mes+1),'0000-00-00','0000-00-00',$cuota,$capital,$intereses,0,$totalabono,$saldof,0);
						}
					
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['escribir']) {
				 
				 	$request_estado_pago = $this->model->updateEstadoPago(strClean($fecha),strClean($fechapago),intval(strClean($iddetalle)),intval(strClean($mes)));

				 	$request_estado_pago = $this->model->insertPagoCuota($iddetalle,$mes,$fecha,$fechapago,$cuota,$abonoCapital,0,$abonoCapital,$abonoCapital,$saldofin,1);
				 

				}
			}

			}   

			

			if($request_estado_pago > 0)
			{
				if($option == 1)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

	}
 ?>