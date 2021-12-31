<?php 

	class Ventas extends Controllers{
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

		public function Ventas()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Ventas";//Nombre superior
			$data['page_name'] = "ventas";//Nombre de la pagina 
			$data['page_title'] = "Ventas"; //Nombre del titulo en la vista
			$data['page_functions_js'] = "functions_venta.js";// Funcion de js para las acciones
			$this->views->getView($this,"ventas",$data);//Se refiere al nombre de la vista
		}
		public function getVentas()
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectVentas();
             
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";

					if($arrData[$i]['estado'] == 1)
					{
						$arrData[$i]['estado'] = '<span class="badge badge-success">Realizada</span>';

						if ($_SESSION['permisosMod']['actualizar']) {
							$btnEdit = ' <button class="btn btn-danger btn-sm" onClick="anularVenta('.$arrData[$i]['idventa'].')" title="Anular Venta"><i class="fas fa-times"></i></button>';
						}
					}else{
						$arrData[$i]['estado'] = '<span class="badge badge-danger">Anulada</span>';
					}

					//concatenamos la fecha XD
					$fecha= $arrData[$i]['dia'] ."/". $arrData[$i]['mes'] ."/". $arrData[$i]['anio'];
					$arrData[$i]['fecha']=$fecha;
					

					if ($_SESSION['permisosMod']['leer']) {
						$btnView = '<button class="btn btn-info btn-sm" onClick="verTicket('.$arrData[$i]['idventa'].')" title="Ver Ticket"><i class="fas fa-ticket-alt"></i></button> <button class="btn btn-primary btn-sm" onClick="verFactura('.$arrData[$i]['idventa'].')" title="Ver Factura PDF"><i class="fas fa-file-pdf"></i></button>';
					}
					
					
					
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.$btnEdit.' </div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function anularVenta()
		{
			if ($_SESSION['permisosMod']['leer']) {
				
	                 

					$idVenta =  intval(strClean($_POST['idventa']));


					$datosVenta = $this->model->selectVenta($idVenta);

					if(count($datosVenta) > 0)
					{

						$data['productos'] = $datosVenta;
						$data['idventa'] = $datosVenta[0]['idventa'];
						$data['fecha'] = $datosVenta[0]['dia']."/".$datosVenta[0]['mes']."/".$datosVenta[0]['anio'];
						$data['subtotal'] = $datosVenta[0]['subtotal'];
						$data['iva'] = $datosVenta[0]['iva'];
						$data['total'] = $datosVenta[0]['monto'];
						$data['cliente'] = $datosVenta[0]['cliente'];
						$data['vendedor'] = $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellido'] ;

						if ($_SESSION['permisosMod']['escribir']) {
								$editarestadoventa = $this->model->anularVenta($idVenta);
								
							}

						for ($i=0; $i < count($datosVenta); $i++) {

							//agrergando las cantidades nuevamente al stock de producto
							

							if ($_SESSION['permisosMod']['actualizar']) {
								$prod = $this->model->selectProducto($datosVenta[$i]['idproducto']);
								$idproducto = $datosVenta[$i]['idproducto'];
								$cantidadagregar = intval($datosVenta[$i]['cantidad']);
								$stockprod = intval($prod['stock']);
								$nuevostock = $cantidadagregar + $stockprod;
								$request_stock = $this->model->actualizarstock($idproducto,$nuevostock);
								
							}
						}
						$arrResponse = array('estado' => true, 'msg' => 'Venta anulada correctamente.');
					
					}else{
						$arrResponse = array("estado" => false, "msg" => 'No es posible anular la venta.');
					}
				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getCadena($idcadena){
			
				$idCadena = intval($idcadena);
				if($idCadena > 0)
				{
					$arrData = $this->model->selectCadena($idCadena);
					for ($i=0; $i < count($arrData); $i++) {
						$conver = round($arrData[$i]['precioventa'],2);

						$datito="$".$conver;
						$arrData[$i]['precioventa'] = $datito;

					}

					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
		
			die();
		}

        
	}
    ?>