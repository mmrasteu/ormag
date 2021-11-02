<?php
require('../../comunDB.php');

accesoDenegado();
accesoMedio();

encabezado('ORMAG Confirmar borrado de datos de piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
usuario();


$nSerie = strtoupper( trim($_POST['nSerie']) );

$mysqli=conecta();
	
	$sqlquery=" SELECT * FROM PIEZAS WHERE NSERIE='$nSerie'; ";
	$queryresult = $mysqli->query($sqlquery);
	$fila = $queryresult->fetch_assoc();

	if (! $queryresult){
		printf("No se puede realizar consulta.");
				
	}
	else
	{
		printf("
		<form action='delete.php' name='formDelete' method='POST'>
		<table>
		<tr> 
			<th colspan='6'> CONFIRMAR PIEZA A BORRAR </th> 
			</tr>
			<tr> 
				<th>Nº SERIE</th>
				<th>NOMBRE</th>
				<th>MARCA</th>	
				<th>BALDA</th>
				<th>CAJA</th>
				<th>STOCK</th>
			</tr>
			<tr>
		");	
		
		printf("

				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %d </h3> </td>
				<td> <h3> %d </h3> </td>
		", $fila["NSERIE"], $fila["NOMBRE"], $fila["MARCA"], $fila["BALDA"], $fila["CAJA"], $fila["STOCK"]);	

	$mysqli->close();				

		printf("		
			</tr>
			<tr> 
				<th colspan='6'> <input type='submit' name='btnConfirmDelete' value='Confirmar' /> 
								
								 <a href='/ormag/piezas/delete/index.php'>
										<input type='button' name='btnBorrar' value='Cancelar' />
								 </a> 
				</th> 
			</tr>
		");
		printf("
			</table>
	
			<input type='hidden' name='nSerie' value='%s' />

		</form>
		", $nSerie);
	}

	printf("
		</body>
		</html>
	");


?>