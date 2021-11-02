<?php
require('../../comunDB.php');


accesoDenegado();
accesoMedio();

encabezado('ORMAG Edición de datos de piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
usuario();


	$nSerieNuevo = strtoupper( trim($_POST['nSerieNuevo']) );
	$nSerieAntiguo = strtoupper( trim($_POST['nSerieAntiguo']) );
	$nombre = strtoupper( trim($_POST['nombre']) );
	$marca =  strtoupper( trim($_POST['marca']) );
	$balda =  strtoupper( trim($_POST['balda']) );
	$caja =	  strtoupper( trim($_POST['caja']) );
	$stock =  strtoupper( trim($_POST['stock']) );

$mysqli=conecta();
	
	
	$sqlupdate=" UPDATE PIEZAS SET NSERIE='$nSerieNuevo', NOMBRE='$nombre', MARCA='$marca', 
												BALDA='$balda', CAJA='$caja', STOCK='$stock' WHERE NSERIE='$nSerieAntiguo' ; ";
	
	$queryresult = $mysqli->query($sqlupdate);


	
		if (! $queryresult)
			{
			 printf("<script type='text/javascript'>
					alert(' No se puede realizar la consulta ');
					setTimeout (window.location='./index.php', 2000); 
				</script>");
			
			}
		else
			{
			 logReg("EDITAR PIEZA. Nº SERIE: '$nSerieNuevo'");
			 printf("<script type='text/javascript'>
					alert(' Los datos han sido editados satisfactoriamente ');
					setTimeout (window.location='./index.php', 2000); 
				</script>");
			}
	

printf("</body>
	</html>");
?>