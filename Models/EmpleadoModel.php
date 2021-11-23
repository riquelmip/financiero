<?php 

	class EmpleadoModel extends Mysql
	{
	
		public	$intIdEmpleado;
		public	$strDui ;
		public	$strNit ;
		public	$strNombre  ;
		public	$strApellido ;
		public	$strDireccion ;
		public	$telefono;
		public	$dia;
		public	$mes;
		public	$anio ;
		public	$intestado;
		public	$intCargo ;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectEmpleados()
		{
	
			//SELECCIONAR EmpleadoES
			$sql = "SELECT e.idempleado, e.dui, e.nombre, e.apellido, e.nit, e.direccion, e.telefono, e.dia, e.mes,e.anio, e.estado, e.idcargo, c.nombre as nombrecargo FROM empleado e INNER JOIN cargo c on c.idcargo=e.idcargo WHERE e.estado!=2";
			$request = $this->select_all($sql);
			return $request;
		}
		//para el combito :3
		public function selectCargos()
		{

			$sql = "SELECT * FROM cargo ";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectempleadoid(int $idEmpleado)
		{
			//BUSCAR 
			$this->intIdEmpleado = $idEmpleado;
			$sql = "SELECT e.idempleado, e.dui, e.nombre, e.apellido, e.nit, e.direccion, e.telefono, e.dia, e.mes,e.anio, e.estado, e.idcargo, c.nombre as nombrecargo FROM empleado e INNER JOIN cargo c on c.idcargo=e.idcargo WHERE idempleado = $this->intIdEmpleado";
			$request = $this->select($sql);
			return $request;
		}


		public function insertEmpleado( string $strDui, string $strNit,string $strNombre, string $strApellido, string $strDireccion, string $telefono, int $dia, int $mes, int $anio, int $intestado, int $intCargo){

			$return = "";
			
			$this->strDui=$strDui ;
			$this->strNit=$strNit ;
			$this->strNombre=$strNombre  ;
			$this->strApellido=$strApellido ;
			$this->strDireccion=$strDireccion ;
			$this->telefono=$telefono;
			$this->dia=$dia;
			$this->mes=$mes;
			$this->anio=$anio ;
			$this->intestado=$intestado;
			$this->intCargo=$intCargo ;

			$sql = "SELECT * FROM empleado WHERE dui = '{$this->strDui}'";
			$request = $this->select_all($sql);

			if(empty($request)) //Dui
			{
				$sql = "SELECT * FROM empleado WHERE nit = '{$this->strNit}'";
			$request2 = $this->select_all($sql);

				if(empty($request2))//Nit
			{
				$sql = "SELECT * FROM empleado WHERE telefono = '{$this->telefono}'";
			$request3 = $this->select_all($sql);

				if(empty($request3))//Telefono
				{
				$query_insert  = "INSERT INTO empleado(dui, nombre, apellido, nit, direccion, telefono, dia, mes, anio, estado, idcargo) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

	        	$arrData = array($this->strDui, $this->strNombre, $this ->strApellido, $this->strNit, $this ->strDireccion, $this ->telefono, $this ->dia, $this ->mes, $this ->anio, $this ->intestado, $this ->intCargo);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
	        	}else{
				$return = "exist3";
				}

			}else{
				$return = "exist2";
			}
				
			}else{
				$return = "exist";
			}
			return $return;
		}	

				//ACTUALIZAR
		public function updateEmpleado(int $id,string $strDui, string $strNit,string $strNombre, string $strApellido, string $strDireccion, string $telefono, int $dia, int $mes, int $anio, int $intestado, int $intCargo){
			
			$this->intIdEmpleado=$id ;						
			$this->strDui=$strDui ;
			$this->strNit=$strNit ;
			$this->strNombre=$strNombre  ;
			$this->strApellido=$strApellido ;
			$this->strDireccion=$strDireccion ;
			$this->telefono=$telefono;
			$this->dia=$dia;
			$this->mes=$mes;
			$this->anio=$anio ;
			$this->intestado=$intestado;
			$this->intCargo=$intCargo ;

				$sql = "SELECT * FROM empleado WHERE dui ='$this->strDui' AND idempleado != $this->intIdEmpleado";
			$request = $this->select_all($sql);

			if(empty($request))
			{

			
				$sql = "SELECT * FROM empleado WHERE nit ='$this->strNit' AND idempleado != $this->intIdEmpleado";
			$request2 = $this->select_all($sql);

				if(empty($request2))
			{
			// UPDATE empleado SET dui=?,nombre=?,apellido=?,nit=?,direccion=?,telefono=?,dia=?,mes=?,anio=?,estado=?,idcargo=? WHERE idempleado

			$sql = "UPDATE empleado SET dui=?,nombre=?,apellido=?,nit=?,direccion=?,telefono=?,dia=?,mes=?,anio=?,estado=?,idcargo=? WHERE idempleado = $this->intIdEmpleado ";

			$arrData = array($this->strDui, $this->strNombre, $this ->strApellido, $this->strNit, $this ->strDireccion, $this ->telefono, $this ->dia, $this ->mes, $this ->anio, $this ->intestado, $this ->intCargo);

				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist2";
			}
				
			}else{
				$request = "exist";
			}

		 	   return $request;	
		 }	
	
		

			//ELIMINAR
		public function deleteEmpleado(int $idEmpleado,int $estado)
		{
			$this->intestado= $estado;
			
			$this->intIdEmpleado = $idEmpleado;
			$sql = "SELECT * FROM usuario WHERE idempleado = $this->intIdEmpleado";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE empleado SET estado=? WHERE idempleado = $this->intIdEmpleado ";

					$arrData = array($this->intestado);
				
				 
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