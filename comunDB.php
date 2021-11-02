<?php
function conecta()
	{
	if (!defined('USUARIO_BDD')) define('USUARIO_BDD', 'root');
	if (!defined('PASSWD_BDD')) define('PASSWD_BDD', '');

	$mysqli = new mysqli("localhost", USUARIO_BDD, PASSWD_BDD, "ormag_db");
	if ($mysqli->connect_error)
		{
			echo $mysqli->connect_errno;
		}
	return $mysqli;
	}


/*******************************************************************************************/
function validar_dni($nif){
	$letra = substr($nif, -1);
	$numeros = substr($nif, 0, -1);
	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
		return $dniCorrecto=true;
	}else{
		return $dniCorrecto=false;
	}
}
/********************************************************************************************/
function encabezado($titulo)
	{
		printf("
		<html lang='es_ES'>
		<head>
			<meta charset='UTF-8' />
			<meta name='author' content='Miguel A. Magrañal' />
			<meta name='viewport' content='initial-scale=1.0, user-scalable=yes' /> 
			<script src='https://code.jquery.com/jquery-3.1.0.min.js' type='text/javascript'></script>
			<script type='text/javascript' src='/ormag/style/efectos.js'></script>
			 <title> $titulo </title>
			<link rel='stylesheet' type='text/css'
									href='/ormag/style/estilo.css' />
			</head>
		<body>

		<div> 
		<img class='menu-superior' src='/ormag/style/logo-ormag.jpg' />
		</div>
		");		 
	}
/*******************************************************************************************/	
function btnMov($direccion, $nombre, $valor)
	{
		printf("
				<a href='/ormag%s'> <input class='menu-superior' type='button' name='%s' value='%s' /> </a>
			", $direccion, $nombre, $valor);
	}	
/********************************************************************************************/
function usuario()
	{
		$mysqli=conecta();

		printf("
				  	<div class='derecha-top'> 
				  			Usuario: %s 
				  	</div>
				  	", $_SESSION['USUARIO']);

		$id=$_SESSION['ID_USER'];
	
		$sqlquery="SELECT * FROM MENSAJES WHERE ID_RECEPTOR='$id' AND LEIDO=0; ";
		$queryresult=$mysqli->query($sqlquery);
		$row_cnt = $queryresult->num_rows;
		if ($row_cnt >= 1)
		{	
			printf("
				<a href='/ormag/mensajes'>
					<img class='mensajes derecha-top' src='/ormag/style/noleido.jpeg'/>
				</a> 		
			");
		}
		else
		{
			printf("
				<a href='/ormag/mensajes'>
					<img class='mensajes derecha-top' src='/ormag/style/leido.jpeg'/> 
				</a>		
			");
		}


		printf("
			<br />
			<br />
			<br />
			<br />
			");

		$mysqli->close();
	}
/********************************************************************************************/

function accesoDenegado()
{
	if( $_SESSION["AUTORIZADO"] != 1)
	{	
		header("location: /ormag/accesoDenegado.php");
	}
}

/********************************************************************************************/

function accesoAdministrador()
{
	if( $_SESSION["NIVEL_SEGURIDAD"] != 1 )
		{
			printf("<script type='text/javascript'>
					alert(' Acceso denegado. No tiene autorización para entrar en esta página %s ');
					setTimeout (window.location='/ormag/menu/', 2000); 
			</script>", $_SESSION['USUARIO']);
		}
}

/********************************************************************************************/

function accesoMedio()
{
	if( ! ($_SESSION["NIVEL_SEGURIDAD"] == 1 || $_SESSION["NIVEL_SEGURIDAD"] == 2) )
		{
			printf("<script type='text/javascript'>
					alert(' Acceso denegado. No tiene autorización para entrar en esta página %s ');
					setTimeout (window.location='/ormag/menu/', 2000); 
			</script>", $_SESSION["USUARIO"]);
		}
}
/**********************************************************************************************/
function logReg($regActividad){

	$Registros = new SimpleXMLElement('../../usuario/MostrarRegistros/registro.xml', null, true);

	$log = $Registros->addChild('Registro');
	$log->addChild('Usuario', $_SESSION['USUARIO']);
	$log->addChild('Accion', $regActividad);
	$log->addChild('Hora', date("G:i") );
	$log->addChild('Dia', date("d") );
	$log->addChild('Mes', date("m") );
	$log->addChild('Anyo', date("Y") );

	$Registros->asXML('../../usuario/MostrarRegistros/registro.xml');

}



/********************************************************************************************/
if ( !session_start() )
	printf("<script type='text/javascript'>
				alert(' No se ha podido inicar sesion ');
				setTimeout (window.location='/ormag/', 2000); 
			</script>");


?>