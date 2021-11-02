<?php
require('../comunDB.php');

accesoDenegado();

encabezado('ORMAG Menu Database');
btnMov("/cierraSesion.php", "btnCerrarSesion" ,"Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/mensajes", "btnVolverAMensaje" ,"Volver al Buzón");
btnMov("/mensajes/mensajesEnviados.php", "btnMensajesEnviados" ,"Mensajes Enviados");




if (isset($_POST['btnEnviar']) && $_POST['btnEnviar'] == 'Enviar Mensaje')
{
	$mysqli=conecta();

	$idEmisor=$_SESSION['ID_USER'];
	$receptor=$_POST['receptor'];
	$asunto=$_POST['asunto'];
	$mensaje=$_POST['mensaje'];

	$sqlqueryReceptor="SELECT * FROM USUARIOS WHERE USER='$receptor'; ";
	$queryresultReceptor=$mysqli->query($sqlqueryReceptor);
	$filaReceptor = $queryresultReceptor->fetch_assoc();

	$row_cnt = $queryresultReceptor->num_rows;
	if ($row_cnt != 1)
	{
		 printf("<script type='text/javascript'>
					alert(' El usuario no existe ');
					setTimeout (window.location='./enviarMensaje.php', 2000); 
				</script>");
	} 	
	else{
		if (! $queryresultReceptor )
			{
			printf("<script type='text/javascript'>
					alert(' No se puede realizar la consulta ');
					setTimeout (window.location='./enviarMensaje.php', 2000); 
				</script>");
			
			}
		else
			{
			 $idReceptor=$filaReceptor['ID_USER'];
			}
	}

	$sqlqueryMensaje="INSERT INTO MENSAJES(ID_EMISOR, ID_RECEPTOR, TITULO, LEIDO, TEXTO, FECHA) 
						VALUES ('$idEmisor', '$idReceptor', '$asunto', DEFAULT ,'$mensaje', DEFAULT);";
	$queryresultMensaje=$mysqli->query($sqlqueryMensaje);
		if (! $queryresultMensaje )
				{
				printf("<script type='text/javascript'>
						alert(' No se puede enviar el mensaje ');
						setTimeout (window.location='./enviarMensaje.php', 2000); 
					</script>");
				
				}
		else
			{
			 	printf("<script type='text/javascript'>
					alert(' Mensaje enviado correctamente ');
					setTimeout (window.location='./enviarMensaje.php', 2000); 
				</script>");
			}		

	$mysqli->close();
}

elseif (isset($_POST['btnCancelar']) && $_POST['btnCancelar'] == 'Cancelar') 
header("location: /ormag/mensajes/enviarMensaje.php");
else{

	printf("
		<form action='%s' name='formEnviarMensaje' method='POST'>
			<table>
				<tr> 
					<th colspan='2'> 
						Enviar Mensaje 
					</th> 
				</tr>
				<tr> 
					<td colspan='2' style='text-align: left;'> 
						Asunto: <input type='text' name='asunto' required='required' /> 
					</td> 
				</tr>
				<tr> 
					<td colspan='2' style='text-align: left;'> 
						Para: <input type='text' name='receptor' required='required' />  
					</td> 
				</tr>
				<tr> 
					<td colspan='2'>
						<textarea name='mensaje' rows='15' cols='140'>Escriba aqui su mensaje...</textarea> 
					</td> 
				</tr>
				<tr>
					<td>
						<input type='submit' name='btnEnviar' value='Enviar Mensaje' />
					</td>
					<td>
						<input type='submit' name='btnCancelar' value='Cancelar' />
					</td>
			</table>
		</form>
	", $_SERVER['PHP_SELF']);
}





printf("
	</body>
	</html>
");
?>