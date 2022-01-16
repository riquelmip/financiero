<?php 

	class Nuevaventa extends Controllers {
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(13); //tiene parametro 2 porque es el de usuario, osea que lo estamos poniendo junto, ya que si tiene acceso a usuario tiene a roles
		}

		public function Nuevaventa()
		{

			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Nueva Venta";
			$data['page_name'] = "nuevaventa";
			$data['page_title'] = "Nueva Venta";
			$data['page_functions_js'] = "functions_nuevaventa.js";
			$this->views->getView($this,"nuevaventa",$data);
		}


		public function getSelectPersonaN() 
		{
			$html = "";
			$arrData = $this->model->selectPersonaN();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					
					$html .= '<option value="'.$arrData[$i]['codigo'].'">'.$arrData[$i]['nombre'].'</option>';
					
					
				}
			}


			$arrResponse = array('personan' => $html);
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();		
		}

		public function getSelectPersonaJ() 
		{
			$html = "";
			$arrData = $this->model->selectPersonaJ();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					
					$html .= '<option value="'.$arrData[$i]['codigo'].'">'.$arrData[$i]['nombre'].'</option>';
					
					
				}
			}


			$arrResponse = array('personaj' => $html);
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();		
		}


		public function setCliente(){
			
			$strDui =  strClean($_POST['txtDuiv']);
			$strNombre =  strClean($_POST['txtNombrev']);
			$strApellido =  strClean($_POST['txtApellidov']);
			$strTelefono =  strClean($_POST['txtTelefonov']);
           	$intEstado = intval($_POST['intEstadov']);


		
			
			if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_cliente = $this->model->insertCliente($strDui,$strNombre,$strApellido,$strTelefono,$intEstado);
			}
			
			if($request_cliente > 0 )
			{
				$html = "";
				$arrData = $this->model->selectClientes();
				if(count($arrData) > 0 ){
					for ($i=0; $i < count($arrData); $i++) { 
						if($arrData[$i]['estado'] == 1 ){
						$html .= '<option value="'.$arrData[$i]['idcliente'].'">'.$arrData[$i]['nombre']." ".$arrData[$i]['apellido'].'</option>';
						
						}
					}
				}


				$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.', 'id' => $request_cliente, 'clientes' => $html);
				
			}else if($request_cliente == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! ya existe Un registro con esos datos.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}


		public function getProducto($codigo){
			if($_SESSION['permisosMod']['leer']){
				$codigobarra = $codigo;
				if($codigobarra > 0){
					$arrData = $this->model->selectProducto($codigobarra);
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

		public function setVenta(){
			//dep($_POST);
			//die();

			if($_POST){

					
	                 
					$strArray = json_decode($_POST["listaDetalles"], true);//detalles
					$intCliente =  strClean($_POST['listCliente']);
					$tipocliente =  intval(strClean($_POST['tipocliente']));
					$subtotal =  strClean($_POST['inputsubtotal']);
					$iva =  strClean($_POST['inputiva']);
					$total =  strClean($_POST['inputtotal']);

					if ($tipocliente == 1) {
						$request = $this->model->insertarVentaN($total, 1, $intCliente, $_SESSION['userData']['idusuario'], $subtotal, $iva, $tipocliente);
					}else{
						$request = $this->model->insertarVentaJ($total, 1, $intCliente, $_SESSION['userData']['idusuario'], $subtotal, $iva, $tipocliente);
					}

					
					
					
						
					if($request > 0 )
					{
						foreach ($strArray as $key => $value) {

							

							$idventa = $request;
							$idproducto = $value["id"];
							$cantidad = intval($value["cantidad"]);
							$codigo = $value["codigobarra"];
							$total = floatval($value["preciototal"]);


							$formadepago = intval($value["tipoventa"]);
							$cuota = floatval($value["cuota"]);
							$meses = intval($value["meses"]);
							$estadopago = intval($value["estadopago"]);

							if ($formadepago == 1) {
								if ($_SESSION['permisosMod']['escribir']) {
									$request_detalle = $this->model->insertDetalle($idventa, $idproducto,$cantidad, $total, $formadepago);
									
								}
							}else if ($formadepago == 2){
								
								if ($_SESSION['permisosMod']['escribir']) {
									$request_detalle = $this->model->insertDetalleCredito($idventa, $idproducto,$cantidad, $total, $formadepago, $cuota, $meses, $estadopago);

								$request_detalle2 = $this->model->insertDetalleCreditoPagoCuota($request_detalle,0,0,0,0,0,0,$total,1,0);
								
								$arrPagos = $this->model->obtenerDatosPagos($idproducto);
									$intereses = round(($total * (($arrPagos[0]['tasa']/100)/12)),2);
								    $capital = round(($cuota - $intereses),2);
								    $totalabono = $intereses + $capital;
								    $saldof = round(($total-$capital),2);

								 $request_detalle2 = $this->model->insertDetalleCreditoPagoCuota($request_detalle,1,$arrPagos[0]['fecha'] ,$cuota,$capital,$intereses,$totalabono,$saldof,0, 0);


									
								}
							}
							
			
							

							if ($_SESSION['permisosMod']['actualizar']) {
								$prod = $this->model->selectProducto($codigo);
								$nuevacantidad = intval($prod['stock']) - $cantidad;
								$request_stock = $this->model->actualizarstock($idproducto,$nuevacantidad);
								
							}
						}
						$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.', 'idventa' => $request, 'tipoventa' => $formadepago);
					
					}else{
						$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
					}
				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
			
		}

		
		public function imprimirticket($idventa){
			//if($_SESSION['permisosMod']['leer']){
				$id = $idventa;
				if($id > 0){
					$arrData = $this->model->selectVenta($id);
					if(empty($arrData)){
						$this->views->getView("Errors","error");
					}else{
						
						$data['productos'] = $arrData;
						$data['idventa'] = $arrData[0]['idventa'];
						$data['fecha'] = $arrData[0]['dia']."/".$arrData[0]['mes']."/".$arrData[0]['anio'];
						$data['subtotal'] = $arrData[0]['subtotal'];
						$data['iva'] = $arrData[0]['iva'];
						$data['total'] = $arrData[0]['monto'];
						$data['cliente'] = $arrData[0]['cliente'];
						$data['vendedor'] = $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellido'] ;
						$this->views->getView(data);
					}
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
				}
			//}
			die();
		}

		public function getProductos()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectProducto();
				$htmlDatosTabla = "";
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						
						$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['idproducto'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
					
				
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnAdd.'</div>';
					$htmlDatosTabla.='<tr>
			                            <td>'.$arrData[$i]['codigobarra'].'</td>
			                            <td>'.$arrData[$i]['descripcion'].'</td>
										<td>'.$arrData[$i]['stock'].'</td>
			                            <td>'.$arrData[$i]['options'].'</td>
			                         </tr>';
				
				}
				$htmlProvee = "";
				$arrDataProvee = $this->model->selectProveedores();
				if(count($arrDataProvee) > 0 ){
					for ($i=0; $i < count($arrDataProvee); $i++) { 
						if($arrDataProvee[$i]['estado'] == 1 ){
						$htmlProvee .= '<option value="'.$arrDataProvee[$i]['idproveedor'].'">'.$arrDataProvee[$i]['nombre'].'</option>';
						
					}
					}
				}

				$arrayDatos = array('datosIndividuales' => $arrData,'htmlDatosTabla' => $htmlDatosTabla, 'listaprov' => $htmlProvee);
				echo json_encode($arrayDatos,JSON_UNESCAPED_UNICODE);
			}
			die();
		}



	}
 ?>