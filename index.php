<?php
	require_once 'modelo/ModeloRuleta.php';
	$modruleta=new model_ruleta();
	$datini=$modruleta->datosIniciales();
	$listaNum=$modruleta->listaNumeros();
	$listaJug=$modruleta->listaJugadores();
	$listaRon=$modruleta->listaRondas();
	$listaApu=$modruleta->listaApuestas();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Principal</title>
	<?php include_once('php/header.php'); ?>
</head>
<body>     
	<div class="container py-5">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h2 class="text-center">Ruleta</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 text-right">
				<button type="button" class="btn btn-info" onclick="VistaJugadores();">Jugadores</button>
			</div>
		</div>
		<hr>
		<div class="row text-center">
			<?php for($i=0;$i<count($listaNum);$i++){?>
				<div class="col-lg-1 col-md-1 col-3">
					<button class="buttonRul" onclick="apostar(<?php echo $listaNum[$i]['NUMERO'];?>)" style="background-color: <?php echo $listaNum[$i]['COLOR']; ?> ;">
						<?php $num = $listaNum[$i]['NUMERO']; if( $num < 10){  $num = "&nbsp;".$listaNum[$i]['NUMERO']."&nbsp;"; }; echo $num; ?>
					</button>
				</div>
			<?php }?>
		</div>
		<hr>
		<div class="row text-center">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h2 class="">Jugadores / Apuestas</h2>
			</div>
		</div>
		<hr>
		<div class="row text-left">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<?php for($i=0;$i<count($listaJug);$i++){?>
					<p class="mt-2 mb-0"><b>Jugador:</b> <?php echo trim($listaJug[$i]['NOMBRE'])?> <br> <b>Saldo:</b> <?php echo trim($listaJug[$i]['SALDO'])?></p>
					<hr>
				<?php }?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<?php for($i=0;$i<count($listaRon);$i++){?>
					<h6 class="mb-0"><b>Ronda:</b> <?php echo $listaRon[$i]['ID']?> - <b>Resultado:</b> <?php echo $listaRon[$i]['RESULTADO']?></h6>
					<?php for($j=0;$j<count($listaApu);$i++){?>
						<?php if( $listaRon[$i]['ID'] == $listaApu[$j]['RONDA'] ) { ?>
							<h6 class="mb-2">Jugador: <?php echo $listaApu[$j]['JUGADOR']?>, # Apostado: <?php echo $listaApu[$j]['NUMERO_APUESTA']?> <br> 
							Valor Apuesta: <?php echo $listaApu[$j]['VALOR_APUESTA']?> - Resultado Apuesta: <?php echo $listaApu[$j]['RESULTADO']?></h6>						
						<?php } ?>
					<?php }?>
					<hr>
				<?php }?>
			</div>
		</div>
	</div>

	<?php include_once('php/footer.php'); ?>
</body>
</html>
