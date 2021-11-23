<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Riquelmi Palacios">
  <meta name="theme-color" content="#009688">
  <link rel="shortcut icon" href="<?= media(); ?>/images/faviconn.ico">
	<title><?= $data['page_tag'] ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/login.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="<?= media(); ?>/images/logosis.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<div id="divLoading">
						<div>
						<img src="<?= media(); ?>/images/loading.svg" alt="Cargando...">
						</div>
					</div>
					<form id="formCambiarPass" name="formCambiarPass" class="forget-form" action="">
		        <input type="hidden" name="idUsuario" id="idUsuario" value="<?= $data['idusuario']; ?>">
		        <input type="hidden" name="txtEmail" id="txtEmail" value="<?= $data['email']; ?>">
		        <input type="hidden" name="txtToken" id="txtToken" value="<?= $data['token']; ?>">
          				<h3 class="login-head"><i class="fa fa-lg fa-fw fa-key"></i>Cambiar Contraseña</h3>
						  <br>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input id="txtPassword" name="txtPassword" autocomplete="no" class="form-control input_pass" type="password" placeholder="Nueva Contraseña" maxlength="20" required>
						</div>
						<div class="row">
							<p style="font-size: 13px;"><span id="msje"></span></p>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input id="txtPasswordConfirm" name="txtPasswordConfirm" autocomplete="off" class="form-control input_pass" type="password" placeholder="Confirmar Contraseña" maxlength="20" required>
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
				 			<button type="submit" class="btn login_btn"><i class="fas fa-unlock"></i>  REINICIAR</button>
				  		</div>
					</form>
					
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links text-black-50">
						<a href="<?= base_url(); ?>/Login/ResetPassV">¿ Olvidaste tu Contraseña ?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
  <script>
        const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
</body>
</html>