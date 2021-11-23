<?php 

	class RolesModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intestado;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectRoles()
		{
			$whereAdmin = "";
			if ($_SESSION['idUser'] != 1) {//1 es el id de usuario del superadministrador o root
				$whereAdmin = " and idrol != 1"; //si el usuario que esta logeado no es el usuario root, no va extraer al rol de administradores, ya que solo el root puede crear usuarios administradores
			}
			//EXTRAE ROLES
			$sql = "SELECT * FROM rol WHERE estado != 0".$whereAdmin;
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectRol(int $idrol)
		{
			//BUSCAR ROLE
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM rol WHERE idrol = $this->intIdrol";
			$request = $this->select($sql);
			return $request;
		}

		public function insertRol(string $rol, string $descripcion, int $estado){

			$return = "";
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intestado = $estado;

			$sql = "SELECT * FROM rol WHERE nombrerol = '{$this->strRol}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO rol(nombrerol,descripcion,estado) VALUES(?,?,?)";
	        	$arrData = array($this->strRol, $this->strDescripcion, $this->intestado);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateRol(int $idrol, string $rol, string $descripcion, int $estado){
			$this->intIdrol = $idrol;
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intestado = $estado;

			$sql = "SELECT * FROM rol WHERE nombrerol = '$this->strRol' AND idrol != $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE rol SET nombrerol = ?, descripcion = ?, estado = ? WHERE idrol = $this->intIdrol ";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intestado);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM usuario WHERE rolid = $this->intIdrol";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE rol SET estado = ? WHERE idrol = $this->intIdrol ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}
	}
 ?>