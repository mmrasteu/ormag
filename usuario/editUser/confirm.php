<?php
require('../../comunDB.php');

accesoDenegado();
accesoAdministrador();

encabezado('ORMAG Confirmar edición de datos de usuario');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuUsuarios.php", "btnVolverAUsuarios", "Volver a Usuarios");
usuario();

	$usuarioNuevo=$_POST['usuarioNuevo'];
	$usuarioAntiguo=$_POST['usuarioAntiguo'];
	$nif=$_POST['nif'];
	$nombre=$_POST['nombre'];
	$telefono=$_POST['telefono'];
	$nSeguridad=$_POST['nSeguridad'];

	printf("
			<form action='editUser.php' name='formEditUser' method='POST'>
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
			
				switch ($nSeguridad) 
				{
					case '1':
						$nivelSeguridad='Administrador';
						break;
					
					case '2':
						$nivelSeguridad='Gerente';
						break;
					
					case '3':
						$nivelSeguridad='Empleado';
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
				<tr> 
				<th colspan='5'> 
					<input type='submit' name='btnConfirmDeleteUser' value='Confirmar' /> 
					<a href='/usuario/editUser'>
							<input type='button' name='btnCancelar' value='Cancelar' />
					</a>	
				</th> 
			</tr>
			</table>
			",$usuarioNuevo, $nif, $nombre, $telefono, $nivelSeguridad  );

	printf("
		
			<input type='hidden' name='usuarioNuevo' value='%s' />
			<input type='hidden' name='usuarioAntiguo' value='%s' />
			<input type='hidden' name='nif' value='%s' />
			<input type='hidden' name='nombre' value='%s' />
			<input type='hidden' name='telefono' value='%s' />
			<input type='hidden' name='nSeguridad' value='%d' />
		</form>
		", $usuarioNuevo, $usuarioAntiguo, $nif, $nombre, $telefono, $nSeguridad);

	
	printf("
		</body>
		</html>
	");


?>