<?php
require('../../comunDB.php');


accesoDenegado();
accesoAdministrador();

	$usuarioNuevo=$_POST['usuarioNuevo'];
	$usuarioAntiguo=$_POST['usuarioAntiguo'];
	$nif=$_POST['nif'];
	$nombre=$_POST['nombre'];
	$telefono=$_POST['telefono'];
	$nSeguridad=$_POST['nSeguridad'];

$nifCorrecto=validar_dni($nif);

if (!$nifCorrecto) {
	printf("<script type='text/javascript'>
				alert(' El NIF no es correcto. (La estructura del nif es: 00000000X) ');
			</script>");
}
else
{
		$mysqli=conecta();
			
			
			
			$sqlinsert=" UPDATE USUARIOS SET USER='$usuarioNuevo', NIF='$nif', NOMBRE='$nombre', 
														TELFN='$telefono', NIVEL_SEGURIDAD='$nSeguridad' WHERE USER='$usuarioAntiguo' ; ";
			
			$queryresult = $mysqli->query($sqlinsert);

		
			
				if (! $queryresult)
					{
					printf("<script type='text/javascript'>
							alert(' No se puede realizar consulta ');
							setTimeout (window.location='./index.php', 2000); 
						</script>");
					
					}
				else
					{
					 logReg("EDITAR USUARIO: '$usuarioNuevo'");
					 printf("<script type='text/javascript'>
							alert(' Los datos han sido editados satisfactoriamente ');
							setTimeout (window.location='./index.php', 2000); 
						</script>");
					}
		$mysqli->close();
}


printf("</body>
	</html>");
?>