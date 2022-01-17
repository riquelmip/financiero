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

		public function creditosIncobrables()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 11;
			$data['page_tag'] = "Créditos Incobrables";
			$data['page_name'] = "creditosincobrables";
			$data['page_title'] = "Créditos Incobrables";
			$data['page_functions_js'] = "functions_creditosincobrables.js";
			$this->views->getView($this,"creditosincobrables",$data);
		}

		//Obtener total de CLientes...
		public function getCreditos(){

			if ($_SESSION['permisosMod']['leer']) {

				$arrData = $this->model->selectCreditos();

				for ($i=0; $i < count($arrData); $i++) {
					$btnEdit = "";
					$btnView = "";					
			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['escribir']) {
						$btnEdit = '<button class="btn btn-warning btn-sm btnVerTablaPagos" onClick="fntPagosCredito('.$arrData[$i]['iddetalle'].')" title="Pagos"><i class="fas fa-donate"></i></button>';
					}

					if ($_SESSION['permisosMod']['leer']) {
						$btnView = '<button class="btn btn-info btn-sm btnVerTablaPagos" onClick="fntVerPagos('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-money-check-alt"></i></button>';
						$btnView2 = '<button class="btn btn-info btn-sm btnVerTablaPagos" onClick="verNotaCredito('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-money-check-alt"></i></button>';
					}

					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.' '.$btnView.' '.$btnView2.'</div>';

				
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCreditosIncobrables(){ //Embargos

			if ($_SESSION['permisosMod']['leer']) {
				$comillas = "'";
				$arrData = $this->model->selectCreditosIncobrables();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";					
					$dato = $arrData[$i]['dui'];
					$valor = $arrData[$i]['iddetalle'];
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['leer']) {
						$btnView = '<button class="btn btn-info btn-sm btnVerTablaPagos" onClick="fntVerPagosPendientes('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-money-check-alt"></i></button>';
						
					}

					$arrData2 = $this->model->datoembargodetalle($arrData[$i]['iddetalle']);
					$valorembargo = $arrData2[$i]['estado_embargo'];
					if ($arrData2[$i]['estado_embargo'] == 0) {
						$btnEmbargo = '<button class="btn btn-danger btn-sm btnVerTablaPagos" onClick="fntEmbargo('.$comillas.$dato.$comillas.','.$valor.','.$valorembargo.')" title="Embargar"><i class="far fa-eye"></i></button>';
						$arrData[$i]['embargo'] = '<span class="badge badge-success">No Embargado</span>';
					} else {
						$btnEmbargo = '<button class="btn btn-success btn-sm btnVerTablaPagos" onClick="fntEmbargo('.$comillas.$dato.$comillas.','.$valor.','.$valorembargo.')" title="Entregar"><i class="far fa-eye"></i></button>';
						$arrData[$i]['embargo'] = '<span class="badge badge-danger">Embargado</span>';
					}
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' '.$btnEmbargo.'</div>';
				

				
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCreditosDosIncobrables(){
			$comillas = "'";
			if ($_SESSION['permisosMod']['leer']) {

				$arrData = $this->model->selectCreditosDos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";	
					$dato = $arrData[$i]['dui'];	
					$valor = $arrData[$i]['iddetalle'];			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['leer']) {
						$btnView = '<button class="btn btn-info btn-sm btnVerTablaPagos" onClick="fntVerPagosPendientes('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-money-check-alt"></i></button>';
						
						
					}
					$arrData2 = $this->model->datoembargodetalle($arrData[$i]['iddetalle']);
					$valorembargo = $arrData2[$i]['estado_embargo'];
					if ($arrData2[$i]['estado_embargo'] == 0) {
						$btnEmbargo = '<button class="btn btn-danger btn-sm btnVerTablaPagos" onClick="fntEmbargo('.$comillas.$dato.$comillas.','.$valor.','.$valorembargo.')" title="Embargar"><i class="far fa-eye"></i></button>';
						$arrData[$i]['embargo'] = '<span class="badge badge-success">No Embargado</span>';
					} else {
						$btnEmbargo = '<button class="btn btn-success btn-sm btnVerTablaPagos" onClick="fntEmbargo('.$comillas.$dato.$comillas.','.$valor.','.$valorembargo.')" title="Entregar"><i class="far fa-eye"></i></button>';
						$arrData[$i]['embargo'] = '<span class="badge badge-danger">Embargado</span>';
					}
					
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' '.$btnEmbargo.'</div>';
					

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
					$btnView = "";
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['escribir']) {
						$btnEdit = '<button class="btn btn-warning btn-sm btnVerTablaPagos" onClick="fntPagosCredito('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-donate"></i></button>';
					}

					if ($_SESSION['permisosMod']['leer']) {
						$btnView = '<button class="btn btn-info btn-sm btnVerTablaPagos" onClick="fntVerPagos('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-money-check-alt"></i></button>';
					}

					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.' '.$btnView.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getPagos(){ //Para factura

			if ($_SESSION['permisosMod']['leer']) {

				$iddetalle = strClean($_POST['iddetalle']);
				$estado = strClean($_POST['estado']);

				$arrData = $this->model->selectPagos(intval($iddetalle),intval($estado));

				$htmlDatosTabla = "";
				if(empty($arrData)){
				   $arrayDatos = array('estado' => false, 'msg' => 'Datos no encontrados.');
				}else{
					for ($i = 0; $i < count($arrData); $i++) {
							$htmlDatosTabla .= '<tr>
												<td>' . $arrData[$i]['mes'] . '</td>
												<td>' . $arrData[$i]['fecha'] . '</td>
												<td>' . $arrData[$i]['fechapago']. '</td>
												<td>$ ' . $arrData[$i]['cuota'] . '</td>
											    <td>$ ' . $arrData[$i]['capital'] . '</td>
												<td>$ ' . $arrData[$i]['intereses'] . '</td>
												<td>$ ' . $arrData[$i]['mora'] . '</td>
												<td>$ ' . $arrData[$i]['abonocapital'] . '</td>
												<td>$ ' . $arrData[$i]['totalabono'] . '</td>
												<td>$ ' . $arrData[$i]['saldofinal'] . '</td>
											 </tr>';
					}

					$arrayDatos = array('datosIndividuales' => $arrData, 'htmlDatosTabla' => $htmlDatosTabla);

					echo json_encode($arrayDatos, JSON_UNESCAPED_UNICODE);

				}
			}
			die();
		}

		public function getCreditoPagar(){

			if ($_SESSION['permisosMod']['leer']) {

				$iddetalle = strClean($_POST['iddetalle']);
				$mes = strClean($_POST['mes']);
				$arrData = $this->model->selectCreditoPagar(intval($iddetalle),intval($mes));
				$arrData1 = $this->model->selectCredito(intval(strClean($iddetalle)));
				if(count($arrData1) > 1){
					$arrData[0]['cuotaspendientes']=1;					
				}else{
					$arrData[0]['cuotaspendientes']=0;
				}

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
				
				if($totalRegistros > $i){
					if ($_SESSION['permisosMod']['escribir']) {
					$btnPago = '<button class="btn btn-success btn-sm btnVerTablaPagos" onClick="fntPagoCuota('.$arrData[$i]['iddetalle'].','.$arrData[$i]['mesPago'].')" title="Pagar"><i class="fas fa-dollar-sign"></i></button>';
					}else{
						$btnPago = '<button class="btn btn-secondary btn-sm btnPagoCuota" disabled title="Cuotas"><i class=" fas fa-dollar-sign"></i></button>';
					}
					$arrData[$i]['opciones'] = '<div class="text-center">' . $btnPago . '</div>';
				$arrData[$i]['dia'] = $diaPago.'-'.$mesInicio.'-'.$anio;

				$htmlDatosTabla .= '<tr>
						<td>' . round($arrData[$i]['cuota'],2) . '</td>
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
			    $totalabono = $intereses + $capital;
			    $saldof = round(($saldofinal-$capital),2);
			    $saldofin = round(($saldof-$abonoCapital),2);

			    	$mesProximo = date("m", strtotime($fecha))+1;
				 	$diaProximo = date("d", strtotime($fecha));
				 	$anioProximo = date("Y", strtotime($fecha));
				 	$fechaProxima = $anioProximo.'-'.$mesProximo.'-'.$diaProximo;
		

			if($saldof<=0 || $saldofin<=0){
			 	$request_estado = $this->model->updateEstadoCredito(intval(strClean($iddetalle)));

			 	$request_estado_pago = $this->model->updateEstadoPago(strClean($fecha),strClean($fechapago),intval(strClean($iddetalle)),intval(strClean($mes)));

			 	$request_estado_pago = $this->model->insertPagoCuota($iddetalle,($mes+1),$fecha,$fechapago,$cuota,$capital,$intereses,0,$totalabono,$saldof,1,0);

			}else{

				if($abonoCapital == 0){
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
					//Crear
						if($cuotaspendientes > 1){
							$request_estado_pago = $this->model->updateEstadoPago(strClean($fecha),strClean($fechapago),intval(strClean($iddetalle)),intval(strClean($mes)));
						}else{
							
							$request_estado_pago = $this->model->updateEstadoPago(strClean($fecha),strClean($fechapago),intval(strClean($iddetalle)),intval(strClean($mes)));


							$request_estado_pago = $this->model->insertPagoCuota($iddetalle,($mes+1),$fechaProxima,'0000-00-00',$cuota,$capital,$intereses,0,$totalabono,$saldof,0,0);
						}
					
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['escribir']) {

				 	$request_estado_pago = $this->model->updateEstadoPago(strClean($fecha),strClean($fechapago),intval(strClean($iddetalle)),intval(strClean($mes)));

				 	$request_estado_pago = $this->model->insertPagoCuota($iddetalle,$mes,$fecha,$fechapago,$cuota,$abonoCapital,0,$abonoCapital,$abonoCapital,$saldofin,1,0);

				 	$request_estado_pago = $this->model->insertPagoCuota($iddetalle,($mes+1),$fechaProxima,'0000-00-00',$cuota,$capital,$intereses,0,$totalabono,$saldof,0,0);

				 

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