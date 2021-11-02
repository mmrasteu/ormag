<?php

require('comunDB.php');

$mysqli=conecta();

if ($mysqli->connect_errno == 1049) /*Si mysql devuelve este error significa que no existe la base de datos omrag_db*/
	{
	
		#Aparecerá un mensaje para pedir al usuario si desea instalar la app o no.
		printf("<script type='text/javascript'>
				    function confirmar()
				    { 
					    confirmar=confirm('No existe la base de datos. ¿Desea instalarla?'); 
					    if (confirmar)
					    	{
							    // si pulsamos en aceptar
							    alert('Se procederá a instalar la aplicación');
								setTimeout (window.location='/ormag/install.php', 2000); 
							}
					    else 
							    // si pulsamos en cancelar
							    alert('No se instalará la aplicación'); 
				    } 

				    confirmar();

				</script>");

		die();
	}

printf("
	<html lang='es'>
	<head>
		<meta charset='UTF-8' />
		<meta name='author' content='Miguel A. Magrañal' />
    	 <title> ORMAG DATABASE - Loggin</title>
		<link rel='stylesheet' type='text/css'
								href='/ormag/style/estilo.css' />
 	</head>
	<body>
");

if ( !empty($_POST) ) /*El formulario no esta vacio y entra por aqui*/
	{
		if ( empty($_POST['user']) || empty($_POST['passwd']) )
				printf("<script type='text/javascript'>
							alert(' Debe introducir un usuario y contraseña validos ');
							setTimeout (window.location='./index.php', 2000); 
						</script> ");
			
		else
		{
			$user=$_POST['user'];
			$passwd=md5($_POST['passwd']);

			$sqlquery="SELECT * FROM USUARIOS WHERE USER='$user' AND PASSWD='$passwd'; ";
			$queryresult = $mysqli->query($sqlquery);
			$fila = $queryresult->fetch_assoc();

				if (! $queryresult)
					printf("<script type='text/javascript'>
								alert(' No se puede realizar consulta. ');
								setTimeout (window.location='./index.php', 2000); 
							</script> ");
				else
				{
					 $row_cnt = $queryresult->num_rows;
					 $correctUser=$fila['USER'];
					 $correctID=$fila['ID_USER'];
					 if ($row_cnt == 1)
					 {
					 	$_SESSION["AUTORIZADO"] = 1;
					 	$_SESSION["NIVEL_SEGURIDAD"]=$fila['NIVEL_SEGURIDAD'];
					 	$_SESSION["USUARIO"]=$correctUser;
					 	$_SESSION["ID_USER"]=$correctID;

					 	$sqlquery="UPDATE USUARIOS SET ULT_CONEXION = CURRENT_TIMESTAMP WHERE ID_USER = $correctID";
						$queryresult = $mysqli->query($sqlquery);
						if (! $queryresult)
							printf("<script type='text/javascript'>
									alert(' No se puede realizar consulta. ');
									setTimeout (window.location='./index.php', 2000); 
								</script> ");
						else
							printf("<script type='text/javascript'>
									alert(' Bienvenido %s ');
									setTimeout (window.location='./menu', 2000); 
								</script> ", $fila['USER']);

					 }
					 else
					 {
					 	$_SESSION["AUTORIZADO"] = 0;
					 	$_SESSION["NIVEL_SEGURIDAD"]=0;

					    printf("<script type='text/javascript'>
									alert(' Usuario o contraseña incorrecto ');
									setTimeout (window.location='./index.php', 2000); 
								</script>");
					 }
				}
			$mysqli->close();		
		}
		
	}
else {
	printf("
			<div> <img class='encabezado' src='/ormag/style/logo-ormag.jpg' /> </div>

			<br />

			<form action=%s name='formLoggin' method='POST'>

				<table class='inicio'>
					<tr>
						<th colspan='2'> ACCESO A LA BASE DE DATOS </th>
					</tr>
					<tr>
						<th> Usuario </th> <td> <input type='text' name='user' /> <td>
					</tr>
					<tr>
						<th> Contraseña </th> <td> <input type='password' name='passwd' /> <td>
					</tr>
					<tr>
						<td colspan='2'> <input type='submit' name='btnLog' value='Entrar' />
					</tr>
				</table>	
			</form>			
	", $_SERVER['PHP_SELF']);
}

if ( isset($_SESSION["AUTORIZADO"]) && $_SESSION["AUTORIZADO"]==1)
	header("location: ./menu ");

printf("
	</body>
	</html>
");

?>