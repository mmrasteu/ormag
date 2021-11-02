<?php
require('../../comunDB.php');

accesoDenegado();
accesoAdministrador();

encabezado('ORMAG Alta de usuarios');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuUsuarios.php", "btnVolverAUsuarios", "Volver a Usuarios");
usuario();


printf("
	<form action='insertUser.php' name='formInsertUser' method='POST'>
		<table>
		<tr> 
			<th colspan='6'> DAR DE ALTA A UN USUARIO </th> 
		</tr>

		<tr>
			<th>USUARIO</th> 
			<td> <input type='text' name='user' required='required'/> </td>	
		</tr>
		<tr>
			<th>CONTRASEÑA</th> 
			<td> <input type='password' name='passwd' pattern='[A-Za-z0-9!?-]{8,12}' required='required'/> </td>	
		</tr>
		<tr>
			<th>REPETIR CONTRASEÑA</th> 
			<td> <input type='password' name='passwdRep' pattern='[A-Za-z0-9!?-]{8,12}' required='required'/> </td>	
		</tr>
		<tr>
			<th>NIF</th> 
			<td> <input type='text' name='nif' required='required'/> </td>	
		</tr>
		<tr>
			<th>NOMBRE</th> 
			<td> <input type='text' name='nombre' required='required'/> </td>	
		</tr>
		<tr>
			<th>TELEFONO</th> 
			<td> <input type='text' name='telfn' required='required'/> </td>	
		</tr>
		<tr>
			<th>NIVEL DE SEGURIDAD</th> 
			<td> <select name='nSeg'> 
					<option value='1'>Administrador</option>
					<option value='2'>Gerente</option>
					<option value='3'>Empleado</option>  
				</select>	
			</td>	
		</tr>		
		
		<tr> 
			<th colspan='6'> <input type='submit' name='btnInsertUser' value='Dar de alta' /> </th> 
		</tr>
		</table>
		<br/>
		<h5> *La contraseña debe tener entre 8 y 12 caracteres y debe contener como minimo una minuscula, una mayuscula y un número* </h5>	
	</form>
");

printf("
	</body>
	</html>
");


?>