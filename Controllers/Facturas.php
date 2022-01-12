<?php 

	class Facturas extends Controllers{

		//CONSTRUCTOR
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			//if (empty($_SESSION['login'])) {
			//	header('location: '.base_url().'/login');
			//}
			//getPermisos(4); 
		}

		//Utilizamos en la vista

		public function Facturas()
		{

			//if (empty($_SESSION['permisosMod']['leer'])) {
		//		header('location: '.base_url().'/dashboard');
		//	}
			$data['page_id'] = 3;
			$data['page_tag'] = "Facturas";
			$data['page_name'] = "Facturas";
			$data['page_title'] = "Facturas";
			$data['page_functions_js'] = "functions_facturas.js";
			$this->views->getView($this,"Facturas",$data);
		}
    }
 ?>