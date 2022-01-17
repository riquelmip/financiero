<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;
		private $Intiddetalle;
		private $mes;
		private $Mora;
		public $fecha;
		public $fechapago;
		public $cuota;
		public $capital;
		public $intereses;
		public $abonoCapital;
		public $totalabono;
		public $saldof;
		public $estado;

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

		public function getDatosPagosCuota(){
			
			$sql = "SELECT d.iddetalle,
				pg.mes,
				pg.fecha,
				pg.cuota,
				pg.capital,
				pg.intereses,
				pg.totalabono,
				pg.saldofinal
				FROM venta v
				INNER JOIN detalleventa d on d.idventa = v.idventa
				INNER JOIN producto p on p.idproducto = d.idproducto
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN pagocuota pg on pg.iddetalle = d.iddetalle
				WHERE d.formapago = 2 and pg.estado = 0 and d.estadopago = 0 GROUP BY d.iddetalle";
			 $request = $this->select_all($sql);
			return $request;

		}

		public function getTotalCuotasPendientes(){
			
			$sql = "SELECT d.iddetalle,
				pg.mes,
				pg.fecha,
				pg.cuota,
				pg.capital,
				pg.intereses,
				pg.totalabono,
				pg.saldofinal
				FROM venta v
				INNER JOIN detalleventa d on d.idventa = v.idventa
				INNER JOIN producto p on p.idproducto = d.idproducto
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN pagocuota pg on pg.iddetalle = d.iddetalle
				WHERE d.formapago = 2 and pg.estado = 0 and d.estadopago = 0 GROUP BY d.iddetalle";
			 $request = $this->select_all($sql);
			return $request;

		}

		public function getCuotasPendientes(int $iddetalle){

			$this->Intiddetalle = $iddetalle;
			$sql = "SELECT
					COUNT(d.iddetalle) as total
				FROM venta v
				INNER JOIN detalleventa d on d.idventa = v.idventa
				INNER JOIN producto p on p.idproducto = d.idproducto
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN pagocuota pg on pg.iddetalle = d.iddetalle
				WHERE d.formapago = 2 and pg.estado = 0 and d.estadopago = 0 and d.iddetalle=$this->Intiddetalle";
			 $request = $this->select_all($sql);
			return $request;

		}

		public function getDatosPagosCuotaDetalle(int $iddetalle){

			$this->Intiddetalle = $iddetalle;
			
			$sql = "SELECT d.iddetalle,
				d.total,
				pg.mes,
				pg.fecha,
				pg.cuota,
				pg.capital,
				pg.intereses,
				pg.totalabono,
				pg.saldofinal
				FROM venta v
				INNER JOIN detalleventa d on d.idventa = v.idventa
				INNER JOIN producto p on p.idproducto = d.idproducto
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN pagocuota pg on pg.iddetalle = d.iddetalle
				WHERE d.formapago = 2 and pg.estado = 0 and d.estadopago = 0 and d.iddetalle=$iddetalle ORDER BY pg.iddetalle DESC LIMIT 1";
			 $request = $this->select_all($sql);
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

		public function updateDetalleIncobrable(string $iddetalle){
			$this->Intiddetalle = $iddetalle;
			$this->estado = 2;
			
				$sql = "UPDATE detalleventa SET estadopago = ? WHERE iddetalle = $this->Intiddetalle";
				$arrData = array($this->estado);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}

		public function updateMora(int $iddetalle,int $mes,$mora,$totalabono){
			$this->Intiddetalle = $iddetalle;
			$this->mes = $mes;
			$this->Mora = $mora;
			$this->totalabono = $totalabono;
			
				$sql = "UPDATE pagocuota SET mora = ?, totalabono = ? WHERE iddetalle = $this->Intiddetalle and mes = $this->mes";
				$arrData = array($this->Mora, $this->totalabono);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}

		public function insertPagoCuotaPendiente($iddetalle,$mes,$fecha,$cuota,$capital,$intereses,$totalabono,$saldof,$mora){

			$return = "";
			$this->Intiddetalle = $iddetalle;
			$this->mes = $mes;
			$this->fecha = $fecha;
			$this->fechapago = "0000-00-00";
			$this->cuota = $cuota;
			$this->capital = $capital;
			$this->intereses = $intereses; 
			$this->abonoCapital = 0;
			$this->totalabono = $totalabono;
			$this->saldof = $saldof; 
			$this->estado = 0;
			$this->Mora = $mora; 

				$query_insert  = "INSERT INTO pagocuota(iddetalle,mes,fecha,fechapago,cuota,capital,intereses,abonocapital,totalabono,saldofinal,estado,mora) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->Intiddetalle,$this->mes,$this->fecha,$this->fechapago,$this->cuota,$this->capital,$this->intereses,$this->abonoCapital,$this->totalabono,$this->saldof,$this->estado,$this->Mora);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			
			return $return;
		}

		public function obtenerDatosPagos(int $iddetalle){
			$sql = "SELECT
				ct.tasainteres as tasa,
				CONCAT(v.anio,'-',v.mes,'-',v.dia) as fecha
				FROM producto p 
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN detalleventa d on d.idproducto = p.idproducto
				INNER JOIN venta v on v.idventa = d.idventa
				WHERE d.iddetalle=$iddetalle LIMIT 1";
			$request = $this->select_all($sql);
			return $request;
		}	


	}
 ?>