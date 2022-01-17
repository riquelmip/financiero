<?php 

	class Consultas extends Controllers{
		public function __construct(){
			parent::__construct();
			session_start();
			session_regenerate_id(true); 
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(2); 
		}
///////////Funciones para vistas
		public function Consultas(){ //Vista primera consulta

			if (empty($_SESSION['permisosMod']['leer'])) {
			header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Producto más vendido";
			$data['page_name'] = "consulta_1";
			$data['page_title'] = "Parámetros: ";
		 	$data['page_functions_js'] = "functions_productomasvendido.js";
			$this->views->getView($this,"productomasvendido",$data);
		}
		
		/////////Venta
		public function imprimirticket($idventa){
			//if($_SESSION['permisosMod']['leer']){
				$id = $idventa;
				if($id > 0){
					$arrDatav = $this->model->selectVenta($id);
					if(empty($arrDatav)){
						$this->views->getView("Errors","error");
					}else{
						//dep($arrDatav['idclientenat']);die();
						if ($arrDatav['idclientenat'] != '') {
							$arrData = $this->model->selectVentaCN($id);
						}else{
							$arrData = $this->model->selectVentaCJ($id);
						}
						
						$data['productos'] = $arrData;
						$data['idventa'] = $arrData[0]['idventa'];
						$data['fecha'] = $arrData[0]['dia']."/".$arrData[0]['mes']."/".$arrData[0]['anio'];
						$data['subtotal'] = $arrData[0]['subtotal'];
						$data['iva'] = $arrData[0]['iva'];
						$data['monto'] = $arrData[0]['monto'];
						$data['cliente'] = $arrData[0]['cliente'];
						$data['vendedor'] = $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellido'] ;
						$this->views->getView($this,"ticket",$data);
					}
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
				}
			//}
			die();
		}

		public function imprimirfactura($idventa){
			//if($_SESSION['permisosMod']['leer']){
				$id = $idventa;
				if($id > 0){
					$arrDatav = $this->model->selectVenta($id);
					if(empty($arrDatav)){
						$this->views->getView("Errors","error");
					}else{
						if ($arrDatav['idclientenat'] != '') {
							$arrData = $this->model->selectVentaCN($id);
						}else{
							$arrData = $this->model->selectVentaCJ($id);
						}
						$data['productos'] = $arrData;
						$data['idventa'] = $arrData[0]['idventa'];
						$data['fecha'] = $arrData[0]['dia']."/".$arrData[0]['mes']."/".$arrData[0]['anio'];
						$data['subtotal'] = $arrData[0]['subtotal'];
						$data['iva'] = $arrData[0]['iva'];
						$data['monto'] = $arrData[0]['monto'];
						$data['cliente'] = $arrData[0]['cliente'];
						$data['vendedor'] = $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellido'] ;
						$this->views->getView($this,"factura",$data);
					}
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
				}
			//}
			die();
		}


		public function imprimirfacturacreditofiscal($idventa){
			//if($_SESSION['permisosMod']['leer']){
				$id = $idventa;
				if($id > 0){
					$arrDatav = $this->model->selectVenta($id);
					if(empty($arrDatav)){
						$this->views->getView("Errors","error");
					}else{
						if ($arrDatav['idclientenat'] != '') {
							$arrData = $this->model->selectVentaCN($id);
						}else{
							$arrData = $this->model->selectVentaCJ($id);
						}
						$data['productos'] = $arrData;
						$data['idventa'] = $arrData[0]['idventa'];
						$data['fecha'] = $arrData[0]['dia']."/".$arrData[0]['mes']."/".$arrData[0]['anio'];
						$data['subtotal'] = $arrData[0]['subtotal'];
						$data['iva'] = $arrData[0]['iva'];
						$data['monto'] = $arrData[0]['monto'];
						$data['cliente'] = $arrData[0]['cliente'];
						$data['vendedor'] = $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellido'] ;
						$this->views->getView($this,"facturacreditofiscal",$data);
					}
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
				}
			//}
			die();
		}

		public function imprimirnota($idventa){
			//if($_SESSION['permisosMod']['leer']){
				$id = $idventa;
				if($id > 0){
					$arrDatav = $this->model->selectVenta($id);
					if(empty($arrDatav)){
						$this->views->getView("Errors","error");
					}else{
						if ($arrDatav['idclientenat'] != '') {
							$arrData = $this->model->selectVentaCN($id);
							$arrData2 = $this->model->selectempleadoCN($arrData[0]['idusuario']);
						}else{
							$arrData = $this->model->selectVentaCJ($id);
							$arrData2 = $this->model->selectempleadoCN($arrData[0]['idusuario']);
						}
						$data['productos'] = $arrData;
						$data['idventa'] = $arrData[0]['idventa'];
						$data['fecha'] = $arrData[0]['dia']."/".$arrData[0]['mes']."/".$arrData[0]['anio'];
						$data['subtotal'] = $arrData[0]['subtotal'];
						$data['iva'] = $arrData[0]['iva'];
						$data['monto'] = $arrData[0]['monto'];
						$data['cliente'] = $arrData[0]['cliente'];
						$data['vendedor'] = $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellido'] ;
						$data['idusuario'] = $arrData[0]['idusuario'];
						$data['nombreusuario'] = $arrData2[0]['nombre'];
						$data['dui'] = $arrData2[0]['dui'];
						$data['telefono'] = $arrData2[0]['telefono'];
						$this->views->getView($this,"nota",$data);
					}
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
				}
			//}
			die();
		}

		public function imprimirnotaCREDITO($idventa){
			//if($_SESSION['permisosMod']['leer']){
				$id = $idventa;
				$estado = 1;
				if($id > 0){
					$arrDataPagos = $this->model->selectPagos(intval($idventa),intval($estado));
					$arrDatav = $this->model->selectVenta($id);

					if(empty($arrDatav)){
						$this->views->getView("Errors","error");
					}else{
						if ($arrDatav['idclientenat'] != '') {
							$arrData = $this->model->selectVentaCN($id);
							$arrData2 = $this->model->selectempleadoCN($arrData[0]['idusuario']);
						}else{
							$arrData = $this->model->selectVentaCJ($id);
							$arrData2 = $this->model->selectempleadoCN($arrData[0]['idusuario']);
						}
						$data['productos'] = $arrData;
						$data['pagos'] = $arrDataPagos;
						$data['idventa'] = $arrData[0]['idventa'];
						$data['fecha'] = $arrData[0]['dia']."/".$arrData[0]['mes']."/".$arrData[0]['anio'];
						$data['subtotal'] = $arrData[0]['subtotal'];
						$data['iva'] = $arrData[0]['iva'];
						$data['monto'] = $arrData[0]['monto'];
						$data['cliente'] = $arrData[0]['cliente'];
						$data['vendedor'] = $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellido'] ;
						$data['idusuario'] = $arrData[0]['idusuario'];
						$data['nombreusuario'] = $arrData2[0]['nombre'];
						$data['dui'] = $arrData2[0]['dui'];
						$data['telefono'] = $arrData2[0]['telefono'];
						$this->views->getView($this,"notacredito",$data);
					}
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
				}
			//}
			die();
		}

	}
 ?>