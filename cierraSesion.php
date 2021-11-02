<?php
/*
Miguel Ángel Magrañal Rasteu
25/02/17
*/

require('comunDB.php');
accesoDenegado();
printf("
	<html lang='es'>
	<head>
		<meta charset='UTF-8' />
		<meta name='author' content='Miguel A. Magrañal' />
    	 <title> ORMAG DATABASE - CERRAR SESIÓN</title>
		<link rel='stylesheet' type='text/css'
								href='/ormag/style/estilo.css' />
 	</head>
	<body>
			<script type='text/javascript'>
				alert(' %s, su sesión se ha cerrado ');
				setTimeout (window.location='/ormag/index.php', 2000); 
			</script>

	</body>
	</html>", $_SESSION['USUARIO'] );

/*Destruimos sesiones*/
session_destroy();

?>