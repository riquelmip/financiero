<?php 

class NuevoActivoFijoModel  extends Mysql{

        public $bandera;
        public $codigo;
        public $correlativo;
        public $nombre;
        public $descripcion;
        public $tipo;
        public $proveedor;
        public $fecha;
        public $garantia;
        public $costo;
        public $cantidad;
        public $estado;
        public $vida;

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

            public function foundnumber($var){
                $sql = "select count(a.tipo_activo) as num from tipo_activofijo t
                LEFT JOIN  activo_fijo a  on t.idtipoactivo=a.tipo_activo 
               where a.tipo_activo=".$var;
                $request = $this->select_all($sql);
                return $request; 
            }

            public function codetipo($var){
                $sql = "select t.codigo from tipo_activofijo t  where t.idtipoactivo=".$var;
                $request = $this->select_all($sql);
                return $request; 
            }

            public function insertDetalle($correlativo,$codigo,$descripcion,$estado,$vida){
                
                $return="";
                $this->codigo=$codigo;
                $this->correlativo=$correlativo;
                $this->descripcion=$descripcion;
                $this->vida=$vida;
                $this->estado=$estado;

                $query_insert  = "INSERT INTO activofijo_bienes (codigo_correlativo,id_activofijo,decripcion,estado,vida_util) VALUES ( ?,?,?,?,?)";
                $arrData = array(
                    $this->correlativo,
                    $this->codigo,
                    $this->descripcion,
                    $this->estado,
                    $this->vida);
                $request_insert = $this->insert2($query_insert,$arrData);
                $return = $request_insert;
                return $return;
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
            $query_insert  = "INSERT INTO activo_fijo (codigo,nombre,tipo_activo,fecha_adquisicion,idproveedor,cantidad,costo ) VALUES ( ?,?,?, ?, ?,?,?)";
            $arrData = array(
                $this->codigo,
                $this->nombre,
                $this->tipo,
                $this->fecha,
                $this->proveedor,
                $this->cantidad,
                $this->costo);
            $request_insert = $this->insert2($query_insert,$arrData);
            $return = $request_insert;
            return $return;
            }

}

?>