<?php
require('../comunDB.php');
accesoDenegado();

encabezado('ORMAG Menu Database');
btnMov("/cierraSesion.php", "btnCerrarSesion" ,"Cerrar Sesion");
usuario();



printf("
			<div class='center'>
			<a href='/ormag/menu/menuPiezas.php'> 
				<div class='izquierda'> 
					<img class='icono' src='/ormag/style/engranage.png' /> 
					<br /> 
					<h1 class='icono'> PIEZAS </h1> 
				</div>
			</a>

			<a href='/ormag/menu/menuUsuarios.php'> 
				<div class='derecha'> 
					<img class='icono' src='/ormag/style/usuario.png' /> 
					<br /> 
					<h1> USUARIOS </h1> 
				</div>
			</a>
			</div>
			
" );

printf("

	</body>
	</html>
");




?>