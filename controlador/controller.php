<?php
$destino = $_GET["destino"];

require_once '../modelo/ModeloJugadores.php';
require_once '../modelo/ModeloRuleta.php';

$usumod = new model_jugadores();
$rulemod = new model_ruleta();

if ($destino === 'JUGADORES'){

	if(isset($_GET['datos'])) {
		$datos = $_GET["datos"];
	}else{
		$datos = null;
	}
			
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
		case 'listaJugadores':
			$lista=$usumod->listaJugadores($datos);
			echo json_encode($lista);
			break;			
	}
}

if ($destino === 'RULETA'){
	if(isset($_GET['datos'])) {
		$datos = $_GET["datos"];
	}else{
		$datos = null;
	}
	
	switch ($_GET['accion']){
		case 'guardarApuesta':
			$resconmodi = $usumod->consul_modi($datos['JUGADOR']);

			$saldo = $resconmodi[0]['SALDO'];

			if( $saldo <= 1000){
				$vlrApuesta = $saldo;
			}else{
				$vlrApuesta = ($saldo*$datos['PORCENTAJE_APUESTA']);
			}

			$datos['VALOR_APUESTA'] = $vlrApuesta;
			$lista=$rulemod->guardarApuesta($datos);
			echo json_encode($lista);
			break;
		case 'girarRuleta':
			$lista=$rulemod->girarRuleta($datos);
			echo json_encode($lista);
			break;			
	}
}