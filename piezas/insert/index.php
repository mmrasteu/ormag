<?php
require('../../comunDB.php');


accesoDenegado();
accesoMedio();

encabezado('ORMAG Insertar Datos');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
usuario();



printf("
	<form action='confirm.php' name='formInsert' method='POST'>
		<table>
		<tr> 
			<th colspan='6'> INSERTAR DATOS NUEVOS DE PIEZAS </th> 
		</tr>
		<tr> 
			<th>Nº SERIE</th>
			<th>NOMBRE</th>
			<th>MARCA</th>	

		</tr>
		<tr>
			<td> <input type='text' name='nSerie' required='required'/> </td>
			<td> <input type='text' name='nombre' required='required'/> </td>
			<td> <input type='text' name='marca' required='required'/> </td>
		</tr>	
		<tr>
			<th>BALDA</th>
			<th>CAJA</th>
			<th>STOCK</th>
		</tr>
		<tr>	
			<td> <input type='text' name='balda' required='required'/> </td>
			<td> <input type='number' name='caja' value='0'  required='required'/> </td>
			<td> <input type='number' name='stock' value='0' required='required'/> </td>
		</tr>	
		
		<tr> 
			<th colspan='6'> <input type='submit' name='btnInsert' value='Insertar' /> </th> 
		</tr>
		</table>	
	</form>
");

printf("
	</body>
	</html>
");


?>