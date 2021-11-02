<?php
require('../comunDB.php');

accesoDenegado();
$mysqli=conecta();

/************ GENERAR PDF CON LOS DATOS DE TODOS LOS USUARIOS SEGUN NIVEL DE SEGURIDAD ***************/
	
	$searchNSeguridad=$_POST['searchNSeguridad'];

	$sqlquery=" SELECT * FROM USUARIOS WHERE NIVEL_SEGURIDAD='$searchNSeguridad'; ";
	$queryresult = $mysqli->query($sqlquery);
	if (! $queryresult){
		printf("No se puede realizar consulta.");

	}
	else
	{

	ob_start();

		switch ($searchNSeguridad) {
				case '1':
					$nSeg='Administrador';
					break;
				
				case '2':
					$nSeg='Gerente';
					break;
				
				case '3':
					$nSeg='Empleado';
					break;
		}	

		printf("
		<html>
		<head>
			<meta charset='ISO-8859-1'> 
		</head>
		<body>
		<table width=600 cellpadding=2 cellspacing=0 border=1>
			<tr> <th colspan=6> INFORME DE USUARIOS SEGUN NIVEL DE SEGURIDAD '%s' EN LA BASE DE DATOS ORMAG </th> </tr>
			<tr> <th colspan=6>Fecha: %s </th> </tr>
			<tr> 
				<th>USUARIO</th>
				<th>NIF</th>
				<th>NOMBRE</th>	
				<th>TELEFONO</th>
				<th>NIVEL DE SEGURIDAD</th>
				<th>ULTIMA CONEXION</th>
			</tr>
			
		", $nSeg, date('d F Y H:i:s ') );	
		while ($fila = $queryresult->fetch_assoc() )
		{
			switch ($fila["NIVEL_SEGURIDAD"]) {
				case '1':
					$nSeguridad='Administrador';
					break;
				
				case '2':
					$nSeguridad='Gerente';
					break;
				
				case '3':
					$nSeguridad='Empleado';
					break;		
				
			}
		
		printf("
			<tr>
						
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
			
			</tr>
				

		", $fila["USER"], $fila["NIF"], $fila["NOMBRE"], $fila["TELFN"], $nSeguridad, $fila["ULT_CONEXION"] );
		}


		printf("</table>
			</body>
			</html>");
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "PDFnSeguirdad_".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	}


$mysqli->close();
?>