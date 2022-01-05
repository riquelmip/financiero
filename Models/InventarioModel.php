<?php 

	class InventarioModel extends Mysql
	{

		public function __construct()
		{
			parent::__construct();
		}

		public function selectInventario(){
			
			$sql = "SELECT p.idproducto,
					p.codigobarra,
					p.descripcion,
					m.nombre as marca,
					c.nombre as `categoria`, 
					p.stock,
					u.nombre as `unidad`
					FROM producto p 
					INNER JOIN unidadmedida u on u.idunidad=p.idunidadmedida
					INNER JOIN categoria c on c.idcategoria= p.idcategoria
					INNER JOIN marca m on m.idmarca= p.idmarca
					WHERE p.estado!=0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectEntradas(){
			
			$sql = "SELECT CONCAT(c.dia,'/',c.mes,'/',c.anio) as fecha,
					p.codigobarra,
					p.descripcion,
					m.nombre as marca,
					ca.nombre as `categoria`, 
					d.cantidad,
					d.preciocompra,
					c.monto
					FROM producto p 
					INNER JOIN unidadmedida u on u.idunidad=p.idunidadmedida
					INNER JOIN categoria ca on ca.idcategoria= p.idcategoria
					INNER JOIN marca m on m.idmarca= p.idmarca
					INNER JOIN detallecompra d on d.idproducto = p.idproducto
					INNER JOIN compra c on c.idcompra=d.idcompra";
			$request = $this->select_all($sql);
			return $request;
		}
        
        public function selectSalidas(){
			
			$sql = "SELECT CONCAT(v.dia,'-',v.mes,'-',v.anio) as fecha,
					p.codigobarra,
					p.descripcion,
					m.nombre as marca,
					ca.nombre as `categoria`, 
					d.cantidad,
					v.monto
					FROM producto p 
					INNER JOIN unidadmedida u on u.idunidad=p.idunidadmedida
					INNER JOIN categoria ca on ca.idcategoria= p.idcategoria
					INNER JOIN marca m on m.idmarca= p.idmarca
					INNER JOIN detalleventa d on d.idproducto = p.idproducto
					INNER JOIN venta v on v.idventa=d.idventa";
			$request = $this->select_all($sql);
			return $request;
		}
	}
 ?>