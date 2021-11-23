<?php 

	class PermisosModel extends Mysql
	{
		public $intIdpermiso;
		public $intRolid;
		public $intModuloid;
		public $leer;
		public $escribir;
		public $actualizar;
		public $eliminar;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectModulos()
		{
			$sql = "SELECT * FROM modulo WHERE estado != 0";
			$request = $this->select_all($sql);
			return $request;
		}	
		public function selectPermisosRol(int $idrol)
		{
			$this->intRolid = $idrol;
			$sql = "SELECT * FROM permisos WHERE rolid = $this->intRolid";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deletePermisos(int $idrol)
		{
			$this->intRolid = $idrol;
			$sql = "DELETE FROM permisos WHERE rolid = $this->intRolid";
			$request = $this->delete($sql);
			return $request;
		}

		public function insertPermisos(int $idrol, int $idmodulo, int $leer, int $escribir, int $actualizar, int $eliminar){
			$this->intRolid = $idrol;
			$this->intModuloid = $idmodulo;
			$this->leer = $leer;
			$this->escribir = $escribir;
			$this->actualizar = $actualizar;
			$this->eliminar = $eliminar;
			$query_insert  = "INSERT INTO permisos(rolid,moduloid,leer,escribir,actualizar,eliminar) VALUES(?,?,?,?,?,?)";
        	$arrData = array($this->intRolid, $this->intModuloid, $this->leer, $this->escribir, $this->actualizar, $this->eliminar);
        	$request_insert = $this->insert($query_insert,$arrData);		
	        return $request_insert;
		}

		public function permisosModulo(int $idrol){
			$this->intRolid = $idrol;
			$sql = "SELECT p.rolid,
						   p.moduloid,
						   m.titulo as modulo,
						   p.leer,
						   p.escribir,
						   p.actualizar,
						   p.eliminar
					FROM permisos p
					INNER JOIN modulo m
					ON p.moduloid = m.idmodulo
					WHERE p.rolid = $this->intRolid";
			$request = $this->select_all($sql);
			$arrPermisos = array();
			for ($i=0; $i < count($request); $i++) { 
				//agregando los elementos a ese nuevo array, para que el indice de cada ppsicion sea el del id del modulo, y no el indice propio del array
				$arrPermisos[$request[$i]['moduloid']] =$request[$i];
			}
			return $arrPermisos;
		}
	}
 ?>