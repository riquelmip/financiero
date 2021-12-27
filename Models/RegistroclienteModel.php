<?php 

	class RegistroclienteModel extends Mysql
	{
		public $intcodigo_cliente_natural;
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
			$sql = "SELECT c.codigo_cliente_natural, c.dui, CONCAT(c.nombre,' ',c.apellido) as `nombre`,c.telefono FROM cliente as c WHERE estado = 1";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCliente(int $codigo_cliente_natural)
		{
			//BUSCAR CLIENTE
			$this->intcodigo_cliente_natural = $codigo_cliente_natural;
			$sql = "SELECT * FROM cliente WHERE codigo_cliente_natural = $this->intcodigo_cliente_natural";
			$request = $this->select($sql);
			return $request;
		}

		public function setCodigoPN(){


			$sql = "SELECT codigo_persona_natural from tbl_persona_natural ORDER BY codigo_persona_natural DESC LIMIT 1";
			$request = $this->select_all($sql);

			if(empty($request))
			{
	        	$return = "PN001";
			}else{
				
				$valor = ($request[0]['codigo_persona_natural']);
				$valorsinletras = explode('-',$valor);
				$valor2 = intval($valorsinletras[1])+1;
				$return = $valor2;
			}
			return $return;
		}	

		public function insertCliente(string $intcodigo_cliente_natural, string $nombre, string $apellido, string $strDireccion, string $strTelefono, string $strDui, string $strEstadocivil, string $strLugartrabajo, string $stringreso, string $strEgresos ){


			//$sql = "SELECT * FROM cliente WHERE dui = '{$this->strDui}'";
		//	$request = $this->select_all($sql);

		//	if(empty($request))
	//		{
				$query_insert  = "INSERT INTO tbl_persona_natural(codigo_persona_natural,nombre_persona_natural,apellido_persona_natural,direccion_persona_natural,telefono_persona_natural,dui_persona_natural,estado_civil_persona_natural,lugar_trabajo_persona_natural,ingreso_persona_natural,egresos_persona_natural) VALUES(?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($intcodigo_cliente_natural,$nombre,$apellido,$strDireccion,$strTelefono,$strDui,$strEstadocivil,$strLugartrabajo,$stringreso,$strEgresos);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
		//	}else{
				$return = "exist";
	//		}
			return $return;
		}	


		public function updateCliente(int $codigo_cliente_natural, string $dui, string $nombre, string $apellido,string $telefono, int $estado){
			$this->intcodigo_cliente_natural = $codigo_cliente_natural;
			$this->strDui = $dui;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->strTelefono = $telefono;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM cliente WHERE dui = '{$this->strDui}' and codigo_cliente_natural!=$this->intcodigo_cliente_natural";
			$request = $this->select_all($sql);

			if(empty($request)){
				$sql = "UPDATE cliente SET dui = ?, nombre = ?, apellido = ?,telefono = ?, estado = ? WHERE codigo_cliente_natural = $this->intcodigo_cliente_natural ";
				$arrData = array($this->strDui,$this->strNombre,$this->strApellido,$this->strTelefono,$this->intEstado);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCliente(int $codigo_cliente_natural){
			
			$this->intcodigo_cliente_natural = $codigo_cliente_natural;

			$sql = "SELECT * FROM venta WHERE codigo_cliente_natural = $this->intcodigo_cliente_natural";
			$request = $this->select_all($sql);

			if(empty($request)){

				$sql = "UPDATE cliente SET estado = ? WHERE codigo_cliente_natural = $this->intcodigo_cliente_natural ";
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