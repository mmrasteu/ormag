<?php
require('../../comunDB.php');


accesoDenegado();
accesoMedio();

encabezado('ORMAG Borrar datos de piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
usuario();


printf("
	<form action='confirm.php' name='formDelete' method='POST'>
		<table>
		<tr> 
			<th colspan='6'> BORRAR DATOS DE PIEZA </th> 
		</tr>
		<tr> 
			<th>Nº SERIE</th>
		</tr>
		<tr>
			<td> <input type='text' name='nSerie' size='65&#37;' placeholder='Introduzca el número de serie de la pieza a borrar' required='required' /> </td>
		
		<tr> 
			<th colspan='6'> <input type='submit' name='btnDelete' value='Borrar' /> </th> 
		</tr>
		</table>	
	</form>
");

printf("
	</body>
	</html>
");


?>