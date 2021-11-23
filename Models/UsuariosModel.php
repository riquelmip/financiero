<?php 

	class UsuariosModel extends Mysql
	{
		private $intIdUsuario;
		private $strEmail;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
		private $intEmpleado;


		public function __construct()
		{
			parent::__construct();
		}	

		public function insertUsuario(string $email, string $password, int $tipoid, int $status, int $empleadoid){


			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$this->intEmpleado = $empleadoid;
			$return = 0;

			$sql = "SELECT * FROM usuario WHERE 
					email_usuario = '{$this->strEmail}' AND estado != 0";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO usuario(email_usuario,contrasena,rolid,estado, idempleado) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array(
        						$this->strEmail,
        						$this->strPassword,
        						$this->intTipoId,
        						$this->intStatus,
							$this->intEmpleado);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectUsuarios()
		{
			$whereAdmin = "";
			if ($_SESSION['idUser'] != 1) {//1 es el id de usuario del superadministrador o root
				$whereAdmin = " and u.idusuario != 1"; //si el usuario que esta logeado no es el usuario root, no va extraer al superusuario
			}

			$sql = "SELECT 
					u.idusuario, 
					u.email_usuario, 
					e.dui,
					e.nombre,
					e.apellido,
					e.nit,
					e.telefono,
					u.estado,r.idrol, 
					r.nombrerol 
					FROM usuario u 
					INNER JOIN empleado e ON u.idempleado = e.idempleado
					INNER JOIN rol r ON u.rolid = r.idrol
					WHERE u.estado != 0".$whereAdmin;

					$request = $this->select_all($sql);
					return $request;
		}

		

		public function selectUsuario(int $idpersona){
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT 
					e.idempleado,
					u.idusuario, 
					u.email_usuario, 
					e.dui,
					e.nombre,
					e.apellido,
					e.nit,
					e.telefono,
					u.estado,r.idrol, 
					r.nombrerol,
					u.datecreated 
					FROM usuario u 
					INNER JOIN empleado e ON u.idempleado = e.idempleado
					INNER JOIN rol r ON u.rolid = r.idrol
					WHERE u.estado != 0 AND u.idusuario = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}

		public function selectEmpleados()
		{
			
			//EXTRAE ROLES
			$sql = "SELECT * FROM empleado WHERE estado != 0";
			$request = $this->select_all($sql);
			return $request;
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

		
		public function updateUsuario(int $idUsuario, string $email, string $password, int $tipoid, int $status, int $empleadoid){

			$this->intIdUsuario = $idUsuario;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$this->intEmpleado = $empleadoid;

			$sql = "SELECT * FROM usuario WHERE (email_usuario = '{$this->strEmail}' AND idusuario != $this->intIdUsuario
										  AND idusuario != $this->intIdUsuario) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE usuario SET email_usuario=?, contrasena=?, rolid=?, estado=?, idempleado=? 
							WHERE idusuario = $this->intIdUsuario ";
					$arrData = array($this->strEmail,
									$this->strPassword,
									$this->intTipoId,
									$this->intStatus,
									$this->intEmpleado);
				}else{
					$sql = "UPDATE usuario SET email_usuario=?, rolid=?, estado=?, idempleado=? 
							WHERE idusuario = $this->intIdUsuario ";
					$arrData = array($this->strEmail,
									$this->intTipoId,
									$this->intStatus,
									$this->intEmpleado);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		
		}
		public function deleteUsuario(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE usuario SET estado = ? WHERE idusuario = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updatePerfil(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $password){
			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strPassword = $password;
			if ($this->strPassword != "") {
				$sql = "UPDATE persona SET identificacion = ?, nombres = ?, apellidos = ?, telefono = ?, password = ? WHERE idpersona = $this->intIdUsuario";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono,
								$this->strPassword);
			}else{
				$sql = "UPDATE persona SET identificacion = ?, nombres = ?, apellidos = ?, telefono = ? WHERE idpersona = $this->intIdUsuario";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono);
			}
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updateDataFiscal(int $idUsuario, string $strNit, string $strNomFiscal, string $strDirFiscal){
			$this->intIdUsuario = $idUsuario;
			$this->strNit = $strNit;
			$this->strNomFiscal = $strNomFiscal;
			$this->strDirFiscal = $strDirFiscal;
			$sql = "UPDATE persona SET nit=?, nombrefiscal=?, direccionfiscal=? 
						WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strNit,
							$this->strNomFiscal,
							$this->strDirFiscal);
			$request = $this->update($sql,$arrData);
		    return $request;
		}
	}
 ?>