<?php 

	class Permisos extends Controllers{
		public function __construct()
		{
			session_start();
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			parent::__construct();
		}

		public function getPermisosRol(int $idrol)
		{
			$rolid = intval($idrol);
			if($rolid > 0)
			{
				$arrModulos = $this->model->selectModulos(); //Extraemos todos los modulos de la base
				$arrPermisosRol = $this->model->selectPermisosRol($rolid); //Extraemos los permisos que ya tiene un rol
				$arrPermisos = array('leer' => 0, 'escribir' => 0, 'actualizar' => 0, 'eliminar' => 0); 
				$arrPermisoRol = array('idrol' => $rolid );

				if(empty($arrPermisosRol)) //si el rol no tiene aun asignados algunos permisos
				{
					for ($i=0; $i < count($arrModulos) ; $i++) { //creamos un array de permisos vacio

						$arrModulos[$i]['permisos'] = $arrPermisos; //en cada uno de los registros del array modulos, le sumara un array mas de los permisos para ese modulo
					}
				}else{ //si ya tiene asignado permisos
					for ($i=0; $i < count($arrModulos); $i++) {
						$arrPermisos = array('leer' => 0, 'escribir' => 0, 'actualizar' => 0, 'eliminar' => 0);
						if (isset($arrPermisosRol[$i])) { //si no esta vacio los permisos le asignamos  al array permisos los permisos que ya habian en la base
							$arrPermisos = array('leer' => $arrPermisosRol[$i]['leer'], 
											 'escribir' => $arrPermisosRol[$i]['escribir'], 
											 'actualizar' => $arrPermisosRol[$i]['actualizar'], 
											 'eliminar' => $arrPermisosRol[$i]['eliminar'] 
											);
						}
						$arrModulos[$i]['permisos'] = $arrPermisos; //agregamos al array modulos un campo mas de los permisos
						
					}
				}
				$arrPermisoRol['modulos'] = $arrModulos;
				$html = getModal("modalPermisos",$arrPermisoRol); //enviando el array al modal
				//dep($arrPermisoRol);

			}
			die();
		}

		public function setPermisos()
		{
			if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->model->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['idmodulo'];
					$leer = empty($modulo['leer']) ? 0 : 1;
					$escribir = empty($modulo['escribir']) ? 0 : 1;
					$actualizar = empty($modulo['actualizar']) ? 0 : 1;
					$eliminar = empty($modulo['eliminar']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $leer, $escribir, $actualizar, $eliminar);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('estado' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("estado" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>