<?php
require('../comunDB.php');

accesoDenegado();

encabezado('ORMAG Menu Database');
btnMov("/cierraSesion.php", "btnCerrarSesion" ,"Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/mensajes", "btnVolverAMensaje" ,"Volver al Buzón");
btnMov("/mensajes/mensajesEnviados.php", "btnMensajesEnviados" ,"Mensajes Enviados");
btnMov("/mensajes/enviarMensaje.php", "btnEnviarMensaje" ,"Redactar Mensaje");

if (isset($_POST['btnLeer']) && $_POST['btnLeer'] == 'LEER')
{
		$id=$_SESSION['ID_USER'];
		$idMensaje=$_POST['idMensaje'];

		$mysqli=conecta();

		$sqlquery="SELECT LEIDO, FECHA, USUARIOS.USER AS EMISOR, TITULO, TEXTO
					FROM MENSAJES INNER JOIN USUARIOS 
					ON ID_EMISOR = ID_USER 
					WHERE ID_RECEPTOR='$id' AND ID_MENSAJE='$idMensaje'; ";
		$queryresult=$mysqli->query($sqlquery);
		$fila = $queryresult->fetch_assoc();

		printf("

			<table>
				<tr> <th colspan='3'> ASUNTO: %s </th> </tr>
				<tr> <th> DE: %s </th> <th> PARA: %s </th> <th> FECHA: %s</th></tr>
				<tr> <td colspan='3'> <textarea name='mensaje' rows='15' cols='150' readonly='readonly'> %s </textarea> </td> </tr>
			</table>
			", $fila['TITULO'], $fila['EMISOR'], $_SESSION['USUARIO'], $fila['FECHA'], $fila['TEXTO']);


		if($fila['LEIDO']==0){
			$sqlupdate=" UPDATE MENSAJES SET LEIDO=1 WHERE ID_MENSAJE='$idMensaje' ; ";
			
			$queryresult = $mysqli->query($sqlupdate);

				if (! $queryresult)
					{
					printf("<script type='text/javascript'>
							alert(' No se puede realizar la consulta ');
							setTimeout (window.location='./index.php', 2000); 
						</script>");
					}

		}

		$mysqli->close();
}
elseif(isset($_POST['btnLeerEnviados']) && $_POST['btnLeerEnviados'] == 'LEER')
{
		$idMensaje=$_POST['idMensaje'];

		$mysqli=conecta();

		$sqlquery="SELECT FECHA, USUARIOS.USER AS RECEPTOR, TITULO, TEXTO
					FROM MENSAJES INNER JOIN USUARIOS 
					ON ID_RECEPTOR = ID_USER  
					WHERE ID_MENSAJE='$idMensaje'; ";
		$queryresult=$mysqli->query($sqlquery);
		$fila = $queryresult->fetch_assoc();

		printf("

			<table>
				<tr> <th colspan='3'> ASUNTO: %s </th> </tr>
				<tr> <th> DE: %s </th> <th> PARA: %s </th> <th> FECHA: %s</th></tr>
				<tr> <td colspan='3'> <textarea name='mensaje' rows='15' cols='140' readonly='readonly'> %s </textarea> </td> </tr>
			</table>
			", $fila['TITULO'], $_SESSION['USUARIO'], $fila['RECEPTOR'], $fila['FECHA'], $fila['TEXTO']);



		$mysqli->close();
}
elseif(isset($_POST['btnMarcaLeido']) && $_POST['btnMarcaLeido'] == 'Marcar como no leido')
{
		$idMensaje=$_POST['idMensaje'];

		$mysqli=conecta();

		$sqlupdate=" UPDATE MENSAJES SET LEIDO=0 WHERE ID_MENSAJE='$idMensaje'; ";
		$queryresult = $mysqli->query($sqlupdate);

				if (! $queryresult)
					{
					printf("<script type='text/javascript'>
							alert(' No se puede realizar la consulta ');
							setTimeout (window.location='./index.php', 2000); 
						</script>");
					}

		$mysqli->close();
		header("location: ./");
}
elseif(isset($_POST['btnBorrarMensaje']) && $_POST['btnBorrarMensaje'] == 'Borrar')
{
		$idMensaje=$_POST['idMensaje'];

		$mysqli=conecta();

		$sqldelete=" DELETE FROM MENSAJES WHERE ID_MENSAJE='$idMensaje'; ";
		$queryresultdelete = $mysqli->query($sqldelete);

				if (! $queryresultdelete)
					{
					printf("<script type='text/javascript'>
							alert(' No se puede realizar la consulta ');
							setTimeout (window.location='./index.php', 2000); 
						</script>");
					}

		$mysqli->close();
		header("location: ./");
}
else
header("location: /ormag/menu");

printf("

	</body>
	</html>
");
?>