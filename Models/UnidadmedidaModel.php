<?php 

	class UnidadmedidaModel extends Mysql
	{
		public $intId;
		public $strNombre;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectUnidades()
		{
	
			
			$sql = "SELECT * FROM unidadmedida";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectUnidadid(int $intId)
		{
			//BUSCAR 
			$this->intId = $intId;
			$sql = "SELECT * FROM unidadmedida WHERE idunidad = $this->intId";
			$request = $this->select($sql);
			return $request;
		}

		public function insertunidad(string $nombre){

			$return = "";
			$this->strNombre = $nombre;
		

			$sql = "SELECT * FROM unidadmedida WHERE nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO unidadmedida(nombre) VALUES(?)";

	        	$arrData = array($this->strNombre);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

				//ACTUALIZAR
		public function updateunidad(int $id, string $nombre){
			$this->intId= $id;
			$this->strNombre = $nombre;
		

			$sql = "SELECT * FROM unidadmedida WHERE nombre = '$this->strNombre'  AND idunidad != $this->intId";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE unidadmedida SET nombre = ? WHERE idunidad = $this->intId";
				$arrData = array($this->strNombre);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

			//ELIMINAR
		public function deleteunidad(int $id)
		{
			$this->intId = $id;
			$sql = "SELECT * FROM producto WHERE idunidadmedida = $this->intId";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "DELETE FROM unidadmedida WHERE idunidad = $this->intId";
				// $arrData = array(0);
				// $request = $this->update($sql,$arrData);
				$request = $this->delete($sql);

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