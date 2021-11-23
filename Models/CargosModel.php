<?php 

	class CargosModel extends Mysql
	{
		public $intId;
		public $strNombre;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectCargos() //Selecciona todos los cargos existentes
		{

			$sql = "SELECT * FROM cargo";
			$request = $this->select_all($sql);
			return $request;
		}
		

		public function selectCargo(int $idcat) //Selecciona la categoria existente
		{
			$this->intIdc = $idcat;
			$sql = "SELECT * FROM cargo WHERE idcargo = $this->intIdc";
			$request = $this->select($sql);
			return $request;
		}



		public function insertCargo(string $nombre){ //Inserta la categoria nueva a la base de datos
			$return = "";
			$sql = "SELECT * FROM cargo WHERE nombre = '$nombre'";
			$request = $this->select_all($sql);

			if(empty($request)) //hace una comprobacion si la categoria a ingresar ya existe en la base de datos 
			{
				$query_insert  = "INSERT INTO cargo(nombre) VALUES(?)";
	        	$arrData = array($nombre);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}
			else
			{
				$return = "exist";
			}
			return $return;
		}	

		public function updateCargo(int $idcat,string $nombre){ //Actualiza la categoria seleccionada
			$this->intIdcat = $idcat;
			$this->strNombre = $nombre;

			$sql = "SELECT * FROM cargo WHERE nombre = '$this->strNombre'";
			$request = $this->select_all($sql);

			if(empty($request)) //Busca si es el mismo nombre a actualizar
			{
				$sql = "UPDATE cargo SET nombre = ? WHERE idcargo = $this->intIdcat ";
				$arrData = array($this->strNombre);
				$request = $this->update($sql,$arrData);
			}
			else
			{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCargo(int $idcatee) //Elimina la categoria seleccionada buscando que no se encuentre en la tabla conectada a otra
		{
			$this->intIdcat = $idcatee;
			$sql = "Select c.idcargo from cargo c right join empleado e on c.idcargo=e.idcargo  where e.idcargo = $this->intIdcat";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "DELETE FROM cargo WHERE idcargo = $this->intIdcat ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}
	}
 ?>