<?php 

	class Login extends Controllers{
		public function __construct()
		{
			session_start();
			if (isset($_SESSION['login'])) {
				header('location: '.base_url().'/dashboard');
			}
			parent::__construct();
		}

		public function login()
		{
			$data['page_tag'] = "Login";
			$data['page_title'] = "Ferreteria";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"login",$data);
		}

		public function ResetPassV()
		{
			$data['page_tag'] = "Resetear Contraseña";
			$data['page_title'] = "Ferreteria";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"cambiar_password",$data);
		}

	//	public function login1()
	//	{
		//	$data['page_tag'] = "Login - Tienda Virtual";
		//	$data['page_title'] = "Tienda Virtual";
		//	$data['page_name'] = "login";
		//	$data['page_functions_js'] = "functions_login.js";
		//	$this->views->getView($this,"login1",$data);
		//}

		public function loginUser(){
			if ($_POST) {
				if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {
					$arrResponse = array('estado' => false, 'msg' => 'Error de datos');
				}else{
					$strUsuario = strtolower(strClean($_POST['txtEmail']));
					$strPassword = hash("SHA256", $_POST['txtPassword']);
					$request_user = $this->model->loginUser($strUsuario, $strPassword);
					if (empty($request_user)) {
						$arrResponse = array('estado' => false, 'msg' => 'El Usuario y/o Contraseña es incorrecta');
					}else{
						$arrData = $request_user;
						if ($arrData['estado'] == 1) {
							$_SESSION['idUser'] = $arrData['idusuario'];
							$_SESSION['login'] = true;

							$arrData = $this->model->sessionLogin($_SESSION['idUser']);
							sessionUser($_SESSION['idUser']); //crea la variable sesion

							$arrResponse = array('estado' => true, 'msg' => 'Inicio de Sesión correctamente');
						}else{
							$arrResponse = array('estado' => false, 'msg' => 'El Usuario esta Inactivo');
						}
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function resetPass(){
			if ($_POST) {
				//para que aunque no se pueda enviar el email, siempre tire la alrta de que no se pudo
				error_reporting(0);
				if (empty($_POST['txtEmailReset'])) {
					$arrResponse = array('estado' => false, 'msg' => 'Error de Datos');
				}else{
					$token = token(); //genera un token para la url de reiciniar contra
					$strEmail = strtolower(strClean($_POST['txtEmailReset']));
					$arrData = $this->model->getUserEmail($strEmail);

					if (empty($arrData)) {
						$arrResponse = array('estado' => false, 'msg' => 'Usuario no encontrado');
					}else{
						$idUsuario = $arrData['idusuario'];
						$nombreUsuario = $arrData['nombre'].' '.$arrData['apellido'];

						$url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token; //url que le mandara al correo para el reinicio de contra

						$requestUpdate = $this->model->setTokenUser($idUsuario, $token); //actualiza el token en la base

						//preparando el correo para recuperar la cuenta
						$dataUsuario = array('nombreUsuario' => $nombreUsuario,
											 'email' => $strEmail,
											 'asunto' => 'Recuperar Cuenta - '.NOMBRE_REMITENTE,
											 'url_recovery' => $url_recovery);

						if ($requestUpdate) {
							//enviar el email
							$sendEmail = sendEmail($dataUsuario, 'email_cambioPassword');
							if ($sendEmail) {
								$arrResponse = array('estado' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña');
							}else{
								$arrResponse = array('estado' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
							}
						}else{
							$arrResponse = array('estado' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
						}
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function resetPassBloqueo(){
			if ($_POST) {
				//para que aunque no se pueda enviar el email, siempre tire la alrta de que no se pudo
				error_reporting(0);
				if (empty($_POST['txtEmail'])) {
					$arrResponse = array('estado' => false, 'msg' => 'Error de Datos');
				}else{
					$token = token(); //genera un token para la url de reiciniar contra
					$strEmail = strtolower(strClean($_POST['txtEmail']));

					//OBTENGO LOS DATOS DE ESE USUARIO
					$arrData = $this->model->getUserEmail($strEmail);

					if (empty($arrData)) {
						$arrResponse = array('estado' => false, 'msg' => 'Usuario no encontrado');
					}else{
						$idUsuario = $arrData['idusuario'];
						$nombreUsuario = $arrData['nombre'].' '.$arrData['apellido'];

						//BLOQUEO AL USUARIO
						$requestUpdateBloqueo = $this->model->bloquearUsuario($idUsuario, $strEmail);

						$url_recovery = base_url().'/login/confirmUserBloq/'.$strEmail.'/'.$token; //url que le mandara al correo para el reinicio de contra

						$requestUpdate = $this->model->setTokenUser($idUsuario, $token); //actualiza el token en la base

						//preparando el correo para recuperar la cuenta
						$dataUsuario = array('nombreUsuario' => $nombreUsuario,
											 'email' => $strEmail,
											 'asunto' => 'Desbloquear Cuenta - '.NOMBRE_REMITENTE,
											 'url_recovery' => $url_recovery);

						if ($requestUpdate) {
							//enviar el email
							$sendEmail = sendEmail($dataUsuario, 'email_cambioPassword');
							if ($sendEmail) {
								$arrResponse = array('estado' => true, 'msg' => 'Ha excedido su límite de intentos, por razones de seguridad su usuario se ha bloqueado y se le ha enviado un correo electrónico para que pueda restablecer su contraseña.');
							}else{
								$arrResponse = array('estado' => false, 'msg' => 'Ha excedido su límite de intentos, por razones de seguridad su usuario se ha bloqueado y se intentó enviar un correo electrónico para que pueda restablecer su contraseña, pero el envío falló.');
							}
						}else{
							$arrResponse = array('estado' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
						}
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function confirmUser(string $params){
			if (empty($params)) {
				header('Location: '.base_url());
			}else{
				//obteniendo los parametros
				$arrParams = explode(',', $params);
				$strEmail = strClean($arrParams[0]);
				$strToken = strClean($arrParams[1]);
				$arrResponse = $this->model->getUsuario($strEmail, $strToken);

				//si no encuentra el registro
				if (empty($arrResponse)) {
					header('Location: '.base_url());
				}else{
					$data['page_tag'] = "Cambiar Contraseña";
					$data['page_title'] = "Cambiar Contraseña";
					$data['page_name'] = "cambiar_contraseña";
					$data['page_functions_js'] = "functions_login.js";
					$data['email'] = $strEmail;
					$data['token'] = $strToken;
					$data['idusuario'] = $arrResponse['idusuario'];
					$this->views->getView($this,"formCambiar_password",$data);
				}
			}
			die();
		}

		public function confirmUserBloq(string $params){
			if (empty($params)) {
				header('Location: '.base_url());
			}else{
				//obteniendo los parametros
				$arrParams = explode(',', $params);
				$strEmail = strClean($arrParams[0]);
				$strToken = strClean($arrParams[1]);
				$arrResponse = $this->model->getUsuarioBloqueado($strEmail, $strToken);

				//si no encuentra el registro
				if (empty($arrResponse)) {
					header('Location: '.base_url());
				}else{
					$requestUpdateDesbloqueo = $this->model->desbloquearUsuario($arrResponse['idusuario'], $strEmail);
					$data['page_tag'] = "Cambiar Contraseña";
					$data['page_title'] = "Cambiar Contraseña";
					$data['page_name'] = "cambiar_contraseña";
					$data['page_functions_js'] = "functions_login.js";
					$data['email'] = $strEmail;
					$data['token'] = $strToken;
					$data['idusuario'] = $arrResponse['idusuario'];
					$this->views->getView($this,"formCambiar_password",$data);
				}
			}
			die();
		}

		public function setPassword(){
			if (empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])) {
				$arrResponse = array('estado' => false, 'msg' => 'Error de datos');
			}else{
				$intIdpersona = intval($_POST['idUsuario']);
				$strEmail = strClean($_POST['txtEmail']);
				$strToken = strClean($_POST['txtToken']);
				$strPassword = $_POST['txtPassword'];
				$strPasswordConfirm = $_POST['txtPasswordConfirm'];

				if ($strPassword != $strPasswordConfirm) {
					$arrResponse = array('estado' => false, 'msg' => 'Las contraseña no son iguales');
				}else{
					$arrResponseUser = $this->model->getUsuario($strEmail, $strToken);

					//si no encuentra el registro
					if (empty($arrResponseUser)) {
						$arrResponse = array('estado' => false, 'msg' => 'Error de datos');
					}else{
						$strPassword = hash("SHA256", $strPassword);
						$requestPass = $this->model->insertPassword($intIdpersona, $strPassword);

						if ($requestPass) {
							$arrResponse = array('estado' => true, 'msg' => 'Contraseña actualizada correctamente');
						}else{
							$arrResponse = array('estado' => false, 'msg' => 'No es posible realizar el proceso, intente mas tarde');
						}
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}

	}
 ?>