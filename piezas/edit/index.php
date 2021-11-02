<?php
require('../../comunDB.php');


accesoDenegado();
accesoMedio();

encabezado('ORMAG Editar datos de piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
usuario();


$mysqli=conecta();

if ( isset($_POST["btnEdit"]) ) {

	$editNSerie=$_POST['editNSerie'];

	$sqlquery=" SELECT * FROM PIEZAS WHERE NSERIE = '$editNSerie'; ";
	$queryresult = $mysqli->query($sqlquery);
	$row_cnt = $queryresult->num_rows;
	if (! $queryresult)
		printf("No se puede realizar consulta.");

	elseif ($row_cnt == 0) 
		printf("<h4>El articulo no existe en la base de datos</h4>");
	else
	{
		printf("
		<table>
			<tr> 
				<th colspan='6'> PIEZA A EDITAR </th> 
			</tr>
			<tr> 
				<th>Nº SERIE</th>
				<th>NOMBRE</th>
				<th>MARCA</th>
			</tr>		
		");
		while ($fila = $queryresult->fetch_assoc() )
		{
		
		printf("
			<tr>
			<form action='confirm.php' name='formConfirmEdit' method='POST'>
				
				<td> <input type='text' name='nSerieNuevo' value='%s'required='required' />  </td>
				<td> <input type='text' name='nombre' value='%s' required='required' /> </td>
				<td> <input type='text' name='marca' value='%s' required='required' /> </td>
			</tr>
			
			<tr>
				<th>BALDA</th>
				<th>CAJA</th>
				<th>STOCK</th>
			</tr>

			<tr>
				<td> <input type='text' name='balda' value='%s' required='required' /> </td>
				<td> <input type='number' name='caja' value='%d' required='required' /> </td>
				<td> <input type='number' name='stock' value='%d' required='required' /> </td>	
			</tr>

			<input type='hidden' value='%s' name='nSerieAntiguo' />

		", $fila["NSERIE"], $fila["NOMBRE"], $fila["MARCA"], $fila["BALDA"], $fila["CAJA"], $fila["STOCK"], $fila["NSERIE"] );
		}

		printf("
			<tr> 
			<th colspan='6'> 
							<input type='submit' name='btnEdit' value='Editar' /> 
							<a href='/ormag/piezas/edit/index.php'>
								<input type='button' name='btnCancelar' value='Cancelar' />
							</a>
			</th> 
			</tr>
			</form>	

			</table>");			

	}
}



else{

	printf("
	<form action='%s' name='formEdit' method='POST'>
		<table>
		<tr>
		<th> EDITAR PIEZAS</th> 
		</tr>
		<tr>	
				<th> <input class='menu' type='submit' name='btnEdit' value='Editar' /> </th> 
		</tr>
		<tr>	
				<td> <input type='text' name='editNSerie' size='65&#37;' placeholder='Escriba el número de serie' /> </td> 
		</tr>
		</table>	
	</form>
", $_SERVER['PHP_SELF']);
}


$mysqli->close();


printf("
	</body>
	</html>
");
?>