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

		public function insertCargo(string $nombre, string $variablepdf, int $detalleventa,int $embargoendetalle){ //Inserta la categoria nueva a la base de datos
			$return = "";
			$this->strDui = $nombre;
			$this->strNombre = $variablepdf;
			$this->detalleventa = $detalleventa;
			if ($embargoendetalle==0) {
				$embargoendetalle = 1;
				$this->embargoendetalle = $embargoendetalle;
			} else {
				$embargoendetalle = 0;
				$this->embargoendetalle = $embargoendetalle;
			}



			$valor = $nombre;
			$valorsinletras = explode('-',$valor);
			$valor2 = $valorsinletras[0];

			$query_insert  = "UPDATE detalleventa set estado_embargo = ? WHERE iddetalle = $this->detalleventa";
			$arrData = array($this->embargoendetalle);
			$request_insert = $this->update($query_insert,$arrData);



			if ($valor2=="PN") {
				$query_insert  = "INSERT INTO tbl_embargo(pdf_embargo,persona_pn) VALUES(?,?)";
	        	$arrData = array($this->strNombre,$this->strDui);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			} else {
				$query_insert  = "INSERT INTO tbl_embargo(pdf_embargo,persona_pj) VALUES(?,?)";
	        	$arrData = array($this->strNombre,$this->strDui);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}
			


			return $return;
		}	


		public function insertarfiador($nombrefiador,$direccionfiador,$duifiador,$telefonofiador,$variable,$codigo){ //Inserta la categoria nueva a la base de datos
			$return = "";
			$this->nombrefiador = $nombrefiador;
			$this->direccionfiador = $direccionfiador;
			$this->duifiador = $duifiador;
			$this->telefonofiador = $telefonofiador;
			$this->variable = $variable;
			$this->codigo = $codigo;



			$valor = $codigo;
			$valorsinletras = explode('-',$valor);
			$valor2 = $valorsinletras[0];

			if ($valor2=="PN") {
				$query_insert  = "INSERT INTO tbl_fiador(nombre_fiador,direccion_fiador,dui_fiador,telefono_fiador,boleta_de_pago,persona_natural) VALUES(?,?,?,?,?,?)";
	        	$arrData = array($this->nombrefiador,$this->direccionfiador,$this->duifiador ,$this->telefonofiador,$this->variable,$this->codigo);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			} else {
				$query_insert  = "INSERT INTO tbl_fiador(nombre_fiador,direccion_fiador,dui_fiador,telefono_fiador,boleta_de_pago,persona_juridica) VALUES(?,?,?,?,?,?)";
	        	$arrData = array($this->nombrefiador,$this->direccionfiador,$this->duifiador ,$this->telefonofiador,$this->variable,$this->codigo);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}
			


			return $return;
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
        

		public function deleteEmpleado(string $idEmpleado,int $estado)
		{
			$valor = $idEmpleado;
			$valorsinletras = explode('-',$valor);
			$valor2 = $valorsinletras[0];
			if ($valor2=="PN") {
				$this->intestado= $estado;
			if ($this->intestado==0) {
				$this->intestado = 1;
			} else {
				$this->intestado = 0;
			}
			
			$this->intIdEmpleado = $idEmpleado;


				$sql = "UPDATE tbl_persona_natural SET incobrable_persona_natural=? WHERE codigo_persona_natural = '$this->intIdEmpleado' ";

					$arrData = array($this->intestado);
				
				 
				 $request = $this->update($sql,$arrData);

				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}

			return $request;
			} else {
				$this->intestado= $estado;
				if ($this->intestado==0) {
					$this->intestado = 1;
				} else {
					$this->intestado = 0;
				}
				
				$this->intIdEmpleado = $idEmpleado;
	
	
					$sql = "UPDATE tbl_persona_juridica SET incobrable_persona_juridica=? WHERE codigo_persona_juridica = '$this->intIdEmpleado' ";
	
						$arrData = array($this->intestado);
					
					 
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
	}
 ?>