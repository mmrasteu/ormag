<?php
require('../comunDB.php');

accesoDenegado();

encabezado('ORMAG Menu Database');
btnMov("/cierraSesion.php", "btnCerrarSesion" ,"Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/mensajes/mensajesEnviados.php", "btnMensajesEnviados" ,"Mensajes Enviados");
btnMov("/mensajes/enviarMensaje.php", "btnEnviarMensaje" ,"Redactar Mensaje");
printf("
	<br />
	<br />
	<br />
	<br />
	<br />
	");

$mysqli=conecta();



if (isset($_POST['btnMostrarNoLeidos']) && $_POST['btnMostrarNoLeidos'] == 'Mostrar mensajes no leidos')
{
		printf("
			<a href='/ormag/mensajes'> 
				<input class='menu-superior' type='button' 
									name='btnVolverAlBuzon' value='Volver al Buzón' /> 
			</a>
			<table>
			<tr> <th colspan='7'> Mensajes No Leidos de %s </th> </tr>
		", $_SESSION['USUARIO']);

		$id=$_SESSION['ID_USER'];
			
		$sqlquery="SELECT LEIDO, FECHA, USUARIOS.USER AS EMISOR, TITULO, ID_MENSAJE 
					FROM MENSAJES INNER JOIN USUARIOS 
					ON ID_EMISOR = ID_USER 
					WHERE ID_RECEPTOR='$id' AND LEIDO=0; ";
		$queryresult=$mysqli->query($sqlquery);

		while ($fila = $queryresult->fetch_assoc() )
		{
			if($fila['LEIDO'] == 0) 		//* SI LEIDO VALE 0 EL MENSAJE NO SE HA LEIDO
				$leido='NO LEIDO';
			else 							//* SI NO VALE 0 SIGNIFICA QUE SE HA LEIDO
				$leido='LEIDO';	

			printf("
				<tr> 
					<td style='text-align: left;'>%s</td> 
					<td style='text-align: left;'>Fecha: %s</td> 
					<td style='text-align: left;'>De: %s</td> 
					<td style='text-align: left;'>Asunto: %s</td>

					<form action='/ormag/mensajes/mensaje.php' value='formLeerMensaje' method='POST'> 
						<td> <input type='submit' name='btnLeer' value='LEER' /> </td> 
						<td> <input type='submit' name='btnMarcaLeido' value='Marcar como no leido' />  </td>
						<td> <input type='submit' name='btnBorrarMensaje' value='Borrar' />  </td>
						<input type='hidden' name='idMensaje' value='%s' />
					</form> 
				</tr>
			", $leido ,$fila['FECHA'], $fila['EMISOR'], $fila['TITULO'], $fila['ID_MENSAJE'] );
		}
}

elseif (isset($_POST['btnMostrarLeidos']) && $_POST['btnMostrarLeidos'] == 'Mostrar mensajes leidos')
{

		printf("
			<a href='/ormag/mensajes'> 
				<input class='menu-superior' type='button' 
									name='btnVolverAlBuzon' value='Volver al Buzón' /> 
			</a>
			<table>
			<tr> <th colspan='7'> Mensajes Leidos de %s </th> </tr>
		", $_SESSION['USUARIO']);

		$id=$_SESSION['ID_USER'];
			
		$sqlquery="SELECT LEIDO, FECHA, USUARIOS.USER AS EMISOR, TITULO, ID_MENSAJE 
					FROM MENSAJES INNER JOIN USUARIOS 
					ON ID_EMISOR = ID_USER 
					WHERE ID_RECEPTOR='$id' AND LEIDO=1; ";
		$queryresult=$mysqli->query($sqlquery);

		while ($fila = $queryresult->fetch_assoc() )
		{
			if($fila['LEIDO'] == 0) 		//* SI LEIDO VALE 0 EL MENSAJE NO SE HA LEIDO
				$leido='NO LEIDO';
			else 							//* SI NO VALE 0 SIGNIFICA QUE SE HA LEIDO
				$leido='LEIDO';	

			printf("
				<tr> 
					<td style='text-align: left;'>%s</td> 
					<td style='text-align: left;'>Fecha: %s</td> 
					<td style='text-align: left;'>De: %s</td> 
					<td style='text-align: left;'>Asunto: %s</td>

					<form action='/ormag/mensajes/mensaje.php' value='formLeerMensaje' method='POST'> 
						<td> <input type='submit' name='btnLeer' value='LEER' /> </td> 
						<td> <input type='submit' name='btnMarcaLeido' value='Marcar como no leido' />  </td>
						<td> <input type='submit' name='btnBorrarMensaje' value='Borrar' />  </td>
						<input type='hidden' name='idMensaje' value='%s' />
					</form> 
				</tr>
			", $leido ,$fila['FECHA'], $fila['EMISOR'], $fila['TITULO'], $fila['ID_MENSAJE'] );
		}
}
else{
		printf("
		<form action='%s' name='formmm' method='POST'>
			<input class='menu-superior' type='submit' name='btnMostrarNoLeidos' value='Mostrar mensajes no leidos' />
			<input class='menu-superior' type='submit' name='btnMostrarLeidos' value='Mostrar mensajes leidos' />
		</form>", $_SERVER['PHP_SELF']);

		printf("
			<table>
			<tr> <th colspan='7'> Buzón de entrada de %s </th> </tr>
		", $_SESSION['USUARIO']);

		$id=$_SESSION['ID_USER'];
			
		/*$sqlquery="SELECT * FROM MENSAJES WHERE ID_RECEPTOR='$id'; ";*/
		$sqlquery="SELECT LEIDO, FECHA, USUARIOS.USER AS EMISOR, TITULO, ID_MENSAJE 
					FROM MENSAJES INNER JOIN USUARIOS 
					ON ID_EMISOR = ID_USER 
					WHERE ID_RECEPTOR = '$id';";

		$queryresult=$mysqli->query($sqlquery);

		while ($fila = $queryresult->fetch_assoc() )
		{
			if($fila['LEIDO'] == 0) 		//* SI LEIDO VALE 0 EL MENSAJE NO SE HA LEIDO
				$leido='NO LEIDO';
			else 							//* SI NO VALE 0 SIGNIFICA QUE SE HA LEIDO
				$leido='LEIDO';	

			printf("
				<tr> 
					<td style='text-align: left;'>%s</td> 
					<td style='text-align: left;'>Fecha: %s</td> 
					<td style='text-align: left;'>De: %s</td> 
					<td style='text-align: left;'>Asunto: %s</td>

					<form action='/ormag/mensajes/mensaje.php' name='formLeerMensaje' method='POST'> 
						<td> <input type='submit' name='btnLeer' value='LEER' /> </td> 
						<td> <input type='submit' name='btnMarcaLeido' value='Marcar como no leido' />  </td>
						<td> <input type='submit' name='btnBorrarMensaje' value='Borrar' />  </td>
						<input type='hidden' name='idMensaje' value='%s' />
					</form> 
				</tr>
			", $leido ,$fila['FECHA'], $fila['EMISOR'], $fila['TITULO'], $fila['ID_MENSAJE'] );
		}

}

$mysqli->close();

printf("

	</body>
	</html>
");
?>