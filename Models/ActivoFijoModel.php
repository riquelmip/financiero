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

			public function selectEdit(string $id){
			//BUSCAR 
			$this->intId = $id;
			$sql = "SELECT a.codigo,a.fecha_adquisicion,a.img,a.costo,b.vida_util FROM activo_fijo a INNER JOIN activofijo_bienes b on a.codigo=b.id_activofijo WHERE a.codigo='$id'";
			 
			$request = $this->select($sql);
			return $request;
		}


		public function updateActivos($codigo,$costo,$vida,$fecha)
		{
			$sql = "UPDATE activo_fijo a SET a.fecha_adquisicion=?, a.costo=? where a.codigo=?";
			 
			$request = $this->update($sql,array($fecha,$costo,$codigo));

			if($request>0){	
			$sql = "UPDATE activofijo_bienes b SET b.vida_util=? where b.estado>=?";
			 
			$request = $this->update($sql,array($vida,0));

			}
			return $request;
		}

		public function dataDepreciacion(string $id){
			
			$sql="SELECT a.costo,b.vida_util FROM activo_fijo a INNER JOIN activofijo_bienes b on a.codigo=b.id_activofijo WHERE b.codigo_correlativo='$id'";
			
			$request = $this->select_all($sql);
			return $request;
		}

		public function changeActivoFijo(string $codigo,string $descrip, int $estado){
			
			$sql="UPDATE activofijo_bienes b SET b.estado=? , b.decripcion=? where b.codigo_correlativo=?";
			
			$request = $this->update($sql,array($estado,$descrip,$codigo));
			return $request;

		}

	}
 ?>