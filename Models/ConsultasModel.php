<?php 

	class ConsultasModel extends Mysql
	{


		public function __construct()
		{
			parent::__construct();
		}

		


		public function selectVentaCN(int $idventa) 
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
					v.idclientenat,
					dv.iddetalle,
					dv.cantidad,
					dv.formapago,
					dv.total,
					dv.meses,
					dv.credito,
					dv.cuota,
					p.idproducto,
					p.descripcion as producto,
					p.precio,
					p.codigobarra,
					CONCAT(c.nombre_persona_natural,' ',c.apellido_persona_natural)  AS cliente
					FROM detalleventa dv
					INNER JOIN venta v ON v.idventa = dv.idventa
					INNER JOIN producto p ON p.idproducto = dv.idproducto
					INNER JOIN tbl_persona_natural c ON v.idclientenat = c.codigo_persona_natural
					WHERE V.idventa = $idventa";
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectVentaCJ(int $idventa) 
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
					v.idclientenat,
					dv.iddetalle,
					dv.cantidad,
					dv.formapago,
					dv.total,
					dv.meses,
					dv.credito,
					dv.cuota,
					p.idproducto,
					p.descripcion as producto,
					p.precio,
					p.codigobarra,
					c.nombre_empresa_persona_juridica  AS cliente
					FROM detalleventa dv
					INNER JOIN venta v ON v.idventa = dv.idventa
					INNER JOIN producto p ON p.idproducto = dv.idproducto
					INNER JOIN tbl_persona_juridica c ON v.idclientejuridico = c.codigo_persona_juridica
					WHERE V.idventa = $idventa";
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
					v.idclientenat,
					v.idclientejuridico
					FROM venta v
					WHERE V.idventa = $idventa";
			$request = $this->select($sql);
			return $request;
		}

		
			public function productomenosvendido()
		{

			$sql = "SELECT c.nombre,v.idcliente,SUM(v.monto) AS monto from venta v inner join cliente c on c.idcliente=v.idcliente GROUP BY v.idcliente order by SUM(v.monto) asc LIMIT 10";
			$request = $this->select_all($sql);
			return $request;
		}

			public function clientesmascompras()
		{

			$sql = "SELECT c.nombre,c.apellido,v.idcliente,SUM(v.monto) AS monto from venta v inner join cliente c on c.idcliente=v.idcliente GROUP BY v.idcliente order by SUM(v.monto) desc LIMIT 10";
			$request = $this->select_all($sql);
			return $request;
		}

			public function clientesmenoscompras()
		{

			$sql = "SELECT c.nombre,c.apellido,v.idcliente,SUM(v.monto) AS monto from venta v inner join cliente c on c.idcliente=v.idcliente GROUP BY v.idcliente order by SUM(v.monto) asc LIMIT 10";
			$request = $this->select_all($sql);
			return $request;
		}

			public function empleadosconmasventas()
		{

			$sql = "SELECT u.idempleado,e.nombre,e.apellido,v.idusuario,SUM(v.monto) AS monto from venta v inner join usuario u on u.idusuario=v.idusuario inner join empleado e on e.idempleado=u.idempleado GROUP BY v.idcliente order by SUM(v.monto) desc LIMIT 10";
			$request = $this->select_all($sql);
			return $request;
		}

			public function empleadosconmenosventas()
		{

			$sql = "SELECT u.idempleado,e.nombre,e.apellido,v.idusuario,SUM(v.monto) AS monto from venta v inner join usuario u on u.idusuario=v.idusuario inner join empleado e on e.idempleado=u.idempleado GROUP BY v.idcliente order by SUM(v.monto) asc LIMIT 10";
			$request = $this->select_all($sql);
			return $request;
		}		
	}
 ?>