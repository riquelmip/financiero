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
		public $estado;
		public $mora;


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

		public function selectTotalCreditos(){

			$sql = "SELECT d.iddetalle,
					p.descripcion,
					c.codigo_persona_natural as dui,
					CONCAT(c.nombre_persona_natural,' ',c.apellido_persona_natural) as nombreCliente,
					CONCAT(v.dia,'-',v.mes,'-',v.anio) as fecha_inicio,
					d.total,
					d.estadopago
					FROM detalleventa d 
					INNER JOIN venta v on v.idventa = d.idventa
					INNER JOIN producto p on p.idproducto = d.idproducto
					INNER JOIN tbl_persona_natural c on c.codigo_persona_natural = v.idclientenat
					WHERE d.formapago = 2 and v.tipocliente=1";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCreditosIncobrables(){

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
					WHERE d.formapago = 2 and d.estadopago=2 and v.tipocliente=1";
			$request = $this->select_all($sql);
			return $request;
		}


		public function datoembargodetalle(int $dato){

			$sql = "SELECT dv.estado_embargo from detalleventa dv WHERE iddetalle = $dato";
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

		public function selectTotalCreditosDos(){

			$sql = "SELECT d.iddetalle,
					p.descripcion,
					c.codigo_persona_juridica as dui,
					c.nombre_empresa_persona_juridica as nombreCliente,
					CONCAT(v.dia,'-',v.mes,'-',v.anio) as fecha_inicio,
					d.total,
					d.estadopago
					FROM detalleventa d 
					INNER JOIN venta v on v.idventa = d.idventa
					INNER JOIN producto p on p.idproducto = d.idproducto
					INNER JOIN tbl_persona_juridica c on c.codigo_persona_juridica = v.idclientejuridico
					WHERE d.formapago = 2 and v.tipocliente=2";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCreditosDosIncobrables(){

			$sql = "SELECT d.iddetalle,
					p.descripcion,
					c.codigo_persona_juridica as dui,
					c.nombre_empresa_persona_juridica as nombreCliente,
					CONCAT(v.dia,'-',v.mes,'-',v.anio) as fecha_inicio,
					d.total,
					d.meses,
					d.estado_embargo
					FROM detalleventa d 
					INNER JOIN venta v on v.idventa = d.idventa
					INNER JOIN producto p on p.idproducto = d.idproducto
					INNER JOIN tbl_persona_juridica c on c.codigo_persona_juridica = v.idclientejuridico
					WHERE d.formapago = 2 and d.estadopago=2 and v.tipocliente=2";
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
				pg.mes as mesPago,
				v.anio,
				d.total as totalCredito,
				d.cuota,
				ct.tasainteres as tasa,
				pg.saldofinal,
				d.meses,
				pg.mora
				FROM venta v
				INNER JOIN detalleventa d on d.idventa = v.idventa
				INNER JOIN producto p on p.idproducto = d.idproducto
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN pagocuota pg on pg.iddetalle = d.iddetalle
				WHERE d.formapago = 2 and pg.iddetalle = $this->Intiddetalle and pg.estado = 0 and d.estadopago = 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCreditoPagar(int $iddetalle,int $mes) //Selecciona la categoria existente
		{
			$this->Intiddetalle = $iddetalle;
			$sql = "SELECT d.iddetalle,
				p.descripcion,
				v.dia,
				v.mes as mesinicio,
				pg.mes as mesPago,
				v.anio,
				d.total as totalCredito,
				d.cuota,
				ct.tasainteres as tasa,
				pg.saldofinal,
				d.meses,
				pg.mora
				FROM venta v
				INNER JOIN detalleventa d on d.idventa = v.idventa
				INNER JOIN producto p on p.idproducto = d.idproducto
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN pagocuota pg on pg.iddetalle = d.iddetalle
				WHERE d.formapago = 2 and pg.iddetalle = $iddetalle and pg.mes = $mes and pg.estado = 0 and d.estadopago = 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectUltimaCuota(int $iddetalle) //Selecciona la categoria existente
		{
			$this->Intiddetalle = $iddetalle;

			$sql = "SELECT d.iddetalle,
				p.descripcion,
				v.dia,
				MONTH(pg.fecha) as mesinicio,
				pg.mes as mesPago,
				v.anio,
				d.total as totalCredito,
				d.cuota,
				ct.tasainteres as tasa,
				pg.saldofinal,
				d.meses,
				pg.mora
				FROM venta v
				INNER JOIN detalleventa d on d.idventa = v.idventa
				INNER JOIN producto p on p.idproducto = d.idproducto
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN pagocuota pg on pg.iddetalle = d.iddetalle
				WHERE d.formapago = 2 and pg.iddetalle = $this->Intiddetalle ORDER BY pg.idpagocuota DESC LIMIT 1";
			$request = $this->select($sql);
			return $request;
		}

		public function selectPagos(int $iddetalle,int $estado) //Selecciona la categoria existente
		{
			$this->Intiddetalle = $iddetalle;
			$this->estado = $estado;

			$sql = "SELECT
				pg.mes,
				pg.fecha,
				pg.fechapago,
				pg.cuota,
				pg.capital,
				pg.intereses,
				pg.mora,
				pg.abonocapital,
				pg.totalabono,
				pg.saldofinal,
				pg.estado
				FROM pagocuota pg
				INNER JOIN detalleventa d on d.iddetalle = pg.iddetalle
				WHERE d.iddetalle = $this->Intiddetalle";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectTotalPagos(int $iddetalle) //Selecciona la categoria existente
		{
			$this->Intiddetalle = $iddetalle;

			$sql = "SELECT d.iddetalle,
				ROUND(SUM(pg.cuota),2) as cuota,
				ROUND(SUM(pg.capital),2) as capital,
				ROUND(SUM(pg.intereses),2) as intereses,
				ROUND(SUM(pg.mora),2) as mora,
				ROUND(SUM(pg.totalabono),2) as totalabono,
				ROUND(SUM(pg.saldofinal),2) as saldofinal
				FROM pagocuota pg
				INNER JOIN detalleventa d on d.iddetalle = pg.iddetalle
				WHERE d.iddetalle = $this->Intiddetalle and pg.estado = 0 ";
			$request = $this->select_all($sql);
			return $request;
		}


		public function insertPagoCuota($iddetalle,$mes,$fecha,$fechapago,$cuota,$capital,$intereses,$abonoCapital,$totalabono,$saldof,$estado,$mora){

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
			$this->estado = $estado;
			$this->mora = $mora; 

				$query_insert  = "INSERT INTO pagocuota(iddetalle,mes,fecha,fechapago,cuota,capital,intereses,abonocapital,totalabono,saldofinal,estado,mora) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->Intiddetalle,$this->mes,$this->fecha,$this->fechapago,$this->cuota,$this->capital,$this->intereses,$this->abonoCapital,$this->totalabono,$this->saldof,$this->estado,$this->mora = $mora);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			
			return $return;
		}

		public function updateEstadoCredito(int $iddetalle){
			$this->Intiddetalle = $iddetalle;
			$this->estado = 1;
			
				$sql = "UPDATE detalleventa SET estadopago = ? WHERE iddetalle = $this->Intiddetalle";
				$arrData = array($this->estado);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}

		public function updateEstadoPagos(string $fechapago, int $iddetalle,int $mes){
			$this->Intiddetalle = $iddetalle;
			$this->mes = $mes;
			$this->fechapago = $fechapago;
			$this->estado = 1;
			
				$sql = "UPDATE pagocuota SET estado = ?, fechapago = ? WHERE iddetalle = $this->Intiddetalle and mes = $this->mes";
				$arrData = array($this->estado,$this->fechapago);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}

		public function updateEstadoPago(string $fecha, string $fechapago, int $iddetalle,int $mes){
			$this->Intiddetalle = $iddetalle;
			$this->mes = $mes;
			$this->fecha = $fecha;
			$this->fechapago = $fechapago;
			$this->estado = 1;
			
				$sql = "UPDATE pagocuota SET estado = ?, fecha = ?, fechapago = ? WHERE iddetalle = $this->Intiddetalle and mes = $this->mes";
				$arrData = array($this->estado,$this->fecha,$this->fechapago);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}

		public function selectTasa(int $iddetalle){
			$sql = "SELECT
				ct.tasainteres as tasa,
				d.meses
				FROM producto p 
				INNER JOIN categoria ct on ct.idcategoria = p.idcategoria
				INNER JOIN detalleventa d on d.idproducto = p.idproducto
				INNER JOIN venta v on v.idventa = d.idventa
				WHERE d.iddetalle=$iddetalle LIMIT 1";
			$request = $this->select_all($sql);
			return $request;
		}

		public function updateDetalleIncobrable(string $iddetalle){
			$this->Intiddetalle = $iddetalle;
			$this->estado = 0;
			
				$sql = "UPDATE detalleventa SET estadopago = ? WHERE iddetalle = $this->Intiddetalle";
				$arrData = array($this->estado);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}

		public function updateCredito(int $iddetalle){
			$this->Intiddetalle = $iddetalle;
			$this->estado = 1;
			
				$sql = "UPDATE detalleventa SET estadopago = ? WHERE iddetalle = $this->Intiddetalle";
				$arrData = array($this->estado);
				$request = $this->update($sql,$arrData);
			
		    return $request;			
		}		

	}
 ?>