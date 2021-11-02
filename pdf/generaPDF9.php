<?php
require('../comunDB.php');

accesoDenegado();

ob_start();

libxml_disable_entity_loader(false);
// Carga el fichero XML origen
$xml = new DOMDocument;
$xml->load('../usuario/MostrarRegistros/registro.xml');

$xsl = new DOMDocument;
$xsl->load('../usuario/MostrarRegistros/plantillaRegistro.xsl');

// Configura el procesador
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // adjunta las reglas XSL

/************ GENERAR DATOS DEL REGISTRO DE ACTIVIDADES *********************/



		printf("
				<html>
				<head>
					<meta charset='UTF-8' />
				</head>
				<body>
				<table width=600 cellpadding=2 cellspacing=0 border=1>	
					<tr>
				       	<th colspan='6'> REGISTRO DE ACTIVIDADES</th>
				    </tr>
				    <tr>
				        <th>Usuario</th>
				        <th>Accion</th>
				        <th>Hora</th>
				        <th>Dia</th>
				        <th>Mes</th>
				        <th>Año</th>
				    </tr>
				");

		echo $proc->transformToXML($xml);

		printf("
				</table>	   
				</body>
			    </html>");

require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "PDFlogActividades_".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);