<?php 
	
	//define("BASE_URL", "http://localhost/ferreteria/");
	const BASE_URL = "http://localhost/financiero";

	//Zona horaria
	date_default_timezone_set('America/El_Salvador');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "db_financiero";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";

	//Datos envio de correo
	const NOMBRE_REMITENTE = "Electrodomésticos La Cima";
	const EMAIL_REMITENTE = "web.riquelmipalacios@gmail.com";
	const NOMBRE_EMPESA = "Electrodomésticos La Cima";
	const WEB_EMPRESA = "eleclacima.com";
	



	


 ?>