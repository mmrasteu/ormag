<?php
require('../comunDB.php');

accesoDenegado();
$mysqli=conecta();

/************ GENERAR PDF CON LOS DATOS DE TODAS LAS PIEZAS ***************/

	$sqlquery=" SELECT * FROM PIEZAS ORDER BY BALDA, CAJA, STOCK DESC; ";
	$queryresult = $mysqli->query($sqlquery);
	if (! $queryresult){
		printf("No se puede realizar consulta.");

	}
	else
	{

	ob_start();

		printf("
		<html>
		<head>
			<meta charset='UTF-8' />
		</head>
		<body>
		<table width=600 cellpadding=2 cellspacing=0 border=1>
			<tr> <th colspan=6> INFORME DE TODAS LAS PIEZAS EN LA BASE DE DATOS ORMAG </th> </tr>
			<tr> <th colspan=6>Fecha: %s </th> </tr>
			</tr>
			<tr> 
				<th>N&ordm; SERIE</th>
				<th>NOMBRE</th>
				<th>MARCA</th>	
				<th>BALDA</th>
				<th>CAJA</th>
				<th>STOCK</th>
			</tr>

			
		", date('d F Y H:i:s ') );	
		while ($fila = $queryresult->fetch_assoc() )
		{
		
		
		printf("
			<tr>				
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%d</td>
				<td>%d</td>
			</tr>
				

		", $fila["NSERIE"], $fila["NOMBRE"], $fila["MARCA"], $fila["BALDA"], $fila["CAJA"], $fila["STOCK"]);
		}


		printf("</table>
			</body>
			</html>");
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "PDFallPiezas_".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	}


$mysqli->close();
?>