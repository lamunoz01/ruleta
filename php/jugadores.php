<?php
require_once '../modelo/ModeloJugadores.php';
$modusu=new model_jugadores();
$lista=$modusu->lista();
?>

<html>
<head>
	<title>Jugadores</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Language" content="en">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
	<meta name="msapplication-tap-highlight" content="no">

	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/material-icons.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/estilos.css" />
</head>

<body>
	<div class="container my-5">
		<h2 class="text-center">Jugadores</h2>

		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 text-right">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addusu" id="btnAgregar">Agregar</button>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 text-center">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Buscar por nombre del jugador" id="txtbuscar" onchange="BuscarJugador();">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 text-left">
				<button type="button" class="btn btn-secondary" onclick="BuscarJugador();">Buscar</button>
			</div>
		</div>

		<div class="row mY-5">
			<div class="col-lg-12 col-md-12 col-sm-12 text-center">			
				<div id="usu" class="table-responsive">
					<table class="table table-hover">
						<tr>
							<th colspan="6">Jugadores del sistema</th>
						</tr>
						
						<tr>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Identificacion</th>
							<th>Saldo</th>
							<th></th>
							<th></th>
						</tr>
						<?php for($i=0;$i<count($lista);$i++){?>
						<tr>
							<td><?php echo trim($lista[$i]['NOMBRE'])?></td>
							<td><?php echo trim($lista[$i]['APELLIDO'])?></td>
							<td><?php echo trim($lista[$i]['IDENTIFICACION'])?></td>
							<td><?php echo trim($lista[$i]['SALDO'])?></td>						
							<td><i class="fas fa-pencil-alt btn" onclick="DatModUsu(<?php echo "'".trim($lista[$i]['ID'])."'";?>);"></i></td>
							<td><i class="fas fa-trash-alt btn" onclick="EliminarJugador(<?php echo "'".trim($lista[$i]['ID'])."'";?>);"></i></td>
						</tr>
						<?php }?>
					</table>
				</div>
				
				<div id="uno" ></div>	

				<button type="button pt-2" class="btn btn-info" onclick="VistaPrincipal();">Ruleta</button>
			</div>
		</div>
    </div>

	<!-- Modal Agregar/Editar -->
	<div class="modal fade" id="addusu" tabindex="-1" role="dialog" aria-labelledby="AgregarJugador" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="AgregarJugador">Nuevo Jugador</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="LimCamUsu();" id="XCerrar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
					<div class="row text-center">
						<div class="col-lg-3 col-md-3 col-sm-12 form-group">
							<div><input type="text" id="jugaid" style="display:none;" readonly="true"></div>
							<input type="text" id="nombre" class="form-control" placeholder="Digite el nombre">
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 form-group">
							<input type="text" id="apellido" class="form-control" placeholder="Digite el apellido">
						</div>						
						<div class="col-lg-3 col-md-3 col-sm-12 form-group">
							<input type="text" id="identificacion" class="form-control" maxlength="20" placeholder="Digite la identificacion">
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 form-group">
							<input type="text" id="saldo" class="form-control" placeholder="Saldo disponible" value="15000">
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 text-left">
							<p class="text-info mb-0">Nota: Recuerde todos los campos son obligatorios</p>
						</div>
					</div>						
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="LimCamUsu();" data-dismiss="modal" id="btnCerrar">Cerrar</button>
					<button type="button" class="btn btn-success" onclick="AgregarJugador();" id="btnguardar">Guardar</button>
				</div>
			</div>
		</div>
	</div>	
	
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/funcionesJquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
</body>
</html>