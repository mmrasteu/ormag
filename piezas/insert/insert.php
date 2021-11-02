<?php
require('../../comunDB.php');


accesoDenegado();
accesoMedio();

encabezado('ORMAG Inserccion de datos de piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
btnMov("/piezas/insert", "btnInsertar", "Ir a Insertar");
usuario();

$mysqli=conecta();

	$nSerie=$_POST['nSerie'];
	$nombre=$_POST['nombre'];
	$marca=$_POST['marca'];
	$balda=$_POST['balda'];
	$caja=$_POST['caja'];
	$stock=$_POST['stock'];
	
	$sqlquery=" SELECT * FROM PIEZAS WHERE NSERIE='$nSerie'; ";
	$sqlinsert=" INSERT INTO PIEZAS (NSERIE, NOMBRE, MARCA, BALDA, CAJA, STOCK) VALUES ('$nSerie', '$nombre', '$marca', '$balda', '$caja', '$stock'); ";


	$queryresult1 = $mysqli->query($sqlquery);
	$queryresult2 = $mysqli->query($sqlinsert);


	$row_cnt = $queryresult1->num_rows;
	if ($row_cnt == 1)
	{
		printf("<h4>El articulo ya existe en la base de datos</h4>");
	} 	
	else{
		if (! $queryresult1 || ! $queryresult2)
			{
			printf("<h4>No se puede realizar consulta.</h4> </br>");
			
			}
		else
			{
				/*Modificamos el xml ahora que esta confirmado que la inserccion es correcta*/
			 logReg("INSERCCION DE NUEVA PIEZA. Nº Serie:'$nSerie'");
			 
			 printf("<script type='text/javascript'>
					alert(' Los datos han sido introducidos satisfactoriamente ');
					setTimeout (window.location='./index.php', 2000); 
				</script>");
			}
	}


printf("</body>
	</html>");
?>