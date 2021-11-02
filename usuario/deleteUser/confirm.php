<?php
require('../../comunDB.php');


accesoDenegado();
accesoAdministrador();

encabezado('ORMAG Confirmar baja de usuario');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuUsuarios.php", "btnVolverAUsuarios", "Volver a Usuarios");
usuario();


$mysqli=conecta();
	
	$user=$_POST['user'];

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
			printf("
				
			<table>
			<tr> 
				<th colspan='6'> USUARIOS </th> 
				</tr>
				<tr> 
					<th>USUARIO</th>
					<th>NIF</th>
					<th>NOMBRE</th>	
					<th>TELEFONO</th>
					<th>NIVEL DE SEGURIDAD</th>
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
				
				</tr>
					

			", $fila["USER"], $fila["NIF"], $fila["NOMBRE"], $fila["TELFN"], $nSeguridad );
			}

			

	
		}	

					

		printf("

		<form action='deleteUser.php' name='formDeleteUser' method='POST'>
			<tr> 
				<th colspan='6'> 
						<input type='submit' name='btnConfirmDelete' value='Confirmar' /> 
						<a href='/usuario/deleteUser'>
							<input type='button' name='btnCancelar' value='Cancelar' />
						</a>	
				</th> 

				<input type='hidden' name='userDelete' value='%s' />
			</tr>
			</table>
		</form>
		", $user);

	$mysqli->close();	
	
	printf("
		</body>
		</html>
	");


?>