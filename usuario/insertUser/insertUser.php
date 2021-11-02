<?php
require('../../comunDB.php');


accesoDenegado();
accesoAdministrador();

$mysqli=conecta();

	$user=$_POST['user'];
	$passwd=$_POST['passwd'];
	$passwdRep=$_POST['passwdRep'];
	$nif=$_POST['nif'];
	$nombre=$_POST['nombre'];
	$telfn=$_POST['telfn'];
	$nSeg=$_POST['nSeg'];

	$nifCorrecto=validar_dni($nif);

	if ($passwd != $passwdRep)
	{
		printf("<script type='text/javascript'>
					alert(' Las contraseñas no coincicen ');
					setTimeout (window.location='./index.php', 2000); 
				</script>");
	}
	elseif (!$nifCorrecto) {
		printf("<script type='text/javascript'>
					alert(' El NIF no es correcto. (La estructura del nif es: 00000000X) ');
					setTimeout (window.location='./index.php', 2000); 
				</script>");
		
	}
	else
	{
		$sqlquery=" SELECT * FROM USUARIOS WHERE USER='$user'; ";
		$sqlinsert=" INSERT INTO USUARIOS (USER, PASSWD, NIF, NOMBRE, TELFN, NIVEL_SEGURIDAD) 
									VALUES ('$user', MD5('$passwd'), '$nif', '$nombre', '$telfn', '$nSeg'); ";
		

		$queryresult1 = $mysqli->query($sqlquery);
		$queryresult2 = $mysqli->query($sqlinsert);


		$row_cnt = $queryresult1->num_rows;
		if ($row_cnt == 1)
		{
			printf("<script type='text/javascript'>
					alert(' El usuario ya existe en la base de datos. ');
					setTimeout (window.location='./index.php', 2000); 
				</script> </br>");
		} 	
		else{
			if (! $queryresult1 || ! $queryresult2)
				{
				printf("<script type='text/javascript'>
					alert(' No se puede realizar consulta. ');
					setTimeout (window.location='./index.php', 2000); 
				</script> ");
				
				}
			else
				{
				 logReg("DAR ALTA A USUARIO: '$user' ");
				 printf("<script type='text/javascript'>
					alert(' El usuario ha sido introducido satisfactoriamente ');
					setTimeout (window.location='./index.php', 2000); 
				</script>");
				 
				}
		}
	}

?>