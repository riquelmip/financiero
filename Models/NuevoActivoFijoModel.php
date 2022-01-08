<?php 

class NuevoActivoFijoModel  extends Mysql{

        public $bandera;
        public $codigo;
        public $nombre;
        public $descripcion;
        public $tipo;
        public $proveedor;
        public $fecha;
        public $garantia;
        public $costo;
        public $cantidad;
        public $estado;

        public function __construct() {
            parent::__construct(); 
        }


            public function getTipo(){
                $sql = "select * from tipo_activofijo";
                $request = $this->select_all($sql);
                return $request; 
            }

            public function getProveedores(){
                $sql = "select * from proveedor";
                $request = $this->select_all($sql);
                return $request; 
            }

            public function insertActivoFijo($codigo,$nombre,$descripcion,$tipo,$proveedor,$fecha,$garantia,$costo,$cantidad,$estado){
               
                $return = "";

                $this->codigo=$codigo;
                $this->nombre=$nombre;
                $this->descripcion=$descripcion;
                $this->tipo=$tipo;
                $this->proveedor=$proveedor;
                $this->fecha=$fecha;
                $this->garantia=$garantia;
                $this->costo=$costo;
                $this->cantidad=$cantidad;
                $this->estado=$estado;

            // $sql = "SELECT * FROM activo_fijo WHERE nombre = '{$this->strDui}' AND descripcion='' AND precio=''";
			// $request = $this->select_all($sql);
            //IF (){}
            $query_insert  = "INSERT INTO activo_fijo (codigo,nombre,tipo_activo,fecha_adquisicion,idproveedor,cantidad ) VALUES ( ?,?,?, ?, ?, ?)";
            $arrData = array(
                $this->codigo,
                $this->nombre,
                $this->tipo,
                $this->fecha,
                $this->proveedor,
                $this->cantidad);
            $request_insert = $this->insert2($query_insert,$arrData);
            $return = $request_insert;
            return $return;
            }

}

?>