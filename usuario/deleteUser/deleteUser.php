<?php
require('../../comunDB.php');


accesoDenegado();
accesoAdministrador();

$user = $_POST['userDelete'];

$mysqli=conecta();
	
	$sqlquery=" SELECT * FROM USUARIOS WHERE USER='$user'; ";
	$sqldelete=" DELETE FROM USUARIOS WHERE USER='$user'; ";
	

	$queryresult1 = $mysqli->query($sqlquery);
	$queryresult2 = $mysqli->query($sqldelete);


	$row_cnt = $queryresult1->num_rows;
	if ($row_cnt == 0)
	{
		printf("<script type='text/javascript'>
					alert('El usuario no existe en la base de datos ');
					setTimeout (window.location='./index.php', 2000); 
				</script> >");
	 	
	} 	
	else
	{
		if (! $queryresult1 || ! $queryresult2)
			{
			printf("<script type='text/javascript'>
					alert(' No se puede realizar operación. ');
					setTimeout (window.location='./index.php', 2000); 
				</script> </br>");
			}
		else
			{
			 logReg("BORRAR USUARIO: '$user'");
			 printf("<script type='text/javascript'>
					alert(' Los datos han sido borrados satisfactoriamente ');
					setTimeout (window.location='./index.php', 2000); 
				</script>");
			}
	}
$mysqli->close();


?>