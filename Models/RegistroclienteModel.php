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
	        	$return = "PN-001";
			}else{
				
				$valor = ($request[0]['codigo_persona_natural']);
				$valorsinletras = explode('-',$valor);
				$valor2 = intval($valorsinletras[1])+1;
				$return = $valor2;
			}
			return $return;
		}	

		public function setCodigoPJ(){


			$sql = "SELECT codigo_persona_juridica from tbl_persona_juridica ORDER BY codigo_persona_juridica DESC LIMIT 1";
			$request = $this->select_all($sql);

			if(empty($request))
			{
	        	$return = "PJ-001";
			}else{
				
				$valor = ($request[0]['codigo_persona_juridica']);
				$valorsinletras = explode('-',$valor);
				$valor2 = intval($valorsinletras[1])+1;
				$return = $valor2;
			}
			return $return;
		}	



		public function insertClienteNatural(string $intcodigo_cliente_natural, string $nombre, string $apellido, string $strDireccion, string $strTelefono, string $strDui, string $strEstadocivil, string $strLugartrabajo, string $stringreso, string $strEgresos, string $url){

			$letraD = "D";
		$sql = "SELECT * FROM tbl_persona_natural WHERE codigo_persona_natural = '{$this->intcodigo_cliente_natural}'";
			$request = $this->select_all($sql);

			if(empty($request))
		{
				$query_insert  = "INSERT INTO tbl_persona_natural(codigo_persona_natural,nombre_persona_natural,apellido_persona_natural,direccion_persona_natural,telefono_persona_natural,dui_persona_natural,estado_civil_persona_natural,lugar_trabajo_persona_natural,ingreso_persona_natural,egresos_persona_natural,id_boleta_de_pago__persona_natural,categoria) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($intcodigo_cliente_natural,$nombre,$apellido,$strDireccion,$strTelefono,$strDui,$strEstadocivil,$strLugartrabajo,$stringreso,$strEgresos,$url,$letraD);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = true;
			}else{
				$return = "exist";
			}
			return $return;
		}	


		public function insertClienteJuridico(string $intcodigo_cliente_natural, string $nombre, string $strTelefono, string $strDireccion, string $stringreso, string $strEgresos ){


			$sql = "SELECT * FROM tbl_persona_juridica WHERE codigo_persona_juridica = '{$this->intcodigo_cliente_natural}'";
			$request = $this->select_all($sql);
			$letrad = "D";
			if(empty($request))
		{
				$query_insert  = "INSERT INTO tbl_persona_juridica(codigo_persona_juridica,nombre_empresa_persona_juridica,direccion_persona_juridica,idtelefono_persona_juridica,idbalancegeneral_persona_juridica,idestadoresultado_persona_juridica,categoria) VALUES(?,?,?,?,?,?,?)";
	        	$arrData = array($intcodigo_cliente_natural,$nombre,$strDireccion,$strTelefono,$stringreso,$strEgresos,$letrad);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = true;
		}else{
				$return = "exist";
			}
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
