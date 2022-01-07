<?php 

	class CarteraclientesModel extends Mysql
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

		public function selectPersonaNaturalA(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT codigo_persona_natural,CONCAT(nombre_persona_natural,' ',apellido_persona_natural) as nombre_completo,direccion_persona_natural,telefono_persona_natural,dui_persona_natural,estado_civil_persona_natural,lugar_trabajo_persona_natural,ingreso_persona_natural,egresos_persona_natural,id_boleta_de_pago__persona_natural,categoria from tbl_persona_natural where categoria='A'";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectPersonaJuridicaA(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT * from tbl_persona_juridica where categoria='A'";
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