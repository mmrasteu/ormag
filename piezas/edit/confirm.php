<?php
require('../../comunDB.php');

accesoDenegado();
accesoMedio();

encabezado('ORMAG Confirmar edición de datos de piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
usuario();


	$nSerieNuevo = strtoupper( trim($_POST['nSerieNuevo']) );
	$nSerieAntiguo = strtoupper( trim($_POST['nSerieAntiguo']) );
	$nombre = strtoupper( trim($_POST['nombre']) );
	$marca =  strtoupper( trim($_POST['marca']) );
	$balda =  strtoupper( trim($_POST['balda']) );
	$caja =	  strtoupper( trim($_POST['caja']) );
	$stock =  strtoupper( trim($_POST['stock']) );

	printf("
		<form action='edit.php' name='formEdit' method='POST'>
			<table>
			<tr> 
				<th colspan='6'> CONFIRMAR DATOS NUEVOS DE PIEZAS </th> 
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
				<th colspan='6'> 
								<input type='submit' name='btnConfirmEdit' value='Confirmar' /> 

							<a href='/ormag/piezas/edit/index.php'>
								<input type='button' name='btnCancelar' value='Cancelar' />
							</a>	
				</th> 
			</tr>
			</table>
	", $nSerieNuevo, $nombre, $marca, $balda, $caja, $stock);

	printf("
			<input type='hidden' name='nSerieNuevo' value='%s' />
			<input type='hidden' name='nSerieAntiguo' value='%s' />
			<input type='hidden' name='nombre' value='%s' />
			<input type='hidden' name='marca' value='%s' />
			<input type='hidden' name='balda' value='%s' />
			<input type='hidden' name='caja' value='%d' />
			<input type='hidden' name='stock' value='%d' />

		</form>
		", $nSerieNuevo, $nSerieAntiguo, $nombre, $marca, $balda, $caja, $stock);


	printf("
		</body>
		</html>
	");


?>