<?php
require('../comunDB.php');

accesoDenegado();

encabezado('ORMAG Menu Database');
btnMov("/cierraSesion.php", "btnCerrarSesion" ,"Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/mensajes", "btnVolverAMensaje" ,"Volver al Buzón");
btnMov("/mensajes/enviarMensaje.php", "btnEnviarMensaje" ,"Redactar Mensaje");

$mysqli=conecta();

printf("
	<br />
	<br />
	<br />
	<br />
	<br />
	<table>
	<tr> <th colspan='4'> Mensajes enviados de %s </th> </tr>
", $_SESSION['USUARIO']);

$id=$_SESSION['ID_USER'];
	
$sqlquery="SELECT FECHA, USUARIOS.USER AS RECEPTOR, TITULO, ID_MENSAJE
				FROM MENSAJES INNER JOIN USUARIOS 
				ON ID_RECEPTOR = ID_USER  
				WHERE ID_EMISOR='$id'; ";
$queryresult=$mysqli->query($sqlquery);

while ($fila = $queryresult->fetch_assoc() )
{

	printf("
		<tr> 
			<td>Fecha: %s</td> 
			<td>Para: %s</td> 
			<td>Asunto: %s</td>

			<form action='/ormag/mensajes/mensaje.php' value='formLeerMensaje' method='POST'> 
				<td> <input type='submit' name='btnLeerEnviados' value='LEER' /> </td> 
				<input type='hidden' name='idMensaje' value='%s' />
			</form> 
		</tr>
	",$fila['FECHA'], $fila['RECEPTOR'], $fila['TITULO'], $fila['ID_MENSAJE'] );
}



$mysqli->close();

printf("

	</body>
	</html>
");
?>