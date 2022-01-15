<?php 

	class VentasModel extends Mysql
	{
		public $intId;
		public $strNombre;
		private $intIdCadena;
		public function __construct()
		{
			parent::__construct();
		}

		public function selectVentasCN() 
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
					v.idclientenat as idcliente,
					CONCAT(c.nombre_persona_natural,' ',c.apellido_persona_natural)  AS cliente
					FROM venta v
					INNER JOIN tbl_persona_natural c ON v.idclientenat = c.codigo_persona_natural";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectVentasCJ() 
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
					v.idclientejuridico as idcliente,
					c.nombre_empresa_persona_juridica  AS cliente
					FROM venta v
					INNER JOIN tbl_persona_juridica c ON v.idclientejuridico = c.codigo_persona_juridica";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectVentascontadoCN() 
		{

			$sql = "SELECT 
					v.idventa,
					dv.iddetalle,
					p.idproducto,
					p.descripcion,
					dv.cantidad,
					dv.formapago,
					dv.total,
					dv.meses,
					v.dia,
					v.mes,
					v.anio,
					v.monto,
					v.estado,
					v.idclientenat,
					CONCAT(c.nombre_persona_natural,' ',c.apellido_persona_natural)  AS cliente
					FROM detalleventa dv
					INNER JOIN venta v ON v.idventa = dv.idventa
					INNER JOIN producto p ON p.idproducto = dv.idproducto
					INNER JOIN tbl_persona_natural c ON v.idclientenat = c.codigo_persona_natural
					WHERE dv.formapago = 1";
			$request = $this->select_all($sql);
			return $request;
		}
		
		public function selectVentascontadoCJ() 
		{

			$sql = "SELECT 
					v.idventa,
					dv.iddetalle,
					p.idproducto,
					p.descripcion,
					dv.cantidad,
					dv.formapago,
					dv.total,
					dv.meses,
					v.dia,
					v.mes,
					v.anio,
					v.monto,
					v.estado,
					v.idclientejuridico,
					c.nombre_empresa_persona_juridica  AS cliente
					FROM detalleventa dv
					INNER JOIN venta v ON v.idventa = dv.idventa
					INNER JOIN producto p ON p.idproducto = dv.idproducto
					INNER JOIN tbl_persona_juridica c ON v.idclientejuridico = c.codigo_persona_juridica
					WHERE dv.formapago = 1";
			$request = $this->select_all($sql);
			return $request;
		}
		

		public function selectCadena(int $idcadena){
			$this->intIdCadena = $idcadena;
			$sql = "SELECT d.iddetalle,d.idcompra,d.idproducto,d.cantidad,d.precioventa,p.nombre FROM detallecompra d inner join compra c on c.idcompra=d.idcompra inner join proveedor p on p.idproveedor=c.idproveedor  WHERE c.idcompra= $idcadena";
			$request = $this->select_all($sql);
			return $request;
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
					WHERE p.idproducto = '$this->intIdProducto'";
			$request = $this->select($sql);
			return $request;

		}
		public function actualizarstock(int $idproducto,int $nuevacantidad){


				$sql = "UPDATE producto SET stock = ? WHERE idproducto = $idproducto ";
				$arrData = array($nuevacantidad);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}

		public function anularVenta(int $idventa){


				$sql = "UPDATE venta SET estado = ? WHERE idventa = $idventa ";
				$arrData = array(2);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}


	}
 ?>