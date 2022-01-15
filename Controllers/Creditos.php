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
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnEdit = "";					
			
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['escribir']) {
						$btnEdit = '<button class="btn btn-warning btn-sm btnVerTablaPagos" onClick="fntPagosCredito('.$arrData[$i]['iddetalle'].')" title="Ver"><i class="fas fa-donate"></i></button>';
					}

					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnEdit.'</div>';

					$htmlDatosTabla .= '<tr>
						<td>' . $arrData[$i]['dui'] . '</td>
						<td>' . $arrData[$i]['nombreCliente'] . '</td>
						<td>' . $arrData[$i]['descripcion'] . '</td>
						<td>' . $arrData[$i]['fecha_inicio'] . '</td>
						<td>' . $arrData[$i]['total'] . '</td>
						<td>' . $arrData[$i]['opciones'] . '</td>
						</tr>';

				
				}

				$arrResponse = array('datosIndividuales' => $arrData, 'htmlDatosTabla' => $htmlDatosTabla);

				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCreditoPagar(){

			if ($_SESSION['permisosMod']['leer']) {

				$iddetalle = $_POST['iddetalle'];
				$arrData = $this->model->selectCredito(intval(strClean($iddetalle)));

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

			$mes = $arrData['mesPago'];
			$anio = $arrData['anio'];
			$diaPago=$arrData['dia'];
			$id=$arrData['iddetalle'];
			$cantcuotas = $arrData['meses'] - $mes;
			if($mes==1){
				$mesInicio = $arrData['mesinicio'];
			}else{
				$mesInicio = $arrData['mesinicio'] + ($mes-1);
			}


			if($arrData['saldofinal'] < $arrData['cuota']){
				$arrData['cuota'] = $arrData['saldofinal'] + ($arrData['saldofinal'] * (($arrData['tasa']/100)/12));
			}else{
				$arrData['cuota'] = $arrData['cuota'];
			}

			for ($i = 0; $i <= $cantcuotas; $i++) {
				
				$btnPago = "";
				//si tiene permiso de editar se agrega el botn
				if ($_SESSION['permisosMod']['escribir']) {
				if($i==0){

					$btnPago = '<button class="btn btn-success btn-sm btnVerTablaPagos" onClick="fntPagoCuota('.$arrData['iddetalle'].')" title="Pagar"><i class="fas fa-dollar-sign"></i></button>';

					//onClick="gotoNode(\'' + result.name + '\')"
				}else{
					$btnPago = '<button class="btn btn-secondary btn-sm btnPagoCuota" disabled title="Cuotas"><i class=" fas fa-dollar-sign"></i></button>';
				}
				}
				//agregamos los botones
				$arrData[$i]['opciones'] = '<div class="text-center">' . $btnPago . '</div>';
				$arrData['dia'] = $diaPago.'-'.$mesInicio.'-'.$anio;

				$htmlDatosTabla .= '<tr>
						<td>' . $arrData['cuota'] . '</td>
						<td>' . $arrData['dia'] . '</td>
						<td>' . $arrData['totalCredito'] . '</td>
						<td>' . $arrData[$i]['opciones'] . '</td>
						</tr>';
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
           	
           		$intereses = round(($saldofinal * (($tasa/100)/12)),2);
			    $capital = round(($cuota - $intereses),2);
			    $totalabono = round(($intereses + $capital),2);
			    $saldof = round(($saldofinal-$capital),2);
			    $saldofin = round(($saldof-$abonoCapital),2);

			if($saldof<=0 || $saldofin<=0){
			 	$request_estado = $this->model->updateEstadoCredito(intval(strClean($iddetalle)));
			}   

			if($abonoCapital == 0){
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
					//Crear
$request_pago = $this->model->insertPagoCuota($iddetalle,$mes,$fecha,$fechapago,$cuota,$capital,$intereses,0,$totalabono,$saldof);

				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['escribir']) {

				$request_pago = $this->model->insertPagoCuota($iddetalle,$mes,$fecha,$fechapago,$cuota,$capital,$intereses,0,$totalabono,$saldof);

				 $request_pago = $this->model->insertPagoCuota($iddetalle,$mes,$fecha,$fechapago,$cuota,$abonoCapital,0,$abonoCapital,$abonoCapital,$saldofin);
				}
			}

			if($request_pago > 0 )
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