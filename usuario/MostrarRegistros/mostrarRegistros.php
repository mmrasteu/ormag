
<?php
require('../../comunDB.php');

libxml_disable_entity_loader(false);
// Carga el fichero XML origen
$xml = new DOMDocument;
$xml->load('registro.xml');

$xsl = new DOMDocument;
$xsl->load('plantillaRegistro.xsl');

// Configura el procesador
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // adjunta las reglas XSL

accesoDenegado();
accesoAdministrador();

encabezado('ORMAG Registro de Actividades');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuUsuarios.php", "btnVolverAUsuarios", "Volver a Usuarios");
btnMov("/usuario/searchUser", "btnBuscar", "Ir a Buscar");
usuario();

printf("
			<form action='../../pdf/generaPDF9.php' method='POST'>
				<input type='submit' name='btnGeneraPDF_log' value='Descargar en PDF' />
			</form>
			");

print("
	    <table>
		        <tr>
		        	<th class='menu' colspan='6'> REGISTRO DE ACTIVIDADES</th>
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

?>


