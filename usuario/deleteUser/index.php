<?php
require('../../comunDB.php');


accesoDenegado();
accesoAdministrador();

encabezado('ORMAG Baja de usuario');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuUsuarios.php", "btnVolverAUsuarios", "Volver a Usuarios");
usuario();



printf("
	<form action='confirm.php' name='formDeleteUser' method='POST'>
		<table>
		<tr> 
			<th colspan='6'> DAR DE BAJA A UN USUARIO </th> 
		</tr>
		<tr> 
			<th>USUARIO</th>
		</tr>
		<tr>
			<td> <input type='text' name='user' /> </td>
		
		<tr> 
			<th colspan='6'> <input type='submit' name='btnDeleteUser' value='Dar de baja' /> </th> 
		</tr>
		</table>	
	</form>
");

printf("
	</body>
	</html>
");


?>