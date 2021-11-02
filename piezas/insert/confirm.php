<?php
require('../../comunDB.php');


accesoDenegado();
accesoMedio();

encabezado('ORMAG Confirmar inserccion de datos de piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
usuario();


	$nSerie = strtoupper( trim($_POST['nSerie']) );
	$nombre = strtoupper( trim($_POST['nombre']) );
	$marca =  strtoupper( trim($_POST['marca']) );
	$balda =  strtoupper( trim($_POST['balda']) );
	$caja =	  strtoupper( trim($_POST['caja']) );
	$stock =  strtoupper( trim($_POST['stock']) );

	printf("
		<form action='insert.php' name='formInsert' method='POST'>
			<table>
			<tr> 
				<th colspan='6'> CONFIRMAR DATOS DE PIEZAS </th> 
			</tr>
			<tr> 
				<th>Nº SERIE</th>
				<th>NOMBRE</th>
				<th>MARCA</th>	
				<th>BALDA</th>
				<th>CAJA</th>
				<th>STOCK</th>
			</tr>
			<tr>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %s </h3> </td>
				<td> <h3> %d </h3> </td>
				<td> <h3> %d </h3> </td>
			</tr>
			<tr> 
				<th colspan='6'> <input type='submit' name='btnConfirmInsert' value='Confirmar' /> 
								 <a href='/ormag/piezas/insert/index.php'>
								 	<input type='button' name='btnCancelar' value='Cancelar' />
								 </a>	
				</th> 
			</tr>
			</table>
	", $nSerie, $nombre, $marca, $balda, $caja, $stock);

	printf("
			<input type='hidden' name='nSerie' value='%s' />
			<input type='hidden' name='nombre' value='%s' />
			<input type='hidden' name='marca' value='%s' />
			<input type='hidden' name='balda' value='%s' />
			<input type='hidden' name='caja' value='%d' />
			<input type='hidden' name='stock' value='%d' />

		</form>
		", $nSerie, $nombre, $marca, $balda, $caja, $stock);
	
	printf("
		</body>
		</html>
	");


?>