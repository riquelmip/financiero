<?php 

	class NuevaventaModel extends Mysql
	{
		public $intId;
		public $strNombre;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectVenta(int $idventa) 
		{

			$sql = "SELECT 
					v.idventa,
					v.dia,
					v.mes,
					v.anio,
					v.monto,
					v.estado,
					v.subtotal,
					v.iva,
					CONCAT(c.nombre,' ',c.apellido)  AS cliente,
					dv.iddetalle,
					dv.idproducto,
					p.descripcion as producto,
					dv.cantidad,
					p.precio
					FROM detalleventa dv
					INNER JOIN venta v ON dv.idventa = v.idventa
					INNER JOIN producto p ON p.idproducto= dv.idproducto
					INNER JOIN cliente c ON v.idcliente = c.idcliente
					WHERE v.idventa = $idventa";
			$request = $this->select_all($sql);
			return $request;
		}
		

		public function selectClientes()
		{

			$sql = "SELECT * FROM cliente WHERE estado != 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectPersonaN()
		{

			$sql = "SELECT 
					codigo_persona_natural as codigo, 
					CONCAT(nombre_persona_natural,' ',apellido_persona_natural)  AS nombre
					FROM tbl_persona_natural";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectPersonaJ()
		{

			$sql = "SELECT 
					codigo_persona_juridica as codigo,
					nombre_empresa_persona_juridica as nombre
					FROM tbl_persona_juridica";
			$request = $this->select_all($sql);
			return $request;
		}

		public function insertCliente(string $dui, string $nombre, string $apellido, string $telefono, int $estado){

			$return = "";
			$this->strDui = $dui;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->strTelefono = $telefono;
			$this->intEstado = $estado;

			if ($this->strDui == "" ) {
				$sql = "SELECT * FROM cliente WHERE nombre = '{$this->strNombre}' AND apellido = '{$this->strApellido}' ";
				$request = $this->select_all($sql);
			}else{
				$sql = "SELECT * FROM cliente WHERE dui = '{$this->strDui}'";
				$request = $this->select_all($sql);
			}
			

			if(empty($request))
			{
				$query_insert  = "INSERT INTO cliente(dui,nombre,apellido,estado,telefono) VALUES(?,?,?,?,?)";
	        	$arrData = array($this->strDui,$this->strNombre,$this->strApellido,$this->intEstado,$this->strTelefono);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function selectProducto(string $codigo){
			$this->intIdProducto = $codigo;
			$sql = "SELECT
					p.idproducto,
					p.codigobarra,
					p.descripcion,
					p.stock,
					p.precio,
					p.idcategoria,
					c.nombre AS categoria,
					c.tasainteres AS tasa,
					p.idmarca,
					m.nombre AS marca,
					p.idunidadmedida,
					u.nombre AS unidadmedida,
					p.estado 
				FROM
					producto p
					INNER JOIN categoria c ON p.idcategoria = c.idcategoria
					INNER JOIN marca m ON p.idmarca = m.idmarca
					INNER JOIN unidadmedida u ON p.idunidadmedida = u.idunidad
					WHERE codigobarra = '$this->intIdProducto'";
			$request = $this->select($sql);
			return $request;

		}

		public function selectProductos()
		{
			
			//EXTRAE ROLES
			$sql = "SELECT * FROM producto WHERE estado != 0 and estado !=2";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectProductod(string $iddetalle)
		{
			$sql = "SELECT * FROM producto WHERE idproducto = '$iddetalle'";
			$request = $this->select_all($sql);
			return $request;
		}




		public function date()
		{

			$sql = "select CURRENT_DATE";
			$request = $this->select($sql);
			return $request;
		}




		public function insertarVentaN(string $monto,int $estado, string $cliente, int $usuario, string $subtotal, string $iva, int $tipocliente){

			

			
            $dia = date("d");
			$mes = date("m");
			$anio = date("Y");

		
			
			$query_insert  = "INSERT INTO venta(dia,mes,anio,monto,estado,idclientenat,idusuario, subtotal, iva, tipocliente) VALUES(?,?,?,?,?,?,?,?,?, ?)";
        	$arrData = array($dia,$mes,$anio,$monto,$estado,$cliente,$usuario,$subtotal, $iva, $tipocliente);
        	$request_insert = $this->insert($query_insert,$arrData);
        	$return = $request_insert;
		



			return $return;
		}

		public function insertarVentaJ(string $monto,int $estado, string $cliente, int $usuario, string $subtotal, string $iva, int $tipocliente){

			

			
            $dia = date("d");
			$mes = date("m");
			$anio = date("Y");

		
			
			$query_insert  = "INSERT INTO venta(dia,mes,anio,monto,estado,idclientejuridico,idusuario, subtotal, iva, tipocliente) VALUES(?,?,?,?,?,?,?,?,?, ?)";
        	$arrData = array($dia,$mes,$anio,$monto,$estado,$cliente,$usuario,$subtotal, $iva, $tipocliente);
        	$request_insert = $this->insert($query_insert,$arrData);
        	$return = $request_insert;
		



			return $return;
		}	


		public function insertDetalle(int $idventa,int $idproducto,int $cantidad, float $total, float $formapago){

			$return = "";


				$query_insert  = "INSERT INTO detalleventa(idventa,idproducto,cantidad, total, formapago) VALUES(?,?,?,?,?)";
	        	$arrData = array($idventa, $idproducto,$cantidad, $total, $formapago);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;


			return $return;
		}	


		public function insertDetalleCredito(int $idventa,int $idproducto,int $cantidad, float $total, float $formapago, float $cuota, float $credito, int $meses){

			$return = "";


				$query_insert  = "INSERT INTO detalleventa(idventa,idproducto,cantidad, total, formapago, cuota, meses) VALUES(?,?,?,?,?,?,?, ?)";
	        	$arrData = array($idventa, $idproducto,$cantidad, $total, $formapago, $cuota, $meses);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;


			return $return;
		}	


		public function insertDetalleCreditoPagoCuota(int $iddetalle, $total){

			$return = "";


				$query_insert  = "INSERT INTO pagocuota(iddetalle, mes, fecha, fechapago, cuota, capital, intereses, abonocapital, totalabono, saldofinal) VALUES(?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($iddetalle, 0, "0000-00-00", "0000-00-00", 0, 0, 0, 0, 0, $total);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;


			return $return;
		}	



		public function actualizarstock(int $idproducto,int $nuevacantidad){


				$sql = "UPDATE producto SET stock = ? WHERE idproducto = $idproducto ";
				$arrData = array($nuevacantidad);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}

	
	}
 ?>