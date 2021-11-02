<?php

printf("
	<html lang='es'>
	<head>
		<meta charset='UTF-8' />
		<meta name='author' content='Miguel A. Magrañal' />
    	 <title> Acceso Denegado</title>
		<link rel='stylesheet' type='text/css'
								href='/ormag/style/estilo.css' />
 	</head>
	<body>

	<script type='text/javascript'>
			alert(' Acceso denegado. Debe logearse correctamente para acceder a esta página ');
			setTimeout (window.location='/ormag/index.php', 2000); 
	</script>

	</body>
	</html>
	");


?>