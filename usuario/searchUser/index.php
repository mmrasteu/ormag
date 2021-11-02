<?php
require('../../comunDB.php');


accesoDenegado();
accesoAdministrador();

encabezado('ORMAG Buscar usuarios');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuUsuarios.php", "btnVolverAUsuarios", "Volver a Usuarios");
btnMov("/usuario/searchUser", "btnBuscar", "Ir a Buscar");
usuario();


$mysqli=conecta();
if ( isset($_POST["btnSearchNSeguridad"]) ) {
	/*Buscar POR NIVEL DE SEGURIDAD*/
	
	$searchNSeguridad=$_POST['selectNSeg'];
	$sqlquery=" SELECT * FROM USUARIOS WHERE NIVEL_SEGURIDAD='$searchNSeguridad'; ";
	$queryresult = $mysqli->query($sqlquery);
	if (! $queryresult){
		printf("No se puede realizar consulta.");

	}
	else
	{
		
		printf("
			<form action='/ormag/pdf/generaPDF.php' method='POST'>
				<input type='submit' name='btnGeneraPDF' value='Descargar en PDF' />
				<input type='hidden' name='searchNSeguridad' value='%s' />
			</form>

		<table>
		<tr> 
			<th colspan='6'> BUSQUEDA DE USUARIOS POR NIVEL DE SEGURIDAD </th> 
			</tr>
			<tr> 
				<th>USUARIO</th>
				<th>NIF</th>
				<th>NOMBRE</th>	
				<th>TELEFONO</th>
				<th>NIVEL DE SEGURIDAD</th>
				<th>ULTIMA CONEXION</th>
			</tr>
			
		", $searchNSeguridad);	
		while ($fila = $queryresult->fetch_assoc() )
		{
			switch ($fila["NIVEL_SEGURIDAD"]) {
				case '1':
					$nSeguridad='Administrador';
					break;
				
				case '2':
					$nSeguridad='Gerente';
					break;
				
				case '3':
					$nSeguridad='Empleado';
					break;		
				
				
			}
		logReg("BUSCAR USUARIOS POR NIVEL DE SEGURIDAD: '$nSeguridad'");
		printf("
			<tr>
						
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
			
			</tr>
				

		", $fila["USER"], $fila["NIF"], $fila["NOMBRE"], $fila["TELFN"], $nSeguridad, $fila["ULT_CONEXION"] );
		}

		printf("
			</table>
			");
		

	}
}

elseif ( isset($_POST["btnSearchAllUsers"]) ) {
	/*Buscar TODOS LOS USUARIOS*/
	

	$sqlquery=" SELECT * FROM USUARIOS; ";
	$queryresult = $mysqli->query($sqlquery);
	if (! $queryresult){
		printf("No se puede realizar consulta.");

	}
	else
	{
		logReg("BUSCAR TODOS LOS USUARIOS");
		printf("
			<form action='/ormag/pdf/generaPDF1.php'>
				<input type='submit' name='btnGeneraPDF' value='Descargar en PDF' />
			</form>

		<table>
		<tr> 
			<th colspan='6'> TODOS LOS USUARIOS </th> 
			</tr>
			<tr> 
				<th>USUARIO</th>
				<th>NIF</th>
				<th>NOMBRE</th>	
				<th>TELEFONO</th>
				<th>NIVEL DE SEGURIDAD</th>
				<th>ULTIMA CONEXIÓN</th>
			</tr>
			
		");	
		while ($fila = $queryresult->fetch_assoc() )
		{
			switch ($fila["NIVEL_SEGURIDAD"]) {
				case '1':
					$nSeguridad='Administrador';
					break;
				
				case '2':
					$nSeguridad='Gerente';
					break;
				
				case '3':
					$nSeguridad='Empleado';
					break;		
				
				
			}
		
		printf("
			<tr>
						
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
			
			</tr>
				

		", $fila["USER"], $fila["NIF"], $fila["NOMBRE"], $fila["TELFN"], $nSeguridad, $fila["ULT_CONEXION"] );
		}

		printf("
			</table>
			");
		

	}
}
elseif ( isset($_POST["btnSearchUser"]) ) {
	/*Buscar USUARIOS POR NOMBRE DE USUARIO*/
	$user=$_POST['searchUser'];

	$sqlquery=" SELECT * FROM USUARIOS WHERE USER='$user'; ";
	$queryresult = $mysqli->query($sqlquery);
	$num_filas = $queryresult->num_rows;

		if (! $queryresult)
		{
			printf("No se puede realizar consulta.");
		}
		elseif ($num_filas <= 0)
			printf("No existe el usuario introducido");
		else
		{
			logReg("BUSCAR USUARIOS POR NOMBRE DE USUARIO: '$user'");

			printf("
			<form action='/ormag/pdf/generaPDF2.php' method='POST'>
				<input type='submit' name='btnGeneraPDF' value='Descargar en PDF' />
				<input type='hidden' name='user' value='%s' />
			</form>
			", $user);

			printf("
			<table>
			<tr> 
				<th colspan='6'> BUSQUEDA DE USUARIOS POR NOMBRE DE USUARIO </th> 
				</tr>
				<tr> 
					<th>USUARIO</th>
					<th>NIF</th>
					<th>NOMBRE</th>	
					<th>TELEFONO</th>
					<th>NIVEL DE SEGURIDAD</th>
					<th>ULTIMA CONEXIÓN</th>
				</tr>
				
			");	
			while ($fila = $queryresult->fetch_assoc() )
			{
				switch ($fila["NIVEL_SEGURIDAD"]) {
					case '1':
						$nSeguridad='Administrador';
						break;
					
					case '2':
						$nSeguridad='Gerente';
						break;
					
					case '3':
						$nSeguridad='Empleado';
						break;		
					
					
				}
			
			printf("
			<tr>
						
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
			
			</tr>
				

		", $fila["USER"], $fila["NIF"], $fila["NOMBRE"], $fila["TELFN"], $nSeguridad, $fila["ULT_CONEXION"] );
		}

			printf("</table>");	

	
		}


	
}
elseif ( isset($_POST["btnSearchNIF"]) ) {
	/*Buscar USUARIOS POR NIF*/
	$nif=$_POST['searchNIF'];

	$sqlquery=" SELECT * FROM USUARIOS WHERE NIF='$nif'; ";
	$queryresult = $mysqli->query($sqlquery);
	$num_filas = $queryresult->num_rows;

		if (! $queryresult)
		{
			printf("No se puede realizar consulta.");
		}
		elseif ($num_filas <= 0)
			printf("No existe el nif introducido");
		else
		{
			logReg("BUSCAR USUARIOS POR NIF: '$nif'");
			printf("
			<form action='/ormag/pdf/generaPDF3.php' method='POST'>
				<input type='submit' name='btnGeneraPDF_SearchNIF' value='Descargar en PDF' />
				<input type='hidden' name='nif' value='%s' />
				
			</form>
			", $nif);
			printf("
			<table>
			<tr> 
				<th colspan='6'> BUSQUEDA DE USUARIOS POR NIF </th> 
				</tr>
				<tr> 
					<th>USUARIO</th>
					<th>NIF</th>
					<th>NOMBRE</th>	
					<th>TELEFONO</th>
					<th>NIVEL DE SEGURIDAD</th>
					<th>ULTIMA CONEXIÓN</th>
				</tr>
				
			");	
			while ($fila = $queryresult->fetch_assoc() )
			{
				switch ($fila["NIVEL_SEGURIDAD"]) {
					case '1':
						$nSeguridad='Administrador';
						break;
					
					case '2':
						$nSeguridad='Gerente';
						break;
					
					case '3':
						$nSeguridad='Empleado';
						break;		
					
					
				}
			
			printf("
			<tr>
						
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
			
			</tr>
				

		", $fila["USER"], $fila["NIF"], $fila["NOMBRE"], $fila["TELFN"], $nSeguridad, $fila["ULT_CONEXION"] );
		}

			printf("</table>");	

	
		}


	
}
elseif ( isset($_POST["btnSearchNombre"]) ) {
	/*Buscar USUARIOS POR NOMBRE*/
	$nombre=$_POST['searchName'];

	$sqlquery=" SELECT * FROM USUARIOS WHERE NOMBRE='$nombre'; ";
	$queryresult = $mysqli->query($sqlquery);
	$num_filas = $queryresult->num_rows;

		if (! $queryresult)
		{
			printf("No se puede realizar consulta.");
		}
		elseif ($num_filas <= 0)
			printf("No existe el nombre introducido");
		else
		{
			logReg("BUSCAR USUARIOS POR NOMBRE: '$nombre'");
			printf("
			<form action='/ormag/pdf/generaPDF4.php' method='POST'>
				<input type='submit' name='btnGeneraPDF_Name' value='Descargar en PDF' />
				<input type='hidden' name='nombre' value='%s' />
			</form>
			", $nombre);
			printf("
			<table>
			<tr> 
				<th colspan='6'> BUSQUEDA DE USUARIOS POR NOMBRE Y APELLIDOS </th> 
				</tr>
				<tr> 
					<th>USUARIO</th>
					<th>NIF</th>
					<th>NOMBRE</th>	
					<th>TELEFONO</th>
					<th>NIVEL DE SEGURIDAD</th>
					<th>ULTIMA CONEXIÓN</th>
				</tr>
				
			");	
			while ($fila = $queryresult->fetch_assoc() )
			{
				switch ($fila["NIVEL_SEGURIDAD"]) {
					case '1':
						$nSeguridad='Administrador';
						break;
					
					case '2':
						$nSeguridad='Gerente';
						break;
					
					case '3':
						$nSeguridad='Empleado';
						break;		
					
					
				}
			
			printf("
			<tr>
						
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
			
			</tr>
				

		", $fila["USER"], $fila["NIF"], $fila["NOMBRE"], $fila["TELFN"], $nSeguridad, $fila["ULT_CONEXION"] );
		}

			printf("</table>");	

	
		}
	
}

else
{
	printf("
	
		<table>
			<th>BUSCAR USUARIOS</th>
		</table>
		<form action='../MostrarRegistros/mostrarRegistros.php' name='formRegistros' method='POST'>
		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchNSeguridad' value='Ver Registro de Actividades' />				
					</th>	
				</tr>
			 </table>
		</div>	
		</form>

		<form action='%s' name='formSearch' method='POST'>
		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchNSeguridad' value='Buscar por Nivel de Seguridad' />				
					</th>	
				</tr>
				<tr>
					<td>					
					<select name='selectNSeg'>
						<option value='1'> Administrador </option>
						<option value='2'> Gerente </option>
						<option value='3'> Empleado </option>
					</select>	
					</td>
				</tr>
			 </table>
		</div>	
		</form>
		
		<form action='%s' name='formSearch1' method='POST'>
		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchUser' value='Buscar por Usuario' />				
					</th>	
				</tr>
				<tr>					
					<td> 
						<input type='text' name='searchUser' size='65&#37;' placeholder='Escriba el nombre del usuario' required='required'/>				
					</td>	
				</tr>
			 </table>
		</div>	
		</form>

		<form action='%s' name='formSearch2' method='POST'>
		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchNIF' value='Buscar por NIF' />				
					</th>	
				</tr>
				<tr>					
					<td> 
						<input type='text' name='searchNIF' size='65&#37;' placeholder='Escriba el NIF a buscar' required='required'/>			
					</td>	
				</tr>
			 </table>
		</div>	
		</form>
		
		<form action='%s' name='formSearch3' method='POST'>
		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchNombre' value='Buscar por NOMBRE' />				
					</th>	
				</tr>
				<tr>					
					<td> 
						<input type='text' name='searchName' size='65&#37;' placeholder='Escriba el Nombre y apellidos a buscar' required='required'/>				
					</td>	
				</tr>
			 </table>
		</div>	
		</form>
		
		<form action='%s' name='formSearch4' method='POST'>
		<div class='centro'>
			<table>
				<tr>					
					<th> 
						<input class='menu' type='submit' name='btnSearchAllUsers' size='65&#37;' value='Buscar Todos los Usuarios'/> 				
					</th>	
				</tr>

			 </table>
		</div>	
		</form>
", $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF'],  $_SERVER['PHP_SELF']);
}

$mysqli->close();

printf("
	</body>
	</html>
");
?>