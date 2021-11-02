<?php

/* Ejecutar este script para instalar la base de datos y el usuario por defecto*/
if ( !session_start() )
	printf("<script type='text/javascript'>
				alert(' No se ha podido inicar sesion ');
				setTimeout (window.location='/', 2000); 
			</script>");
printf("
		<html lang='es_ES'>
		<head>
			<meta charset='UTF-8' />
			<meta name='author' content='Miguel A. Magrañal' />
			<script src='https://code.jquery.com/jquery-3.1.0.min.js' type='text/javascript'></script>
			<script type='text/javascript' src='/ormag/style/efectos.js'></script>
			 <title> Instalación </title>
		</head>
		<body>
		");		


/*Nos conectamos a mysql*/

$mysqli=new mysqli('localhost', 'root', '');

if (!$mysqli) {
    printf("<script type='text/javascript'>
					alert(' Error: %d %s ');
					setTimeout (window.location='/index.php', 2000); 
				</script>",	$mysqli->connect_errno, 
							$mysqli->connect_error	);
		die();
}




/*Borramos la base de datos si existe y la creamos de nuevo, indicamos la vamos a usar*/

$sqlquery = 'DROP DATABASE IF EXISTS ormag_db';
$queryresult = $mysqli->query($sqlquery);
if (!$queryresult) {
	    echo 'Error al borrar la base de datos: ' . $mysqli->connect_error . "<br />";
} else {
	    echo "La base de datos ormag_db se borro correctamente<br />";
}	

$sqlquery = 'CREATE DATABASE ormag_db';
$queryresult = $mysqli->query($sqlquery);
if (!$queryresult) {
	echo 'Error al crear la base de datos: ' . $mysqli->connect_error . "<br />";
} else {
    echo "La base de datos ormag_db se creó correctamente<br />";    
}

$sqlquery = 'USE ormag_db';
$queryresult = $mysqli->query($sqlquery);
if (!$queryresult) {
	echo 'Error al usar la base de datos: ' . $mysqli->connect_error . "<br />";
} else {
    echo "La base de datos ormag_db se uso correctamente<br />";    
}



/*Importamos el archivo sql que contiene la creación de la base de datos y 
				creamos un array con cada una de las consultas sql en queryArray*/
$archivo=file_get_contents("ORMAGDATABASE.sql");
$queryArray=explode(";", $archivo);



/*Recorremos el array y ejecutamos cada una de las consultas*/
for($i = 0; $i < (count($queryArray)-1); $i++)
{
	$sqlquery = $queryArray[$i].";";

	$queryresult = $mysqli->query($sqlquery);

	if (! $queryresult)
		{
		printf("<script type='text/javascript'>
					alert(' Error al instalar la base de datos '); 
				</script>");	
		die();
		}
		
}
 echo "La base de datos ormag_db se instalo correctamente<br />";    


/*Creación del usuario por defecto*/

$sqlquery="INSERT INTO USUARIOS (USER, PASSWD, NIVEL_SEGURIDAD) VALUES ('admin', MD5('admin'), 1) ;";
$mysqli->query($sqlquery);

if (! $queryresult)
{
	printf("<script type='text/javascript'>
				alert(' Error al crear el usuario por defecto'); 
			</script>");	
	die();
}
else
	echo "Usuario por defecto creado correctamente<br/>";	


/*Mostramos al usuario un mensaje informandole de que el proceso ha concluido 
y cual es el usuario y contraseña por defecto. Enviamos al usuario al la página 
del cambio de contraseñas para que cambie la contraseña por defecto por seguridad, 
aunque no sea obligatorio*/

$_SESSION["AUTORIZADO"] = 1;
$_SESSION["NIVEL_SEGURIDAD"] = 1;
$_SESSION['USUARIO'] = "admin";
$id=$_SESSION['ID_USER'] = 1;


printf("<script type='text/javascript'>
			alert(' La instalación ha concluido correctamente, se le reenviara a la pagina de cambio de contraseña para que cambie la contraseña de usuario por defecto. Usuario por defecto: admin. Contraseña por defecto: admin ');
			setTimeout (window.location='/ormag/usuario/editUser/cambiaPasswd.php', 2000); 
		</script>
		</body>
		</html>");


/*Cerramos la conexión con mysql*/
$mysqli->close();


?>