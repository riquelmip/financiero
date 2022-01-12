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



		public function selectPersonaNaturalA(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT codigo_persona_natural,CONCAT(nombre_persona_natural,' ',apellido_persona_natural) as nombre_completo,direccion_persona_natural,telefono_persona_natural,dui_persona_natural,estado_civil_persona_natural,lugar_trabajo_persona_natural,ingreso_persona_natural,egresos_persona_natural,id_boleta_de_pago__persona_natural,categoria,incobrable_persona_natural from tbl_persona_natural where categoria='A'";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectPersonaJuridicaA(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT * from tbl_persona_juridica where categoria='A'";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectPersonaNaturalB(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT codigo_persona_natural,CONCAT(nombre_persona_natural,' ',apellido_persona_natural) as nombre_completo,direccion_persona_natural,telefono_persona_natural,dui_persona_natural,estado_civil_persona_natural,lugar_trabajo_persona_natural,ingreso_persona_natural,egresos_persona_natural,id_boleta_de_pago__persona_natural,categoria,incobrable_persona_natural from tbl_persona_natural where categoria='B'";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectPersonaJuridicaB(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT * from tbl_persona_juridica where categoria='B'";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectUsuarioNatural($idpersona){
			$b = $idpersona;
			$sql = "SELECT codigo_persona_natural,CONCAT(nombre_persona_natural,' ',apellido_persona_natural) as nombre_completo,direccion_persona_natural,telefono_persona_natural,dui_persona_natural,estado_civil_persona_natural,lugar_trabajo_persona_natural,ingreso_persona_natural,egresos_persona_natural,id_boleta_de_pago__persona_natural,categoria from tbl_persona_natural where codigo_persona_natural='$b'";
			$request = $this->select($sql);
			return $request;
		}

		public function selectUsuarioJuridico($idpersona){
			$b = $idpersona;
			$sql = "SELECT * from tbl_persona_juridica where codigo_persona_juridica='$b'";
			$request = $this->select($sql);
			return $request;
		}

		public function selectPersonaNaturalC(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT codigo_persona_natural,CONCAT(nombre_persona_natural,' ',apellido_persona_natural) as nombre_completo,direccion_persona_natural,telefono_persona_natural,dui_persona_natural,estado_civil_persona_natural,lugar_trabajo_persona_natural,ingreso_persona_natural,egresos_persona_natural,id_boleta_de_pago__persona_natural,categoria,incobrable_persona_natural from tbl_persona_natural where categoria='C'";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectPersonaJuridicaC(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT * from tbl_persona_juridica where categoria='C'";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectPersonaNaturalD(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT codigo_persona_natural,CONCAT(nombre_persona_natural,' ',apellido_persona_natural) as nombre_completo,direccion_persona_natural,telefono_persona_natural,dui_persona_natural,estado_civil_persona_natural,lugar_trabajo_persona_natural,ingreso_persona_natural,egresos_persona_natural,id_boleta_de_pago__persona_natural,categoria,incobrable_persona_natural from tbl_persona_natural where categoria='D'";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectPersonaJuridicaD(){
			
			//EXTRAE CLIENTES
			$sql = "SELECT * from tbl_persona_juridica where categoria='D'";
			$request = $this->select_all($sql);
			return $request;
		}
        
	}
 ?>