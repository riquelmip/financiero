<?php 

	class Dashboard extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			//Como este controlador muestra la vista del dashboard, y como en la base el modeulo dashboard tiene el id 1, por eso ese se manda de param
			getPermisos(1);
		}

		public function dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Inicio - Ferreteria";
			$data['page_title'] = "Inicio - Ferreteria Granadeño";
			$data['page_name'] = "dashboard";
			$data['page_functions_js'] = "functions_dashboard.js";
			$this->views->getView($this,"dashboard",$data);
		}

	}


 ?>