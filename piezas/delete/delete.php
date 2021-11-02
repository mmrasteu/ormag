<?php
require('../../comunDB.php');


accesoDenegado();
accesoMedio();

encabezado('ORMAG Borrado de datos de piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
usuario();


$nSerie = strtoupper( trim($_POST['nSerie']) );

$mysqli=conecta();
	
	$sqlquery=" SELECT * FROM PIEZAS WHERE NSERIE='$nSerie'; ";
	$sqldelete=" DELETE FROM PIEZAS WHERE NSERIE='$nSerie'; ";
	

	$queryresult1 = $mysqli->query($sqlquery);
	$queryresult2 = $mysqli->query($sqldelete);


	$row_cnt = $queryresult1->num_rows;
	if ($row_cnt == 0)
	{
		printf("<h4>El articulo no existe en la base de datos</h4>");
	 		
	} 	
	else{
		if (! $queryresult1 || ! $queryresult2)
			{
			printf("<h4>No se puede realizar la operación.</h4> </br>");
			}
		else
			{
				logReg("BORRAR PIEZA. Nº Serie: '$nSerie'");

			 printf("<script type='text/javascript'>
					alert(' Los datos han sido borrados satisfactoriamente ');
					setTimeout (window.location='./index.php', 2000); 
				</script>");
			}
	}
		
printf("</body>
	</html>");
?>