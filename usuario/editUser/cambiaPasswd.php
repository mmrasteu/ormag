<?php
require('../../comunDB.php');


accesoDenegado();
accesoAdministrador();

encabezado('ORMAG Cambiar contraseña usuario');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuUsuarios.php", "btnVolverAUsuarios", "Volver a Usuarios");
btnMov("/usuario/editUser", "btnEditarUsuario", "Ir a Editar Usuario");		

usuario();


$mysqli=conecta();
if ( isset($_POST["btnEditPasswd"]) ) {

	$user=$_POST['user'];
	$passwd=$_POST['passwd'];
	$passwdRep=$_POST['passwdRep'];

	if ($passwd != $passwdRep)
	{
		printf("<script type='text/javascript'>
					alert(' Las contraseñas no coincicen ');
				</script>");
	}
	else{

		$sqlinsert=" UPDATE USUARIOS SET USER='$user', PASSWD=MD5('$passwd')  WHERE USER='$user' ; ";
		
		$queryresult = $mysqli->query($sqlinsert);
			if (! $queryresult)
				{
				printf("<script type='text/javascript'>
							alert(' No se puede realizar consulta ');
							setTimeout (window.location='./index.php', 2000); 
						</script>");
				
				}
			else
				{
				 logReg("CAMBIAR CONTRASEÑA DE USUARIO: '$user'");
				 printf("<script type='text/javascript'>
						alert(' Los datos han sido editados satisfactoriamente ');
						setTimeout (window.location='./index.php', 2000); 
					</script>");
				}


	}
}
else{

	printf("
	<form action='%s' name='formEditPasswd' method='POST'>
		<table>
		<tr>
		<th colspan='2'> EDITAR CONTRASEÑA</th> 
		</tr>
		<tr>	
				<th> USUARIO </th><td> <input type='text' name='user' required='required'/> </td> 
		</tr>
		<tr>	
				<th> CONTRASEÑA NUEVA </th><td> <input type='password' name='passwd' pattern='[A-Za-z0-9!?-]{8,12}' required='required'/> </td> 
		</tr>
		<tr>	
				<th> REPETIR CONTRASEÑA </th><td> <input type='password' name='passwdRep' pattern='[A-Za-z0-9!?-]{8,12}' required='required'/> </td> 
		</tr>

		<tr>	
				<th> <input type='submit' name='btnEditPasswd' value='Cambiar Contraseña' /> </th> 
		</tr>
		
		</table>
		<br/>
		<h5> *La contraseña debe tener entre 8 y 12 caracteres y debe contener como minimo una minuscula, una mayuscula y un número* </h5>		
	</form>
", $_SERVER['PHP_SELF']);
}


$mysqli->close();

	printf("
		</body>
		</html>
	");
