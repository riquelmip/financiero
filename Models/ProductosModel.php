<?php 

	class ProductosModel extends Mysql
	{
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCodigo;
		private $intCategoriaId;
		private $intMarcaId;
		private $intUnidadId;
		private $intPrecio;
		private $intStock;
		private $intStatus;
		private $strRuta;
		private $strImagen;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectProductos(){
			$sql = "SELECT * FROM producto WHERE estado != 0";
					$request = $this->select_all($sql);
			return $request;
		}	

		public function selectMarca(){
			$sql = "SELECT * FROM marca WHERE estado != 0";
					$request = $this->select_all($sql);
			return $request;
		}	

		public function selectCategorias(){
			$sql = "SELECT * FROM categoria";
					$request = $this->select_all($sql);
			return $request;
		}	

		public function selectUnidadMedida(){
			$sql = "SELECT * FROM unidadmedida";
					$request = $this->select_all($sql);
			return $request;
		}	
		

		public function insertProducto( string $codigo, string $descripcion, int $status, int $marcaid, int $categoriaid, int $unidadid){
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->intMarcaId = $marcaid;
			$this->intUnidadId = $unidadid;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE codigobarra = '{$this->intCodigo}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO producto(codigobarra,
														descripcion,
														estado,
														idmarca,
														idcategoria,
														idunidadmedida) 
								  VALUES(?,?,?,?,?,?)";
	        	$arrData = array($this->intCodigo,
        						$this->strDescripcion,
        						$this->intStatus,
        						$this->intMarcaId,
        						$this->intCategoriaId,
        						$this->intUnidadId);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateProducto(int $idproducto, string $codigo, string $descripcion, int $status, int $marcaid, int $categoriaid, int $unidadid){
			$this->intIdProducto = $idproducto;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->intMarcaId = $marcaid;
			$this->intUnidadId = $unidadid;
			$this->intStatus = $status;

			$return = 0;
			$sql = "SELECT * FROM producto WHERE codigobarra = '{$this->intCodigo}' AND idproducto != $this->intIdProducto ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE producto 
						SET idcategoria=?,
							codigobarra=?,
							descripcion=?,
							stock=?,
							idmarca=?,
							idunidadmedida=?,
							estado=? 
						WHERE idproducto = $this->intIdProducto ";
				$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strDescripcion,
        						$this->intStock,
        						$this->intMarcaId,
        						$this->intUnidadId,
        						$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT
					p.idproducto,
					p.codigobarra,
					p.descripcion,
					p.stock,
					p.idcategoria,
					c.nombre AS categoria,
					p.idmarca,
					m.nombre AS marca,
					p.idunidadmedida,
					u.nombre AS unidadmedida,
					p.estado 
				FROM
					producto p
					INNER JOIN categoria c ON p.idcategoria = c.idcategoria
					INNER JOIN marca m ON p.idmarca = m.idmarca
					INNER JOIN unidadmedida u ON p.idunidadmedida = u.idunidad
					WHERE idproducto = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;

		}

		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoid,img
					FROM imagen
					WHERE productoid = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE productoid = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "UPDATE producto SET estado = ? WHERE idproducto = $this->intIdProducto ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}
 ?>