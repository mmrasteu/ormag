<?php
require('../comunDB.php');
accesoDenegado();

if( $_SESSION["NIVEL_SEGURIDAD"] != 1 )
{
	printf("<script type='text/javascript'>
			alert(' Acceso denegado. No tiene autorización para entrar en esta página %s ');
			setTimeout (window.location='/menu/', 2000); 
	</script>", $_SESSION['USUARIO']);
}

encabezado('ORMAG Menu Database - Usuarios');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
usuario();

printf("
	
	<div>
		<table> 
			<th class='menu'> USUARIOS</th>
		</table> 
	</div>
	
	<br />
		<div class='izquierda'>
			<table>
				<td> 
					<a href='/ormag/usuario/searchUser'> 
						<input class='menu' type='button' name='btnSearchUser' value='Buscar' /> 
					</a> 
				</td> 
			 </table>
		</div>

		<div class='izquierda'>
			<table>
				<td> 
					<a href='/ormag/usuario/insertUser'> 
						<input class='menu' type='button' name='btnInsertUser' value='Dar Alta' /> 
					</a> 
				</td> 
			 </table>
		</div>

		<div class='izquierda'>
			<table>
				<td> 
					<a href='/ormag/usuario/deleteUser'> 
						<input class='menu' type='button' name='btnDeleteUser' value='Dar Baja' /> 
					</a>
				</td> 
			</table>
		</div>

		<div class='izquierda'>
			<table>
				<td> 
					<a href='/ormag/usuario/editUser'> 
						<input class='menu' type='button' name='btnEditUser' value='Editar' /> 
					</a>
				</td> 
			</table> 
		</div>
");

printf("
	</body>
	</html>
");

?>