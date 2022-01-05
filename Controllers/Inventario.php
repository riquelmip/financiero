<?php 

	class Inventario extends Controllers{
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

		public function Inventario()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 11;
			$data['page_tag'] = "Existencias";
			$data['page_name'] = "inventario";
			$data['page_title'] = "Existencias <small> productos</small>";
			$data['page_functions_js'] = "functions_inventario.js";
			$this->views->getView($this,"inventario",$data);
		}

		
		public function getInventario(){

			if ($_SESSION['permisosMod']['leer']) {

				$arrData = $this->model->selectInventario();

				for ($i=0; $i < count($arrData); $i++) {
					
					$stock="";

					if($arrData[$i]['stock'] > 10){
						$stock='<span class="badge badge-success">'.$arrData[$i]['stock'].'</span>';
					}else{
						$stock='<span class="badge badge-danger">'.$arrData[$i]['stock'].'</span>';
					}

					$arrData[$i]['stock'] = $stock;
				
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function entradasProductos()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 11;
			$data['page_tag'] = "Entradas";
			$data['page_name'] = "entradas";
			$data['page_title'] = "Registro de entradas <small> productos</small>";
			$data['page_functions_js'] = "functions_entradas.js";
			$this->views->getView($this,"registroEntradas",$data);
		}

		public function getRegistroEntradas(){

			if ($_SESSION['permisosMod']['leer']) {

				$arrData = $this->model->selectEntradas();
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function salidasProductos()
		{
			//si no tiene permiso de usuarios, lo rediccionara
			if (empty($_SESSION['permisosMod']['leer'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_id'] = 11;
			$data['page_tag'] = "Salidas";
			$data['page_name'] = "salidas";
			$data['page_title'] = "Registro de salidas <small> productos</small>";
			$data['page_functions_js'] = "functions_salidas.js";
			$this->views->getView($this,"salidasProductos",$data);
		}

		public function getRegistroSalidas(){

			if ($_SESSION['permisosMod']['leer']) {

				$arrData = $this->model->selectSalidas();
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}



	}

    

 ?>