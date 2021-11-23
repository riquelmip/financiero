<?php 

	class ClienteModel extends Mysql
	{
		public $intIdcliente;
		public $strDui;
		public $strNombre;
		public $strApellido;
		public $strCliente;
	    public $intEstado;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectClientes(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT c.idcliente, c.dui, CONCAT(c.nombre,' ',c.apellido) as `nombre`,c.telefono FROM cliente as c WHERE estado = 1";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCliente(int $idcliente)
		{
			//BUSCAR CLIENTE
			$this->intIdcliente = $idcliente;
			$sql = "SELECT * FROM cliente WHERE idcliente = $this->intIdcliente";
			$request = $this->select($sql);
			return $request;
		}

		public function insertCliente(string $dui, string $nombre, string $apellido, string $telefono, int $estado){

			$return = "";
			$this->strDui = $dui;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->strTelefono = $telefono;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM cliente WHERE dui = '{$this->strDui}'";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO cliente(dui,nombre,apellido,estado,telefono) VALUES(?,?,?,?,?)";
	        	$arrData = array($this->strDui,$this->strNombre,$this->strApellido,$this->intEstado,$this->strTelefono);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateCliente(int $idcliente, string $dui, string $nombre, string $apellido,string $telefono, int $estado){
			$this->intIdcliente = $idcliente;
			$this->strDui = $dui;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->strTelefono = $telefono;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM cliente WHERE dui = '{$this->strDui}' and idcliente!=$this->intIdcliente";
			$request = $this->select_all($sql);

			if(empty($request)){
				$sql = "UPDATE cliente SET dui = ?, nombre = ?, apellido = ?,telefono = ?, estado = ? WHERE idcliente = $this->intIdcliente ";
				$arrData = array($this->strDui,$this->strNombre,$this->strApellido,$this->strTelefono,$this->intEstado);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCliente(int $idcliente){
			
			$this->intIdcliente = $idcliente;

			$sql = "SELECT * FROM venta WHERE idcliente = $this->intIdcliente";
			$request = $this->select_all($sql);

			if(empty($request)){

				$sql = "UPDATE cliente SET estado = ? WHERE idcliente = $this->intIdcliente ";
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