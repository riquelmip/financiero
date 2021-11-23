<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}	

		public function loginUser(string $usuario, string $password){
			$this->strUsuario = $usuario;
			$this->strPassword = $password;
			$sql = "SELECT idusuario, estado FROM usuario WHERE email_usuario = '$this->strUsuario' AND contrasena = '$this->strPassword' AND estado != 0";
			$request = $this->select($sql);
			return $request; 
		}


		public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			//BUSCAR ROLE
			$sql = "SELECT 
					u.idusuario, 
					u.email_usuario, 
					e.dui,
					e.nombre,
					e.apellido,
					e.nit,
					u.estado,r.idrol, 
					r.nombrerol, 
					c.idcargo,
					c.nombre AS cargo 
					FROM usuario u 
					INNER JOIN empleado e ON u.idempleado = e.idempleado
					INNER JOIN rol r ON u.rolid = r.idrol
					INNER JOIN cargo c ON e.idcargo = c.idcargo
					WHERE u.idusuario = $this->intIdUsuario";
			$request = $this->select($sql);
			//lo que devuela la consulta sera almacenado en los datos de sesion, esto se hace para q de un solo se actualice sin necesidad de que el usuario vuelva a iniciar sesion
			$_SESSION['userData'] = $request;
			return $request;
		}

		public function getUserEmail(string $email){
			$this->strUsuario = $email;
			$sql = "SELECT 
					u.idusuario, 
					u.email_usuario, 
					e.dui,
					e.nombre,
					e.apellido,
					e.nit,
					u.estado,r.idrol, 
					r.nombrerol, 
					c.idcargo,
					c.nombre AS cargo 
					FROM usuario u 
					INNER JOIN empleado e ON u.idempleado = e.idempleado
					INNER JOIN rol r ON u.rolid = r.idrol
					INNER JOIN cargo c ON e.idcargo = c.idcargo
					WHERE u.email_usuario = '$this->strUsuario' AND u.estado != 0";
			$request = $this->select($sql);
			return $request;

		}

		public function setTokenUser(int $idusuario, string $token){
			$this->intIdUsuario = $idusuario;
			$this->srtToken = $token;
			$sql = "UPDATE usuario SET token = ? WHERE idusuario = $this->intIdUsuario";
			$arrData = array($this->srtToken);
			$request = $this->update($sql, $arrData);	
			return $request;
		}

		public function bloquearUsuario(int $idusuario, string $email){
			$this->intIdUsuario = $idusuario;
			$this->strUsuario = $email;
			$sql = "UPDATE usuario SET estado = ? WHERE idusuario = $this->intIdUsuario AND email_usuario = '$this->strUsuario'";
			$arrData = array(2);
			$request = $this->update($sql, $arrData);	
			return $request;
		}
		public function desbloquearUsuario(int $idusuario, string $email){
			$this->intIdUsuario = $idusuario;
			$this->strUsuario = $email;
			$sql = "UPDATE usuario SET estado = ? WHERE idusuario = $this->intIdUsuario AND email_usuario = '$this->strUsuario'";
			$arrData = array(1);
			$request = $this->update($sql, $arrData);	
			return $request;
		}

		public function getUsuario(string $email, string $token){
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT idusuario FROM usuario WHERE email_usuario = '$this->strUsuario' AND token = '$this->strToken' AND estado = 1";
			$request = $this->select($sql);
			return $request;
		}

		public function getUsuarioBloqueado(string $email, string $token){
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT idusuario FROM usuario WHERE email_usuario = '$this->strUsuario' AND token = '$this->strToken' AND estado = 2";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idusuario, string $password){
			$this->intIdUsuario = $idusuario;
			$this->strPassword = $password;
			$sql = "UPDATE usuario SET contrasena = ?, token = ? WHERE idusuario = $this->intIdUsuario";
			$arrData = array($this->strPassword, "");
			$request = $this->update($sql, $arrData);
			return $request;
		}
	}
 ?>