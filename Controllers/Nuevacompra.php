<?php 

	class Nuevacompra extends Controllers {
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(5); //tiene parametro 2 porque es el de usuario, osea que lo estamos poniendo junto, ya que si tiene acceso a usuario tiene a roles
		}

		public function Nuevacompra()
		{

			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Nueva Compra";
			$data['page_name'] = "rol_categoria";
			$data['page_title'] = "Nueva Compra";
			$data['page_functions_js'] = "functions_nuevacompra.js";
			$this->views->getView($this,"nuevacompra",$data);
		}


		public function getSelects() 
		{
			$htmlProvee = "";
			$arrDataProvee = $this->model->selectProveedores();
			if(count($arrDataProvee) > 0 ){
				for ($i=0; $i < count($arrDataProvee); $i++) { 
					if($arrDataProvee[$i]['estado'] == 1 ){
					$htmlProvee .= '<option value="'.$arrDataProvee[$i]['idproveedor'].'">'.$arrDataProvee[$i]['nombre'].'</option>';
					
				}
				}
			}


			$arrResponse = array('proveedores' => $htmlProvee);
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();		
		}


		public function setCompra(){
			//dep($_POST);
			//die();

			if($_POST){

					//$intIdCadena = intval($_POST['idCadena']);//id compra
	                 
					$strArrayCoros = json_decode($_POST["listaProducto"], true);//detalles
					$subtotalll = json_decode($_POST["listsub"], true);
					$sum = 0;
					foreach ($subtotalll as $key => $value2) {
						$idproducto = $value2["subtotal"];
						$sum += floatval($idproducto);
					}
					$date = strClean($_POST['fechacredito']);
					
					$pruee =  floatval(strClean($_POST['credito']));
					$intProve =  intval(strClean($_POST['listProve']));

						$request_rol = $this->model->insertarCompra($intProve,$sum,$pruee,$date);//Insertar la compra 1 
					
					//obtenemos el id de la cadena que se inserto
					
						
					if($request_rol > 0 )
					{
						foreach ($strArrayCoros as $key => $value) {

							

							$idcompra = $request_rol;//El id de compra
							$idproducto = $value["id"];// El idproducto de la tabla detallecompra
							$cantidad = $value["cantidad"];
							$preciocompra = $value["preciocompra"];
							$precioventa = $value["precioventa"];
			
							if ($_SESSION['permisosMod']['escribir']) {
								$request_rol1 = $this->model->insertDetalleCadena($idcompra, $idproducto,$cantidad,$preciocompra,$precioventa);
								
							}

						}
						$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
					
					}else if($request_rol == 'exist'){
						
						$arrResponse = array('estado' => false, 'msg' => '¡Atención! La Cadena ya existe.');
					}else{
						$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
					}
				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
			
		}

		public function getProducto($id){
		
				$id = intval($id);
				if($id > 0)
				{

					$arrData = $this->model->selectProductod($id);
					for ($i=0; $i < count($arrData); $i++) { 
						$arrResponse = array( 'datadescripcion' => $arrData[$i]['descripcion'] ,'dataidproducto' => $arrData[$i]['idproducto'],'status' => true);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			
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