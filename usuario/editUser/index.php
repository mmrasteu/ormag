<?php
require('../../comunDB.php');


accesoDenegado();
accesoAdministrador();

encabezado('ORMAG Editar datos de usuario');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuUsuarios.php", "btnVolverAUsuarios", "Volver a Usuarios");
usuario();


$mysqli=conecta();

if ( isset($_POST["btnEditUser"]) ) {

	$editUser=$_POST['editUser'];

	$sqlquery=" SELECT * FROM USUARIOS WHERE USER = '$editUser'; ";
	$queryresult = $mysqli->query($sqlquery);
	if (! $queryresult){
		printf("No se puede realizar consulta.");


	}
	else
	{
		printf("
		<table>
			<tr> 
				<th colspan='6'> USUARIO A EDITAR </th> 
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
		
				

		printf("
			<tr>
			<form action='confirm.php' name='formConfirmEdit' method='POST'>
				
				<td> <input type='text' name='usuarioNuevo' value='%s' </td>
				<td> <input type='text' name='nif' value='%s' </td>
				<td> <input type='text' name='nombre' value='%s' </td>
				<td> <input type='text' name='telefono' value='%s' </td>
				<td> <select name='nSeguridad'>
			
			",  $fila["USER"], $fila["NIF"], $fila["NOMBRE"], $fila["TELFN"]);

			switch ($fila["NIVEL_SEGURIDAD"]) {
					case '1':
						printf("<option value='1' selected='selected'> Administrador </option>
								<option value='2'> Gerente </option>
								<option value='3'> Empleado </option>");
						break;
					
					case '2':
						printf("<option value='1'> Administrador </option>
								<option value='2' selected='selected'> Gerente </option>
								<option value='3'> Empleado </option>");
						break;
					
					case '3':
						printf("<option value='1'> Administrador </option>
								<option value='2'> Gerente </option>
								<option value='3' selected='selected'> Empleado </option>");
						break;		
					
					
				}
			printf("
				</select> 
				</td>
			</tr>	
				<input type='hidden' value='%s' name='usuarioAntiguo' />
			<tr> 
			<th colspan='6'> 
						<input type='submit' name='btnEdit' value='Editar' /> 
						<a href='/usuario/editUser'>
							<input type='button' name='btnCancelar' value='Cancelar' />
						</a>	
				</th> 
			</tr>
			</form>	
			",$fila["USER"]);
		}

		printf("</table>");

	}
}



else{

	printf("
	<form action='%s' name='formEdit' method='POST'>
		<table>
		<tr>
		<th> EDITAR USUARIOS</th> 
		</tr>
		<tr>	
				<th> <input class='menu' type='submit' name='btnEditUser' value='Editar' /> </th> 
		</tr>
		<tr>	
				<td> <input type='text' name='editUser' placeholder='Escriba el usuario' required='required' /> </td> 
		</tr>
		</table>	
	</form>

	<h5> <a href='cambiaPasswd.php'> ¿Cambiar la contraseña? </a> 
	<br>
			
", $_SERVER['PHP_SELF']);
}


$mysqli->close();


printf("
	</body>
	</html>
");
?>