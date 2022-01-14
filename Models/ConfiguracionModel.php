<?php 

	class ConfiguracionModel extends Mysql
	{
		public $intId;
		public $strNombre;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectCargos() //Selecciona todos los cargos existentes
		{

			$sql = "SELECT * FROM tbl_configuracion";
			$request = $this->select_all($sql);
			return $request;
		}
		

		public function selectCargo(int $idcat) //Selecciona la categoria existente
		{
			$this->intIdc = $idcat;
			$sql = "SELECT * FROM tbl_configuracion WHERE id_configuracion = $this->intIdc";
			$request = $this->select($sql);
			return $request;
		}



		public function insertCargo(string $nombre){ //Inserta la categoria nueva a la base de datos
			$return = "";
			$sql = "SELECT * FROM tbl_configuracion WHERE tiempo_incobrable = '$nombre'";
			$request = $this->select_all($sql);

			if(empty($request)) //hace una comprobacion si la categoria a ingresar ya existe en la base de datos 
			{
				$query_insert  = "INSERT INTO tbl_configuracion(tiempo_incobrable) VALUES(?)";
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

			$sql = "SELECT * FROM tbl_configuracion WHERE tiempo_incobrable = '$this->strNombre'";
			$request = $this->select_all($sql);

			if(empty($request)) //Busca si es el mismo nombre a actualizar
			{
				$sql = "UPDATE tbl_configuracion SET tiempo_incobrable = ? WHERE id_configuracion = $this->intIdcat ";
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


				$sql = "DELETE FROM tbl_configuracion WHERE id_configuracion = $this->intIdcat ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}

			return $request;
		}
	}
 ?>