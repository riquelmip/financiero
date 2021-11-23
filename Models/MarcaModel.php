<?php 

	class MarcaModel extends Mysql
	{
		public $intIdmarca;
		public $strMarca;
		public $intmarcaEstado;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectMarcas()
		{
			
			//EXTRAE MARCAS
			$sql = "SELECT * FROM marca WHERE estado != 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectMarcasProd(){
			$sql = "SELECT * FROM marca WHERE estado != 0";
					$request = $this->select_all($sql);
			return $request;
		}	

		public function selectMarca(int $idmarca)
		{
			//BUSCAR MARCA
			$this->intIdmarca = $idmarca;
			$sql = "SELECT * FROM marca WHERE idmarca = $this->intIdmarca";
			$request = $this->select($sql);
			return $request;
		}

		public function insertMarca(string $marca, int $estado){

			$return = "";
			$this->strMarca = $marca;
			$this->intmarcaEstado = $estado;

			$sql = "SELECT * FROM marca WHERE nombre = '{$this->strMarca}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO marca(nombre,estado) VALUES(?,?)";
	        	$arrData = array($this->strMarca, $this->intmarcaEstado);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateMarca(int $idmarca, string $nombre, int $estado){
			$this->intIdmarca = $idmarca;
			$this->strMarca = $nombre;
			$this->intmarcaEstado = $estado;

			$sql = "SELECT * FROM marca WHERE nombre = '$this->strMarca' AND idmarca != $this->intIdmarca";
			$request = $this->select_all($sql);

			if(empty($request)){
				$sql = "UPDATE marca SET nombre = ?, estado = ? WHERE idmarca = $this->intIdmarca ";
				$arrData = array($this->strMarca,$this->intmarcaEstado);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

        public function updateEstadoMarca(int $idmarca, int $estado){

        	$this->intIdmarca = $idmarca;
			$this->intmarcaEstado = $estado;

        	$sql = "SELECT * FROM producto WHERE idmarca = $this->intIdmarca";
			$request = $this->select_all($sql);

			if(empty($request)){
				$sql = "UPDATE marca SET estado = ? WHERE idmarca = $this->intIdmarca ";
				$arrData = array($this->intmarcaEstado);
				$request = $this->update($sql,$arrData);
			}else{
				$request="exist";
			}
			
			return $request;			
		    
		}

	}
 ?>