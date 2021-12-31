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




		public function insertarVenta(string $monto,int $estado, int $cliente, int $usuario, string $subtotal, string $iva){

			

			
            $dia = date("d");
			$mes = date("m");
			$anio = date("Y");

		
			
			$query_insert  = "INSERT INTO venta(dia,mes,anio,monto,estado,idcliente,idusuario, subtotal, iva) VALUES(?,?,?,?,?,?,?,?,?)";
        	$arrData = array($dia,$mes,$anio,$monto,$estado,$cliente,$usuario,$subtotal, $iva);
        	$request_insert = $this->insert($query_insert,$arrData);
        	$return = $request_insert;
		



			return $return;
		}	


		public function insertDetalle(int $idventa,int $idproducto,int $cantidad){

			$return = "";


				$query_insert  = "INSERT INTO detalleventa(idventa,idproducto,cantidad) VALUES(?,?,?)";
	        	$arrData = array($idventa, $idproducto,$cantidad);
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