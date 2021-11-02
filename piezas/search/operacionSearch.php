<?php
require('../../comunDB.php');

accesoDenegado();

$vuelta = $_POST['vuelta'];

switch ($vuelta) {
	case 'todo':
		$_SESSION["VUELTA"]="TODO";
		break;

	case 'ns':
		$_SESSION["VUELTA"]="NSERIE";
		$_SESSION["SEARCH_NSERIE"]=strtoupper( trim($_POST['NSOculto']));
		break;	

	case 'nombre':
		$_SESSION["VUELTA"]="NOMBRE";
		$_SESSION["SEARCH_NAME"]=strtoupper( trim($_POST['NombreOculto']));
		break;	

	case 'marca':
		$_SESSION["VUELTA"]="MARCA";
		$_SESSION["SEARCH_MARCA"]=strtoupper( trim($_POST['MarcaOculto']));
		break;		
	
	default:
		$_SESSION["VUELTA"]=" ";
		break;
}

encabezado('Buscar Piezas');
btnMov("/cierraSesion.php","btnCerrarSesion","Cerrar Sesion");
btnMov("/menu", "btnVolverMenu", "Volver al Menu");
btnMov("/menu/menuPiezas.php", "btnVolverAPiezas", "Volver a Piezas");
btnMov("/piezas/search", "btnBuscar", "Ir a Buscar");
usuario();

$Nserie = $_POST['NSOculto'];

$mysqli=conecta();

if ( isset($_POST['btnMas']) ){
	$sqlquery=" UPDATE PIEZAS SET STOCK = STOCK+1 WHERE NSERIE='$Nserie'; ";
	$queryresult = $mysqli->query($sqlquery);

	if (! $queryresult){
		printf("No se puede realizar consulta.");
	
	}
	else
	{
		header("location: /ormag/piezas/search/");

	}
}

elseif ( isset($_POST['btnMenos']) ){
	$sqlqueryStock=" SELECT STOCK FROM PIEZAS WHERE NSERIE='$Nserie'; ";
	$queryresultStock = $mysqli->query($sqlqueryStock);
	$fila = $queryresultStock->fetch_assoc();

	if (! $queryresultStock){
		printf("No se puede realizar consulta.");
			
	}
	elseif ($fila["STOCK"] == 0){
		header("location: /ormag/piezas/search");
   
	}
	else{
			$sqlquery=" UPDATE PIEZAS SET STOCK = STOCK-1 WHERE NSERIE='$Nserie'; ";
			$queryresult = $mysqli->query($sqlquery);

			if (! $queryresult){
				printf("No se puede realizar consulta.");
					
						
			}
			else
			{
				header("location: /ormag/piezas/search");
				
			}
	}
}

else 
	printf("<h3> Error </h3>");

$mysqli->close();


?>