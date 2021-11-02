<?php
require('../comunDB.php');
accesoDenegado();

encabezado('ORMAG Menu Database - Piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
usuario();

printf("
	
	<div>
		<table> 
			<th class='menu'> PIEZAS</th>
		</table> 
	</div>

	<div class='centro'>
		<div class='izquierda'>
			<table>
				<td> 
					<a href='/ormag/piezas/search'> 
						<input class='menu' type='button' name='btnSearch' value='Buscar' /> 
					</a> 
				</td> 
			 </table>
		</div>

		<div class='izquierda'>
			<table>
				<td> 
					<a href='/ormag/piezas/insert'> 
						<input class='menu' type='button' name='btnInsert' value='Insertar' /> 
					</a> 
				</td> 
			 </table>
		</div>

		<div class='izquierda'>
			<table>
				<td> 
					<a href='/ormag/piezas/delete'> 
						<input class='menu' type='button' name='btnDelete' value='Borrar' /> 
					</a> 
				</td> 
			</table>
		</div>

		<div class='izquierda'>
			<table>
				<td> 
					<a href='/ormag/piezas/edit'> 
						<input class='menu' type='button' name='btnEdit' value='Editar' /> 
					</a> 
				</td> 
			</table> 
		</div>
	</div>
");

printf("
	</body>
	</html>
");

?>