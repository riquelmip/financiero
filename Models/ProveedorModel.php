<?php 

	class ProveedorModel extends Mysql
	{
		public $intIdProveedor;
		public $strProveedor;
		public $strDireccion;
		public $intestado;
		public $telefono;
		public $contacto;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectproveedor()
		{
	
			//SELECCIONAR PROVEEDORES
			$sql = "SELECT * FROM proveedor WHERE estado!=2";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectproveedorid(int $idProveedor)
		{
			//BUSCAR 
			$this->intProveedor = $idProveedor;
			$sql = "SELECT * FROM proveedor WHERE idproveedor = $this->intProveedor";
			$request = $this->select($sql);
			return $request;
		}

		public function insertproveedor(string $nombre, string $direccion, int $estado, string $telefono, string $contacto){

			$return = "";
			$this->strProveedor = $nombre;
			$this->strDireccion = $direccion;
			$this->telefono = $telefono;
			$this->intestado = $estado;
			$this->contacto = $contacto;

			$sql = "SELECT * FROM proveedor WHERE nombre = '{$this->strProveedor}'";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO proveedor(nombre,direccion,estado,telefono,contacto_vendedor) VALUES(?,?,?,?,?)";

	        	$arrData = array($this->strProveedor, $this->strDireccion, $this->intestado, $this ->telefono, $this->contacto);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

				//ACTUALIZAR
		public function updateproveedor(int $idproveedor,string $nombre, string $direccion, int $estado, string $telefono, string $contacto){
			$this->intIdProveedor= $idproveedor;
			$this->strProveedor = $nombre;
			$this->strDireccion = $direccion;
			$this->telefono = $telefono;
			$this->intestado = $estado;
			$this->contacto = $contacto;


			$sql = "SELECT * FROM proveedor WHERE nombre = '$this->strProveedor'  AND idproveedor != $this->intIdProveedor";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE proveedor SET nombre = ?, direccion = ?, estado = ?, telefono = ?, contacto_vendedor = ? WHERE idproveedor = $this->intIdProveedor ";
				$arrData = array($this->strProveedor, $this->strDireccion,$this->intestado, $this->telefono,$this->contacto);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

			//ELIMINAR
		public function deleteproveedor(int $idproveedor)
		{
			$this->intIdProveedor = $idproveedor;
			$sql = "SELECT * FROM compra WHERE idproveedor = $this->intIdProveedor";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				//$sql = "DELETE FROM proveedor WHERE idproveedor = $this->intIdProveedor ";
				$sql = "UPDATE proveedor SET estado=?  WHERE idproveedor = $this->intIdProveedor ";
				 $arrData = array(2);
				// $request = $this->update($sql,$arrData);
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