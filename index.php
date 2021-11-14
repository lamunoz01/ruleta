<?php
	require_once 'modelo/ModeloRuleta.php';
	$modruleta=new model_ruleta();
	$datini=$modruleta->datosIniciales();
	$listaNum=$modruleta->listaNumeros();
	$listaJug=$modruleta->listaJugadores();
	$listaRon=$modruleta->listaRondas();
	$actualRon=$modruleta->rondaActual();
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

		<div class="row pt-3 pb-2">
			<div class="col-lg-12 col-md-12 col-12 text-center">
				<h5>Ronda Actual: <?php echo $actualRon[0]["ID"] ?></h5>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6 col-md-6 col-6">
				<button type="button" class="btn btn-info" onclick="ruletaGirar();">Girar</button>
			</div>
			<div class="col-lg-6 col-md-6 col-6 text-right">
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
				<h2 class="">Apuestas / Jugadores</h2>
			</div>
		</div>
		<hr>
		<div class="row text-left">
			<div class="col-lg-8 col-md-8 col-sm-12" id="secApu" style="height:310px; overflow:auto;">
				<?php for($i=0;$i<count($listaRon);$i++){?>
					<h6 class="mb-0"><b>Ronda:</b> <?php echo $listaRon[$i]['ID']?> - <b>Resultado:</b> <?php echo $listaRon[$i]['RESULTADO']?></h6>
					<?php for($j=0;$j<count($listaApu);$j++){?>
						<?php if( $listaRon[$i]['ID'] == $listaApu[$j]['RONDA'] ) { ?>
							<h6 class="mb-2">Jugador: <?php echo $listaApu[$j]['JUGADOR']?>, # Apostado: <?php echo $listaApu[$j]['NUMERO_APUESTA']?> 
							Valor Apuesta: <?php echo $listaApu[$j]['VALOR_APUESTA']?> <br> Resultado Apuesta: <?php echo $listaApu[$j]['RESULTADO']?></h6>						
						<?php } ?>
					<?php }?>
					<hr>
				<?php }?>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 text-center" id="secJuga" style="height:310px; overflow:auto;">
				<?php for($i=0;$i<count($listaJug);$i++){?>
					<p class="mt-2 mb-0"><b>Jugador:</b> <?php echo trim($listaJug[$i]['NOMBRE'])?> <br> <b>Saldo:</b> <?php echo trim($listaJug[$i]['SALDO'])?></p>
					<hr>
				<?php }?>
			</div>			
		</div>
	</div>

	<div class="modal fade" id="addApuesta" tabindex="-1" role="dialog" aria-labelledby="AgregarApuesa" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nueva apuesta para el # <span id="numeroApostar"></span></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="LimCamApu();" id="XCerrar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<h6 class="mb-0">Porcentajes de apuesta</h6>
						</div>
						<div class="col-lg-12 col-md-12 col-12 d-flex">
							<input type="radio" id="11p" name="porcentajeApuesta" class="my-auto " value="0.11">
							<label for="11p" class="my-auto ml-1  mr-2">11%</label>
							<input type="radio" id="12p" name="porcentajeApuesta" class="my-auto " value="0.12">
							<label for="12p" class="my-auto ml-1  mr-2">12%</label>
							<input type="radio" id="13p" name="porcentajeApuesta" class="my-auto " value="0.13">
							<label for="13p" class="my-auto ml-1  mr-2">13%</label>
							<input type="radio" id="14p" name="porcentajeApuesta" class="my-auto " value="0.14">
							<label for="14p" class="my-auto ml-1  mr-2">14%</label>
							<input type="radio" id="15p" name="porcentajeApuesta" class="my-auto " value="0.15">
							<label for="15p" class="my-auto ml-1  mr-2">15%</label>
							<input type="radio" id="16p" name="porcentajeApuesta" class="my-auto " value="0.16">
							<label for="16p" class="my-auto ml-1  mr-2">16%</label>
							<input type="radio" id="17p" name="porcentajeApuesta" class="my-auto " value="0.17">
							<label for="17p" class="my-auto ml-1  mr-2">17%</label>
							<input type="radio" id="18p" name="porcentajeApuesta" class="my-auto " value="0.18">
							<label for="18p" class="my-auto ml-1  mr-2">18%</label>
							<input type="radio" id="19p" name="porcentajeApuesta" class="my-auto " value="0.19">
							<label for="19p" class="my-auto ml-1 ">19%</label>
						</div>						
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<input type="text" id="idnumapos" style="display:none;" readonly="true">
                            <label for="id_jugador" class="">Seleccione un jugador</label>
                            <select class="form-control" name="id_jugador" id="id_jugador" style="width: 100% !important"></select>
						</div>
					</div>						
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="LimCamApu();" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-success" onclick="guardarApuesta();">Apostar</button>
				</div>
			</div>
		</div>
	</div>

	<?php include_once('php/footer.php'); ?>

	<script>
		var usados = new Array();

		$('#id_jugador').select2({
			ajax: {
				url: "controlador/controller.php", 
				dataType: 'json',
				data: function (params) {
					return {
						datos: params.term,
						accion: 'listaJugadores',
						destino: 'JUGADORES'
					};
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			},
			placeholder: 'Seleccione ...',
			language: {
				noResults: function() {
					return "No hay resultados";        
				},
				searching: function() {
					return "Buscando...";
				}
			}
		});

		function apostar(num){
			$("#idnumapos").val(num);
			document.getElementById("numeroApostar").innerHTML = num;
			$("#addApuesta").modal("show");
		}

		function guardarApuesta(){
			var porcentajeApuesta = document.querySelector('input[name="porcentajeApuesta"]:checked');
			var idnumapos = document.getElementById("idnumapos").value;
			var id_jugador = document.getElementById("id_jugador").value;
			var rondaactual = '<?php echo $actualRon[0]["ID"] ?>';
			var hasError = false;

			if(!porcentajeApuesta) {
				hasError = true;
			}

			if(id_jugador == '') {
				hasError = true;
			}

			if(hasError == true){
				mensajes('Error','Recuerda debes seleccionar el porcentaje de apuesta y el jugador que va apostar','error');				
			}else{
				var accion = "guardarApuesta";
				var destino = "RULETA";
				var datos = {
					"RONDA":rondaactual.trim(),
					"JUGADOR":id_jugador.trim(),
					"NUMERO_APUESTA":idnumapos.trim(),
					"PORCENTAJE_APUESTA":porcentajeApuesta.value
				};

				$.ajax({
					url: "controlador/controller.php", 
					dataType:'json',  // tipo de datos que te envia el archivo que se ejecuto                              
					method: "GET", // metodo por el cual vas a enviar los parametros GET o POST
					data: {'accion':accion,'datos':datos,'destino':destino}, //parametros GET o POST
					success: function (data) {  
						location.reload();
					},
					error: function(result) {
						swal("Error grabando los datos!", "", "error");
					}
				});				
			}
		}

		function ruletaGirar(){
			var rondaactual = '<?php echo $actualRon[0]["ID"] ?>';
			var contNum = "<?php echo count($listaNum); ?>";
			var contJug = "<?php echo count($listaJug); ?>";
			var contApu = "<?php echo count($listaApu); ?>";
			var hashError = false;

            if(contJug < 1){
                hashError = true;
            }

            if(contNum < 1){
                hashError = true;
            }

            if(contApu < 1){
                hashError = true;
            }

			if(hashError == false){
				for (var i = 0; i < 38; i++) {
					numini = Math.floor((Math.random() * (37-0))+0);
					repe = repetidos(numini);
					if(repe == false){
						usados.push(numini);
						break;
					}
					if( i == 37){ 
						usados = [];
						usados.push(numini);
					} 
				};

				mensajes('Exito','El número ganador es: '+numini,'success');

				var accion = "girarRuleta";
				var destino = "RULETA";
				var datos = {
					"RONDA":rondaactual.trim(),
					"NUMERO_RESULTADO":numini,
				};

				$.ajax({
					url: "controlador/controller.php", 
					dataType:'json',  // tipo de datos que te envia el archivo que se ejecuto                              
					method: "GET", // metodo por el cual vas a enviar los parametros GET o POST
					data: {'accion':accion,'datos':datos,'destino':destino}, //parametros GET o POST
					success: function (data) {  
						location.reload();
					},
					error: function(result) {
						swal("Error grabando los datos!", "", "error");
					}
				});				
			}else{
				mensajes('¡Error!','Se necesitan jugadores, números y apuestas para girar la ruleta','error');
			}
		}		

        function repetidos(numero) {
            var repe = false;

            for (var i = 0; i < usados.length; i++) {
                if (numero == usados[i]) {         
                    repe = true;
                }
            }
            return repe;
        }		
	</script>
</body>
</html>
