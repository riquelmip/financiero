<?php 

	class ComprasModel extends Mysql
	{
		public $intId;
		public $strNombre;
		private $intIdCadena;
		public function __construct()
		{
			parent::__construct();
		}

		public function selectCompras() 
		{

			$sql = "SELECT c.idcompra,c.dia,c.mes,c.anio,c.credito,c.estado,c.monto,c.fecha_credito FROM compra c";
			$request = $this->select_all($sql);
			return $request;
		}
		

		public function selectCadena(int $idcadena){
			$this->intIdCadena = $idcadena;
			$sql = "SELECT d.iddetalle,d.idcompra,d.idproducto,d.cantidad,d.precioventa,p.nombre FROM detallecompra d inner join compra c on c.idcompra=d.idcompra inner join proveedor p on p.idproveedor=c.idproveedor  WHERE c.idcompra= $idcadena";
			$request = $this->select_all($sql);
			return $request;
		}



	}
 ?>