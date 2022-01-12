<?php 

	class ActivoFijoModel extends Mysql
	{
	
		public	$intId;


		public function __construct()
		{
			parent::__construct();
		}

		public function selectactivos()
		{
	
			//SELECCIONAR EmpleadoES
			$sql = "SELECT * FROM activo_fijo";
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectdetalles(string $id){
			//BUSCAR 
			$this->intId = $id;
			$sql = "SELECT a.codigo, a.nombre,a.fecha_adquisicion,a.img,a.costo,b.codigo_correlativo,b.decripcion,b.vida_util,b.estado FROM activo_fijo a INNER JOIN activofijo_bienes b on a.codigo=b.id_activofijo WHERE a.codigo='$id'";
			 
			$request = $this->select_all($sql);
			return $request;
		}


	}
 ?>