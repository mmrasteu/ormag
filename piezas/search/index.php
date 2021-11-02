<?php
require('../../comunDB.php');

accesoDenegado();

encabezado('ORMAG Buscar piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
btnMov("/piezas/search", "btnBuscar", "Ir a Buscar");
usuario();


$mysqli=conecta();


if ( isset($_POST["btnSearchAll"]) ||  (isset($_SESSION["VUELTA"]) && $_SESSION["VUELTA"]=="TODO" )  ) {
	/*Buscar TODO*/
	$_SESSION["VUELTA"]=" ";

	$sqlquery=" SELECT * FROM PIEZAS ORDER BY BALDA, CAJA, STOCK DESC; ";
	$queryresult = $mysqli->query($sqlquery);
	if (! $queryresult){
		printf("No se puede realizar consulta.");
		

	}
	else
	{
		logReg("BUSCAR TODAS LAS PIEZAS");

		printf("
			<form action='/ormag/pdf/generaPDF5.php' method='POST'>
				<input type='submit' name='btnGeneraPDF_SearchAllPiezas' value='Descargar en PDF' />
			</form>
			");

		printf("
		<table>
		<tr> 
			<th colspan='8'> TODAS LAS PIEZAS </th> 
			</tr>
			<tr> 
				<th>Nº SERIE</th>
				<th>NOMBRE</th>
				<th>MARCA</th>	
				<th>BALDA</th>
				<th>CAJA</th>
				<th>STOCK</th>
				<th colspan='2'>OPERACION</th>
			</tr>
			
		");	
		while ($fila = $queryresult->fetch_assoc() )
		{
		if ($fila["STOCK"] == 0){
			$colorFondo="red";
		}
		elseif ($fila["STOCK"] <= 5){
			$colorFondo="orange";
		}
		else{
			$colorFondo="white";
			
		}
		printf("
			<tr bgcolor='%s'>
			<form action='operacionSearch.php' name='formSearchAll' method='POST'>
				
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %d </h3> </td>
				<td> <h3> %d </h3> </td>
				<td> <input class='btnRedondoVerde' type='submit' name='btnMas' value='+' /> </td>
				<td> <input class='btnRedondoRojo' type='submit' name='btnMenos' value='-' /> </td>

				<input type='hidden' value='%s' name='NSOculto' />
				<input type='hidden' value='todo' name='vuelta' />
			</form>	
			</tr>
				

		", $colorFondo, $fila["NSERIE"], $fila["NOMBRE"], $fila["MARCA"], $fila["BALDA"], $fila["CAJA"], $fila["STOCK"], $fila["NSERIE"]);
		}

		printf("</table>");	

	

				

	}
}
elseif ( isset($_POST["btnSearchNS"]) ||  (isset($_SESSION["VUELTA"]) && $_SESSION["VUELTA"]=="NSERIE" ) ) {
	/*Buscar por NSERIE*/
	$_SESSION["VUELTA"]=" ";
	
		
		if (isset($_SESSION["SEARCH_NSERIE"]) && $_SESSION["SEARCH_NSERIE"] != "FALSE")
			$NSerie = $_SESSION["SEARCH_NSERIE"];

		else
			$NSerie=strtoupper( trim($_POST["searchNSerie"]) );

		$_SESSION["SEARCH_NSERIE"]="FALSE";

		$sqlquery=" SELECT * FROM PIEZAS WHERE NSERIE = '$NSerie' ORDER BY BALDA, CAJA, STOCK DESC; ";
		$queryresult = $mysqli->query($sqlquery);
		$num_filas = $queryresult->num_rows;

		if (! $queryresult)
			printf("No se puede realizar consulta.");
		elseif ($num_filas <= 0)
			printf("No existe el número de serie introducido");
		else
		{
			logReg("BUSCAR PIEZAS POR NÚMERO DE SERIE '$NSerie'");

			printf("
			<form action='/ormag/pdf/generaPDF6.php' method='POST'>
				<input type='submit' name='btnGeneraPDF_SearchNSerie' value='Descargar en PDF' />
				<input type='hidden' name='NSerie' value='%s' />
			</form>
			", $NSerie);

			printf("
					<table>
					<tr> 
						<th colspan='8'> TODAS LAS PIEZAS SEGUN NÚMERO DE SERIE</th> 
						</tr>
						<tr> 
							<th>Nº SERIE</th>
							<th>NOMBRE</th>
							<th>MARCA</th>	
							<th>BALDA</th>
							<th>CAJA</th>
							<th>STOCK</th>
							<th colspan='2'>OPERACION</th>
						</tr>
						
					");	
					while ($fila = $queryresult->fetch_assoc() )
					{
					if ($fila["STOCK"] == 0){
						$colorFondo="red";
					}
					elseif ($fila["STOCK"] <= 5){
						$colorFondo="orange";
					}
					else{
						$colorFondo="white";
						
					}
					printf("
						<tr bgcolor='%s'>
						<form action='operacionSearch.php' name='formSearchNS' method='POST'>
							
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %d </h3> </td>
							<td> <h3> %d </h3> </td>
							<td> <input class='btnRedondoVerde' type='submit' name='btnMas' value='+' /> </td>
							<td> <input class='btnRedondoRojo' type='submit' name='btnMenos' value='-' /> </td>

							<input type='hidden' value='%s' name='NSOculto' />
							<input type='hidden' value='ns' name='vuelta' />
						</form>	
						</tr>
							

					", $colorFondo, $fila["NSERIE"], $fila["NOMBRE"], $fila["MARCA"], $fila["BALDA"], $fila["CAJA"], $fila["STOCK"], $fila["NSERIE"]);
					}

					printf("</table>");	

				

				
		}
		 	
		 		
		
}
elseif ( isset($_POST["btnSearchName"]) ||  (isset($_SESSION["VUELTA"]) && $_SESSION["VUELTA"]=="NOMBRE" ) ) {
	/*Buscar por NOMBRE*/
	$_SESSION["VUELTA"]=" ";
			
		if ( isset($_SESSION["SEARCH_NAME"]) && $_SESSION["SEARCH_NAME"] != "FALSE")	
			$Nombre=$_SESSION["SEARCH_NAME"];
			
		else
			$Nombre=strtoupper( trim($_POST["searchName"]) );
			

		$_SESSION["SEARCH_NAME"]="FALSE";

		$sqlquery=" SELECT * FROM PIEZAS WHERE NOMBRE LIKE '%$Nombre%' ORDER BY BALDA, CAJA, STOCK DESC; ";
		$queryresult = $mysqli->query($sqlquery);
		$num_filas = $queryresult->num_rows;

		if (! $queryresult)
			printf("No se puede realizar consulta.");
		elseif ($num_filas <= 0)
			printf("No existe el nombre introducido");
		else
		{	
			logReg("BUSCAR PIEZAS POR NOMBRE '$Nombre'");

			printf("
			<form action='/ormag/pdf/generaPDF7.php' method='POST'>
				<input type='submit' name='btnGeneraPDF_SearchName' value='Descargar en PDF' />
				<input type='hidden' name='Nombre' value='%s' />
			</form>
			", $Nombre);
			printf("
					<table>
					<tr> 
						<th colspan='8'> TODAS LAS PIEZAS SEGUN NOMBRE </th> 
						</tr>
						<tr> 
							<th>Nº SERIE</th>
							<th>NOMBRE</th>
							<th>MARCA</th>	
							<th>BALDA</th>
							<th>CAJA</th>
							<th>STOCK</th>
							<th colspan='2'>OPERACION</th>
						</tr>
						
					");	
					while ($fila = $queryresult->fetch_assoc() )
					{
					if ($fila["STOCK"] == 0){
						$colorFondo="red";
					}
					elseif ($fila["STOCK"] <= 5){
						$colorFondo="orange";
					}
					else{
						$colorFondo="white";
						
					}
					printf("
						<tr bgcolor='%s'>
						<form action='operacionSearch.php' name='formSearchName' method='POST'>
							
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %d </h3> </td>
							<td> <h3> %d </h3> </td>
							<td> <input class='btnRedondoVerde' type='submit' name='btnMas' value='+' /> </td>
							<td> <input class='btnRedondoRojo' type='submit' name='btnMenos' value='-' /> </td>

							<input type='hidden' value='%s' name='NSOculto' />
							<input type='hidden' value='%s' name='NombreOculto' />
							<input type='hidden' value='nombre' name='vuelta' />
						</form>	
						</tr>
							

					", $colorFondo, $fila["NSERIE"], $fila["NOMBRE"], $fila["MARCA"], $fila["BALDA"], 
														$fila["CAJA"], $fila["STOCK"], $fila["NSERIE"], $Nombre);
					}

					printf("</table>");	

				

				
		}
		 	
		 	
	
}
elseif ( isset($_POST["btnSearchMarca"]) ||  (isset($_SESSION["VUELTA"]) && $_SESSION["VUELTA"]=="MARCA" ) ) {
	/*Buscar por MARCA*/
	$_SESSION["VUELTA"]=" ";		
			
		if ( isset($_SESSION["SEARCH_MARCA"]) && $_SESSION["SEARCH_MARCA"] != "FALSE")	
			$Marca=$_SESSION["SEARCH_MARCA"];
		else
			$Marca=strtoupper( trim($_POST["searchMarca"]) );
			

		$_SESSION["SEARCH_MARCA"]="FALSE";

		$sqlquery=" SELECT * FROM PIEZAS WHERE MARCA LIKE '%$Marca%' ORDER BY BALDA, CAJA, STOCK DESC; ";
		$queryresult = $mysqli->query($sqlquery);
		$num_filas = $queryresult->num_rows;

		if (! $queryresult)
			printf("No se puede realizar consulta.");
		elseif ($num_filas <= 0)
			printf("No existe la marca introducida");
		else
		{	
			logReg("BUSCAR PIEZAS POR MARCA '$Marca'");
			
			printf("
			<form action='/ormag/pdf/generaPDF8.php' method='POST'>
				<input type='submit' name='btnGeneraPDF_SearchMarca' value='Descargar en PDF' />
				<input type='hidden' name='Marca' value='%s' />
			</form>
			", $Marca);
			printf("
					<table>
					<tr> 
						<th colspan='8'> TODAS LAS PIEZAS SEGUN MARCA </th> 
						</tr>
						<tr> 
							<th>Nº SERIE</th>
							<th>NOMBRE</th>
							<th>MARCA</th>	
							<th>BALDA</th>
							<th>CAJA</th>
							<th>STOCK</th>
							<th colspan='2'>OPERACION</th>
						</tr>
						
					");	
					while ($fila = $queryresult->fetch_assoc() )
					{
					if ($fila["STOCK"] == 0){
						$colorFondo="red";
					}
					elseif ($fila["STOCK"] <= 5){
						$colorFondo="orange";
					}
					else{
						$colorFondo="white";
						
					}
					printf("
						<tr bgcolor='%s'>
						<form action='operacionSearch.php' name='formSearchMarca' method='POST'>
							
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %s </h3> </td>
							<td> <h3> %d </h3> </td>
							<td> <h3> %d </h3> </td>
							<td> <input class='btnRedondoVerde' type='submit' name='btnMas' value='+' /> </td>
							<td> <input class='btnRedondoRojo' type='submit' name='btnMenos' value='-' /> </td>

							<input type='hidden' value='%s' name='NSOculto' />
							<input type='hidden' value='%s' name='MarcaOculto' />
							<input type='hidden' value='marca' name='vuelta' />
						</form>	
						</tr>
							

					", $colorFondo, $fila["NSERIE"], $fila["NOMBRE"], $fila["MARCA"], $fila["BALDA"], 
														$fila["CAJA"], $fila["STOCK"], $fila["NSERIE"], $Marca);
					}

					printf("</table>");	

				

				
		}
		 	
		 		
}

else{
		
	printf("
	<form action='%s' name='formSearch' method='POST'>
		<table>
			<tr>
				<th> BUSCAR PIEZAS</th> 
			</tr>
		</table>

		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchNS' value='Buscar por Número de Serie' /> 
					</th>	
				</tr>
				<tr>					
					<td> 
						<input type='text' name='searchNSerie' size='65&#37;' placeholder='Escriba el número de serie a buscar' /> 
					</td> 	
				</tr>
			 </table>
		</div>

		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchName' value='Buscar por Nombre' />					
					</th>	
				</tr>
				<tr>					
					<td> 
						<input type='text' name='searchName'  size='65&#37;' placeholder='Escriba el Nombre a buscar' /> 
					</td> 	
				</tr>
			 </table>
		</div>

		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchMarca' value='Buscar por Marca' />				
					</th>	
				</tr>
				<tr>					
					<td> 
						<input type='text' name='searchMarca'  size='65&#37;' placeholder='Escriba la Marca a buscar' /> 
					</td> 	
				</tr>
			 </table>
		</div>

		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchAll' value='Buscar Todo' />				
					</th>	
				</tr>
			 </table>
		</div>	
	</form>
", $_SERVER['PHP_SELF']);
}


$mysqli->close();


printf("
	</body>
	</html>
");
?>