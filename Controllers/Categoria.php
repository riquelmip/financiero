<?php 

	class Categoria extends Controllers{
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

		public function Categoria()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Categorias";//Nombre superior
			$data['page_name'] = "rol_categoria";//Nombre de la pagina 
			$data['page_title'] = "Categorias"; //Nombre del titulo en la vista
			$data['page_functions_js'] = "functions_categoria.js";// Funcion de js para las acciones
			$this->views->getView($this,"categoria",$data);//Se refiere al nombre de la vista
		}

		
		public function getCategorias() //Obtiene todas las categorias para cargarlas a la tabla de datos
		{
			if ($_SESSION['permisosMod']['leer']) {
				$arrData = $this->model->selectCategorias();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";
					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['actualizar']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditCategoria" onClick="fntEditCategoria('.$arrData[$i]['idcategoria'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['eliminar']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelCategoria" onClick="fntDelCategoria('.$arrData[$i]['idcategoria'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getCategoria(int $idcate) //Obtiene una categoria especifica
		{
			if ($_SESSION['permisosMod']['leer']) {
				$intIdcate = intval(strClean($idcate));
				if($intIdcate > 0)
				{
					$arrData = $this->model->selectCategoria($intIdcate);
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


		public function setCategoria(){ //Hace la insercion y edita
			
			$intId = intval($_POST['idCategoria']);
			$strCat =  strClean($_POST['txtNombre']);

			if($intId == 0)
			{
				$option = 1;
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_cat = $this->model->insertCategoria($strCat);
				}
			}else{
				$option = 2;
				if ($_SESSION['permisosMod']['actualizar']) {
				//Actualizar
				$request_cat = $this->model->updateCategoria($intId, $strCat);
				}
			}

			if($request_cat > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_cat == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! La categoria ya existe.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function setCategoriaProd(){ //Hace la insercion y edita
			
		
			$strCat =  strClean($_POST['txtNombre']);

			
				if ($_SESSION['permisosMod']['escribir']) {
				//Crear
				$request_cat = $this->model->insertCategoria($strCat);
				}
			

			if($request_cat > 0 )
			{
				
				//OPTIONS SELECTS DE CATEGORIA
				$htmlCategoria = "";
				$arrDataCategoria = $this->model->selectCategorias();
				if(count($arrDataCategoria) > 0 ){
					for ($i=0; $i < count($arrDataCategoria); $i++) { 
					
						$htmlCategoria .= '<option value="'.$arrDataCategoria[$i]['idcategoria'].'">'.$arrDataCategoria[$i]['nombre'].'</option>';
						
					}
				}

				$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.', 'id' => $request_cat, 'listaCategorias' => $htmlCategoria);
					
				
			}else if($request_cat == 'exist'){
				
				$arrResponse = array('estado' => false, 'msg' => '¡Atención! La categoria ya existe.');
			}else{
				$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function delCategoria() //Elimina la categoria
		{
			if($_POST){
				if ($_SESSION['permisosMod']['eliminar']) {
					$intIdcatee = intval($_POST['idcategoria']);
					$requestDelete = $this->model->deleteCategoria($intIdcatee);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('estado' => true, 'msg' => 'Se ha eliminado la categoria');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estado' => false, 'msg' => 'No es posible eliminar la categoria asociado a un producto.');
					}else{
						$arrResponse = array('estado' => false, 'msg' => 'Error al eliminar la categoria.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}


	}
 ?>