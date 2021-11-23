<?php 

	class CategoriaModel extends Mysql
	{
		public $intId;
		public $strNombre;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectCategorias() //Selecciona todas las categorias existentes
		{

			$sql = "SELECT * FROM categoria";
			$request = $this->select_all($sql);
			return $request;
		}
		

		public function selectCategoria(int $idcat) //Selecciona la categoria existente
		{
			$this->intIdc = $idcat;
			$sql = "SELECT * FROM categoria WHERE idcategoria = $this->intIdc";
			$request = $this->select($sql);
			return $request;
		}



		public function insertCategoria(string $nombre){ //Inserta la categoria nueva a la base de datos
			$return = "";
			$sql = "SELECT * FROM categoria WHERE nombre = '$nombre'";
			$request = $this->select_all($sql);

			if(empty($request)) //hace una comprobacion si la categoria a ingresar ya existe en la base de datos 
			{
				$query_insert  = "INSERT INTO categoria(nombre) VALUES(?)";
	        	$arrData = array($nombre);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}
			else
			{
				$return = "exist";
			}
			return $return;
		}	

		public function updateCategoria(int $idcat,string $nombre){ //Actualiza la categoria seleccionada
			$this->intIdcat = $idcat;
			$this->strNombre = $nombre;

			$sql = "SELECT * FROM categoria WHERE nombre = '$this->strNombre'";
			$request = $this->select_all($sql);

			if(empty($request)) //Busca si es el mismo nombre a actualizar
			{
				$sql = "UPDATE categoria SET nombre = ? WHERE idcategoria = $this->intIdcat ";
				$arrData = array($this->strNombre);
				$request = $this->update($sql,$arrData);
			}
			else
			{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCategoria(int $idcatee) //Elimina la categoria seleccionada buscando que no se encuentre en la tabla conectada a otra
		{
			$this->intIdcat = $idcatee;
			$sql = "Select c.idcategoria from categoria c right join producto p on c.idcategoria=p.idcategoria  where p.idcategoria = $this->intIdcat";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "DELETE FROM categoria WHERE idcategoria = $this->intIdcat ";
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