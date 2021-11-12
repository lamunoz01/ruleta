<?php
$destino = $_GET["destino"];

if ($destino === 'JUGADORES'){
	require_once '../modelo/ModeloJugadores.php';
	$datos = $_GET["datos"];
	$usumod = new model_jugadores();
			
	switch ($_GET['accion']){
		case 'editar':
			$usumod->editar($datos);
			$lista=$usumod->lista();
			echo json_encode($lista);
			break;
		case 'nuevo':
			$usumod->nuevo($datos);
			$lista=$usumod->lista();	
			echo json_encode($lista);
			break;
		case 'borrar':
			$usumod->borrar($datos);
			$lista=$usumod->lista();	
			echo json_encode($lista);
			break;
		case 'datmodi':
			$lista=$usumod->consul_modi($datos);
			echo json_encode($lista);
			break;		
		case 'busca':
			$lista=$usumod->consulta($datos);
			echo json_encode($lista);
			break;	
		case 'listado':
			$lista=$usumod->lista();
			echo json_encode($lista);
			break;			
	}
}