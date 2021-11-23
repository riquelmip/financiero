<?php 
	class Productos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(9);
		}

		public function Productos()
		{
			if(empty($_SESSION['permisosMod']['leer'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Productos";
			$data['page_title'] = "PRODUCTOS <small> Ferretería</small>";
			$data['page_name'] = "productos";
			$data['page_functions_js'] = "functions_productos.js";
			$this->views->getView($this,"productos",$data);
		}

		public function getProductos()
		{
			if($_SESSION['permisosMod']['leer']){
				$arrData = $this->model->selectProductos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['estado'] == 1)
					{
						$arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					//$arrData[$i]['precio'] = SMONEY.' '.formatMoney($arrData[$i]['precio']);
					if($_SESSION['permisosMod']['leer']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idproducto'].')" title="Ver producto"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['actualizar']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idproducto'].')" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['eliminar']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idproducto'].')" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>';
					}

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

					$caruselInic = '<div id="caruselProd-'.$arrData[$i]['idproducto'].'" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
					$caruselFin = '</div></div>';
					   
					    
					
					//agrego las imagenes de ese producto
					$caruselImg = '';
					$arrImg = $this->model->selectImages($arrData[$i]['idproducto']);
						if(count($arrImg) > 0){
							for ($j=0; $j < count($arrImg); $j++) { 
								$arrImg[$j]['url_image'] = media().'/images/uploads/'.$arrImg[$j]['img'];
								if ($j==0) {
									$caruselImg .= ' <div class="carousel-item active"><img class="d-block w-100 text-center" height="75" src="'.media().'/images/uploads/'.$arrImg[$j]['img'].'" alt="Imagen-'.$arrImg[$j]['img'].'"></div>';
								}else{
									$caruselImg .= ' <div class="carousel-item"><img class="d-block w-100 text-center" height="75" src="'.media().'/images/uploads/'.$arrImg[$j]['img'].'" alt="Imagen-'.$arrImg[$j]['img'].'"></div>';
								}
								
							}
						}
					$arrData[$i]['imagenes'] =  '<div class="text-center">'.$caruselInic.$caruselImg.$caruselFin.'</div>';
					
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getSelects()
		{
			//OPTIONS SELECT DE MARCA
			$htmlMarca = "";
			$arrDataMarca = $this->model->selectMarca();
			if(count($arrDataMarca) > 0 ){
				for ($i=0; $i < count($arrDataMarca); $i++) { 
				
					$htmlMarca .= '<option value="'.$arrDataMarca[$i]['idmarca'].'">'.$arrDataMarca[$i]['nombre'].'</option>';
					
				}
			}

			//OPTIONS SELECTS DE CATEGORIA
			$htmlCategoria = "";
			$arrDataCategoria = $this->model->selectCategorias();
			if(count($arrDataCategoria) > 0 ){
				for ($i=0; $i < count($arrDataCategoria); $i++) { 
				
					$htmlCategoria .= '<option value="'.$arrDataCategoria[$i]['idcategoria'].'">'.$arrDataCategoria[$i]['nombre'].'</option>';
					
				}
			}

			//OPTIONS SELECTS DE UNIDAD DE MEDIDA
			$htmlUnidad = "";
			$arrDataUnidad = $this->model->selectUnidadMedida();
			if(count($arrDataUnidad) > 0 ){
				for ($i=0; $i < count($arrDataUnidad); $i++) { 
				
					$htmlUnidad .= '<option value="'.$arrDataUnidad[$i]['idunidad'].'">'.$arrDataUnidad[$i]['nombre'].'</option>';
					
				}
			}

			$arrResponse = array('marca' => $htmlMarca, 'categoria' => $htmlCategoria, 'unidad' => $htmlUnidad);
			
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();		
		}


		public function setProducto(){
			
			if($_POST){
				
				if(empty($_POST['txtDescripcion']) || 
				   empty($_POST['txtCodigo']) ||
				   empty($_POST['listEstado']) ||
				   empty($_POST['listCategoria']) ||
				   empty($_POST['listMarca']) ||
				   empty($_POST['listUnidad']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$idProducto = intval($_POST['idProducto']);
					$strDescripcion = strClean($_POST['txtDescripcion']);
					$strCodigo = strClean($_POST['txtCodigo']);
					$intCat = intval(strClean($_POST['listCategoria']));
					$intMarca = intval(strClean($_POST['listMarca']));
					$intUnidad = intval(strClean($_POST['listUnidad']));
					$intEstado = intval(strClean($_POST['listEstado']));
					$request_producto = "";
					if($idProducto == 0)
					{
						$option = 1;
						if ($_SESSION['permisosMod']['escribir']) {
							$request_producto = $this->model->insertProducto($strCodigo,
																				$strDescripcion, 
																				$intEstado, 
																				$intMarca,
																				$intCat,
																				$intUnidad );
						}
					}else{
						$option = 2;
						if ($_SESSION['permisosMod']['actualizar']) {
							$request_producto = $this->model->updateProducto($idProducto,
																			$strCodigo,
																			$strDescripcion, 
																			$intEstado, 
																			$intMarca,
																			$intCat,
																			$intUnidad
																		);
						}

					}

					if($request_producto > 0 )
					{
						if($option == 1){
							$arrResponse = array('estado' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_producto == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => '¡Atención! el producto con ese codigo de barra ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			
			die();
		}

		public function getProducto($idproducto){
			if($_SESSION['permisosMod']['leer']){
				$idproducto = intval($idproducto);
				if($idproducto > 0){
					$arrData = $this->model->selectProducto($idproducto);
					if(empty($arrData)){
						$arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrImg = $this->model->selectImages($idproducto);
						if(count($arrImg) > 0){
							for ($i=0; $i < count($arrImg); $i++) { 
								$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
							}
						}
						$arrData['images'] = $arrImg;
						$arrResponse = array('estado' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}


		public function setImage()
		{
			if($_POST){
				if(empty($_POST['idproducto'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos');
				}else{
					$idProducto = intval($_POST['idproducto']);
					$foto      = $_FILES['foto'];
					$imgNombre = 'pro_'.md5(date('d-m-Y H:i:s')).'.jpg';
					$request_image = $this->model->insertImage($idProducto,$imgNombre);
					if($request_image){
						$uploadImage = uploadImage($foto,$imgNombre);
						$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delFile(){
			if($_POST){
				if(empty($_POST['idproducto']) || empty($_POST['file'])){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					//Eliminar de la DB
					$idProducto = intval($_POST['idproducto']);
					$imgNombre  = strClean($_POST['file']);
					$request_image = $this->model->deleteImage($idProducto,$imgNombre);

					if($request_image){
						$deleteFile =  deleteFile($imgNombre);
						$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delProducto(){
			if($_POST){
				if($_SESSION['permisosMod']['eliminar']){
					$intIdproducto = intval($_POST['idProducto']);
					$requestDelete = $this->model->deleteProducto($intIdproducto);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
	
	}

 ?>