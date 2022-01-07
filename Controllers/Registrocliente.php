<?php

class Registrocliente extends Controllers
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		session_regenerate_id(true);
		if (empty($_SESSION['login'])) {
			header('location: ' . base_url() . '/login');
		}
		getPermisos(13);
	}

	public function Registrocliente()
	{

		if (empty($_SESSION['permisosMod']['leer'])) {
			header('location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Registro de Cliente";
		$data['page_name'] = "rol_categoria";
		$data['page_title'] = "Registro de Cliente Persona Natural";
		$data['page_functions_js'] = "functions_registrocliente.js";
		$this->views->getView($this, "registrocliente", $data);
	}
	public function setRegistroClienteNatural()
	{

		$intcodigo_cliente_natural = strClean($_POST['codigocliente']);

		$strNombre =  strClean($_POST['nombrecliente']);
		$strApellido =  strClean($_POST['apellidocliente']);
		$strDireccion =  strClean($_POST['direccioncliente']);

		$strTelefono =  strClean($_POST['telefonocliente']);
		$strDui =  strClean($_POST['duicliente']);
		$strEstadocivil =  strClean($_POST['estadocivilcliente']);
		$strLugartrabajo =  strClean($_POST['lugardetrabajocliente']);

		$stringreso =  strClean($_POST['ingresoscliente']);
		$strEgresos =  strClean($_POST['egresoscliente']);

		$intEstado = intval($_POST['bandera']);

		if ($intEstado == 1) {
			$option = 1;
			//		if ($_SESSION['permisosMod']['escribir']) {
			//Crear
			$request_cliente = $this->model->insertClienteNatural($intcodigo_cliente_natural, $strNombre, $strApellido, $strDireccion, $strTelefono, $strDui, $strEstadocivil, $strLugartrabajo, $stringreso, $strEgresos);
			//		}
			//	}else{
			//		$option = 2;
			//		if ($_SESSION['permisosMod']['actualizar']) {
			//Actualizar
			//		 $request_cliente= $this->model->updateCliente($intcodigo_cliente_natural,$strDui,$strNombre,$strApellido,$strTelefono,$intEstado);
			//		}
		}

		if ($request_cliente > 0) {
			if ($option == 1) {
				$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
			} else {
				$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
			}
		} else if ($request_cliente == 'exist') {

			$arrResponse = array('estado' => false, 'msg' => '¡Atención! ya existe Un registro con esos datos.');
		} else {
			$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

		die();
	}

	public function setRegistroClienteJuridico()
	{

		$intcodigo_cliente_natural = strClean($_POST['codigoclientejuridico']);

		$strNombreempresa =  strClean($_POST['nombreclientejuridico']);
		$strTelefono =  strClean($_POST['telefonoclientejuridico']);
		$strDireccion =  strClean($_POST['direccionclientejuridico']);		
		$stringreso =  strClean($_POST['balance']);
		$strEgresos =  strClean($_POST['estado']);

		$intEstado = intval($_POST['bandera']);


		if(isset($_FILES['documento']) && $_FILES['documento']['type']=='application/pdf'){
			$userfile_extn = explode(".", strtolower($_FILES['documento']['name']));
			move_uploaded_file ($_FILES['documento']['tmp_name'] , $_SERVER['DOCUMENT_ROOT'] .'/financiero/Assets/images/pdf/'. strClean($intcodigo_cliente_natural) . '.' . $userfile_extn[1]);
		}
		$url = $_FILES['documento']['name'];
		if ($intEstado == 2) {
			$option = 1;
			//		if ($_SESSION['permisosMod']['escribir']) {
			//Crear
			$request_cliente = $this->model->insertClienteJuridico($intcodigo_cliente_natural, $strNombreempresa,$strTelefono, $strDireccion, $url, $strEgresos);
			//		}
			//	}else{
			//		$option = 2;
			//		if ($_SESSION['permisosMod']['actualizar']) {
			//Actualizar
			//		 $request_cliente= $this->model->updateCliente($intcodigo_cliente_natural,$strDui,$strNombre,$strApellido,$strTelefono,$intEstado);
			//		}
		}

		if ($request_cliente > 0) {
			if ($option == 1) {
				$arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
			} else {
				$arrResponse = array('estado' => true, 'msg' => 'Datos Actualizados correctamente.');
			}
		} else if ($request_cliente == 'exist') {

			$arrResponse = array('estado' => false, 'msg' => '¡Atención! ya existe Un registro con esos datos.');
		} else {
			$arrResponse = array("estado" => false, "msg" => 'No es posible almacenar los datos.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

		die();
	}



	public function getCodigoPN()
	{

		$arrData = $this->model->setCodigoPN();


		$arrayDatos = array('datosIndividuales' => $arrData);
		echo json_encode($arrayDatos, JSON_UNESCAPED_UNICODE);

		die();
	}


	public function getCodigoPJ()
	{

		$arrData = $this->model->setCodigoPJ();


		$arrayDatos = array('datosIndividuales' => $arrData);
		echo json_encode($arrayDatos, JSON_UNESCAPED_UNICODE);

		die();
	}
}
