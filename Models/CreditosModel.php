<?php 

	class CreditosModel extends Mysql
	{
		public $Intiddetalle;
		public $mes;
		public $fecha;
		public $fechapago;
		public $cuota;
		public $capital;
		public $intereses;
		public $abonoCapital;
		public $totalabono;
		public $saldof;


		public function __construct()
		{
			parent::__construct();
		}

		public function selectCreditos(){

			$sql = "SELECT d.iddetalle,
					p.descripcion,
					c.codigo_persona_natural as dui,
					CONCAT(c.nombre_persona_natural,' ',c.apellido_persona_natural) as nombreCliente,
					CONCAT(v.dia,'-',v.mes,'-',v.anio) as fecha_inicio,
					d.total,
					d.meses
					FROM detalleventa d 
					INNER JOIN venta v on v.idventa = d.idventa
					INNER JOIN producto p on p.idproducto = d.idproducto
					INNER JOIN tbl_persona_natural c on c.codigo_persona_natural = v.idclientenat
					WHERE d.formapago = 2 and d.estadopago=0 and v.tipocliente=1";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCreditosDos(){

			$sql = "SELECT d.iddetalle,
					p.descripcion,
					c.codigo_persona_juridica as dui,
					c.nombre_empresa_persona_juridica as nombreCliente,
					CONCAT(v.dia,'-',v.mes,'-',v.anio) as fecha_inicio,
					d.total,
					d.meses
					FROM detalleventa d 
					INNER JOIN venta v on v.idventa = d.idventa
					INNER JOIN producto p on p.idproducto = d.idproducto
					INNER JOIN tbl_persona_juridica c on c.codigo_persona_juridica = v.idclientejuridico
					WHERE d.formapago = 2 and d.estadopago=0 and v.tipocliente=2";
			$request = $this->select_all($sql);
			return $request;
		}
		

		public function selectCredito(int $iddetalle) //Selecciona la categoria existente
		{
			$this->Intiddetalle = $iddetalle;
			$sql = "SELECT d.iddetalle,
				p.descripcion,
				v.dia,
				v.mes as mesinicio,
				pg.mes+1 as mesPago,
				v.anio,
				d.total as totalCredito,
				d.cuota,
				ct.tasainteres as tasa,
				pg.saldofinal,
				d.meses
				FROM venta v
				INNER JOIN detalleventa d on d.idventa = v.idventa
				INNER JOIN producto p on p.idproducto = d.idproducto
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN pagocuota pg on pg.iddetalle = d.iddetalle
				WHERE d.formapago = 2 and pg.iddetalle = $iddetalle
					ORDER BY pg.idpagocuota DESC LIMIT 1";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPagoCuota($iddetalle,$mes,$fecha,$fechapago,$cuota,$capital,$intereses,$abonoCapital,$totalabono,$saldof){

			$return = "";
			$this->Intiddetalle = $iddetalle;
			$this->mes = $mes;
			$this->fecha = $fecha;
			$this->fechapago = $fechapago;
			$this->cuota = $cuota;
			$this->capital = $capital;
			$this->intereses = $intereses; 
			$this->abonoCapital = $abonoCapital;
			$this->totalabono = $totalabono;
			$this->saldof = $saldof; 


				$query_insert  = "INSERT INTO pagocuota(iddetalle,mes,fecha,fechapago,cuota,capital,intereses,abonocapital,totalabono,saldofinal) VALUES(?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->Intiddetalle,$this->mes,$this->fecha,$this->fechapago,$this->cuota,$this->capital,$this->intereses,$this->abonoCapital,$this->totalabono,$this->saldof);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			
			return $return;
		}

		public function updateEstadoCredito(int $iddetalle){
			$this->Intiddetalle = $iddetalle;
			$estado = 1;
			
				$sql = "UPDATE detalleventa SET estadopago = ? WHERE iddetalle = $this->Intiddetalle";
				$arrData = array($estado);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}	

	}
 ?>