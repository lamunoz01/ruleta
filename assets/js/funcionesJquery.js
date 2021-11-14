//************************************************************************************/
//************************************************************************************/
//     FUNCIONES DEL MANTENIMIENTO DE JUGADORES
function mensajes($titulo,$texto,$tipo){
	swal({
		title: $titulo,
		text: $texto,
		icon: $tipo,
		button: "Aceptar",
	});
};

function AgregarJugador(){
	var nombre = document.getElementById("nombre").value
	var apellido = document.getElementById("apellido").value
	var identificacion = document.getElementById("identificacion").value
	var saldo = document.getElementById("saldo").value
	var cantErr = 0;

	if(nombre == ''){
		$('#nombre').addClass("is-invalid");
		cantErr ++ ;
	}else{
		$('#nombre').removeClass("is-invalid");
	}

	if(apellido == ''){
		$('#apellido').addClass("is-invalid");
		cantErr ++ ;
	}else{
		$('#apellido').removeClass("is-invalid");
	}	

	if(identificacion == ''){
		$('#identificacion').addClass("is-invalid");
		cantErr ++ ;
	}else{
		$('#identificacion').removeClass("is-invalid");
	}
	
	if(saldo == ''){
		$('#saldo').addClass("is-invalid");
		cantErr ++ ;
	}else{
		$('#saldo').removeClass("is-invalid");
	}

	if(saldo < 15000){
		$('#saldo').addClass("is-invalid");
		swal("El saldo debe ser mayor o igual a 15000", "", "error");
		cantErr ++ ;
	}else{
		$('#saldo').removeClass("is-invalid");
	}	
	
	if(cantErr != 0){
		if(saldo < 15000){
			swal("El saldo debe ser mayor o igual a 15000", "", "error");
		}else{
			swal("Verifica los datos ingresados!", "", "error");
		}
	}else{
		var accion = "nuevo";
		var destino = "JUGADORES";
		var datos = {
				"NOMBRE":nombre.trim(),
				"APELLIDO":apellido.trim(),
				"IDENTIFICACION":identificacion.trim(),
				"SALDO":saldo.trim()
		};

		$.ajax({
			url: "../controlador/controller.php", 
			dataType:'json',  // tipo de datos que te envia el archivo que se ejecuto                              
			method: "GET", // metodo por el cual vas a enviar los parametros GET o POST
			data: {'accion':accion,'datos':datos,'destino':destino}, //parametros GET o POST
			success: function (data) {  
				var arrayDatos = $.map(data, function(value, index) {
                    return [value];
                 });     

				var cuerpo =
				'<table class="table table-hover">'+
					'<tr>'+
						'<th colspan="6">Jugadores del sistema</th>'+
					'</tr>'+
					'<tr>'+
						'<th>Nombre</th>'+
						'<th>Apellido</th>'+
						'<th>Identificacion</th>'+
						'<th>Saldo</th>'+
						'<th></th>'+
						'<th></th>'+
					'</tr>';
					
				for (var i=0 ; i<arrayDatos.length ; i++){
					cuerpo = cuerpo +
					'<tr>'+
						'<td>'+arrayDatos[i].NOMBRE+'</td>'+
						'<td>'+arrayDatos[i].APELLIDO+'</td>'+
						'<td>'+arrayDatos[i].IDENTIFICACION+'</td>'+
						'<td>'+arrayDatos[i].SALDO+'</td>'+
						'<td><i class="fas fa-pencil-alt btn" onclick="DatModUsu(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
						'<td><i class="fas fa-trash-alt btn" onclick="EliminarJugador(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
					'</tr>';
				};
				
				cuerpo = cuerpo + '</table>';
				
				swal("Jugador ingresado correctamente!", "", "success");
				
				document.getElementById("usu").innerHTML = cuerpo;
				
				LimCamUsu();
			},
			error: function(result) {
				swal("Error grabando los datos!", "", "error");
			}
		});
	}
}
 
function DatModUsu($id){
	swal({
	  title: "Esta seguro de modificar el Jugador?",
	  icon: "warning",
	  buttons: ["CANCELAR", "OK"],
	})
	.then((willDelete) => {
		if (willDelete) {
			$("#btnguardar").attr('onclick', 'ModificarJugador()');
			var accion = "datmodi";
			var destino = "JUGADORES";
			$.ajax({
				url: "../controlador/controller.php", 
				dataType:'json',  // tipo de datos que te envia el archivo que se ejecuto                              
				method: "GET", // metodo por el cual vas a enviar los parametros GET o POST
				data: {'accion':accion,'datos':$id,'destino':destino}, //parametros GET o POST
				success: function (data) {					
					var arrayDatos = $.map(data, function(value, index) {
						return [value]; 
					});     
					
					for (var i=0 ; i<arrayDatos.length ; i++){
						document.getElementById("nombre").value = arrayDatos[i].NOMBRE.trim();
						document.getElementById("apellido").value = arrayDatos[i].APELLIDO.trim();
						document.getElementById("identificacion").value = arrayDatos[i].IDENTIFICACION.trim();
						document.getElementById("saldo").value = arrayDatos[i].SALDO.trim();
						document.getElementById("jugaid").value = $id;
					};
					
					document.getElementById("AgregarJugador").innerHTML = "Modificar Jugador";
					$("#btnAgregar").click();
				}
			});
		}else {
			swal("Modificacion Cancelada!","","info");
			$("#btnguardar").attr('onclick', 'AgregarJugador()');
		}		
	});
}

function ModificarJugador(){
	var nombre = document.getElementById("nombre").value
	var apellido = document.getElementById("apellido").value
	var identificacion = document.getElementById("identificacion").value
	var saldo = document.getElementById("saldo").value
	var jugaid = document.getElementById("jugaid").value
	var cantErr = 0;

	if(nombre == ''){
		$('#nombre').addClass("is-invalid");
		cantErr ++ ;
	}else{
		$('#nombre').removeClass("is-invalid");
	}

	if(apellido == ''){
		$('#apellido').addClass("is-invalid");
		cantErr ++ ;
	}else{
		$('#apellido').removeClass("is-invalid");
	}	

	if(identificacion == ''){
		$('#identificacion').addClass("is-invalid");
		cantErr ++ ;
	}else{
		$('#identificacion').removeClass("is-invalid");
	}
	
	if(saldo == ''){
		$('#saldo').addClass("is-invalid");
		cantErr ++ ;
	}else{
		$('#saldo').removeClass("is-invalid");
	}

	if(saldo < 15000){
		$('#saldo').addClass("is-invalid");
		swal("El saldo debe ser mayor o igual a 15000", "", "error");
		cantErr ++ ;
	}else{
		$('#saldo').removeClass("is-invalid");
	}		
	
	if(cantErr != 0){
		if(saldo < 15000){
			swal("El saldo debe ser mayor o igual a 15000", "", "error");
		}else{
			swal("Verifica los datos ingresados!", "", "error");
		}	
	}else{
		var accion = "editar";
		var destino = "JUGADORES";
		var datos = {
			"NOMBRE":nombre.trim(),
			"APELLIDO":apellido.trim(),
			"IDENTIFICACION":identificacion.trim(),
			"SALDO":saldo.trim(),
			"JUGAID":jugaid.trim()
		};

		$.ajax({
			url: "../controlador/controller.php", 
			dataType:'json',  // tipo de datos que te envia el archivo que se ejecuto                              
			method: "GET", // metodo por el cual vas a enviar los parametros GET o POST
			data: {'accion':accion,'datos':datos,'destino':destino}, //parametros GET o POST
			success: function (data) {  
				var arrayDatos = $.map(data, function(value, index) {
                    return [value];
                 });     

				 var cuerpo =
				 '<table class="table table-hover">'+
					 '<tr>'+
						 '<th colspan="6">Jugadores del sistema</th>'+
					 '</tr>'+
					 '<tr>'+
						 '<th>Nombre</th>'+
						 '<th>Apellido</th>'+
						 '<th>Identificacion</th>'+
						 '<th>Saldo</th>'+
						 '<th></th>'+
						 '<th></th>'+						 
					 '</tr>';
					 
				 for (var i=0 ; i<arrayDatos.length ; i++){
					 cuerpo = cuerpo +
					 '<tr>'+
						 '<td>'+arrayDatos[i].NOMBRE+'</td>'+
						 '<td>'+arrayDatos[i].APELLIDO+'</td>'+
						 '<td>'+arrayDatos[i].IDENTIFICACION+'</td>'+
						 '<td>'+arrayDatos[i].SALDO+'</td>'+
						 '<td><i class="fas fa-pencil-alt btn" onclick="DatModUsu(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
						 '<td><i class="fas fa-trash-alt btn" onclick="EliminarJugador(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
					 '</tr>';
				 };
				
				cuerpo = cuerpo + '</table>';
				
				swal("Jugador modificado correctamente!", "", "success");
				
				document.getElementById("usu").innerHTML = cuerpo;
				$("#btnguardar").attr('onclick', 'AgregarJugador()');
				document.getElementById("AgregarJugador").innerHTML = "Nuevo Jugador";
				$("#XCerrar").click();
				$("#btnCerrar").click();				
			},
			error: function(result) {
				swal("Error modificando el Jugador!", "", "error");
			}
		});
	}
}

function EliminarJugador($id)
{
	swal({
	  title: "Esta seguro de eliminar el registro?",
	  text: "Una vez eliminado, no podra recuperar el registro!",
	  icon: "warning",
	  buttons: ["CANCELAR", "OK"],
	  dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			var accion = "borrar";
			var destino = "JUGADORES";
			$.ajax({
				url: "../controlador/controller.php", 
				dataType:'json',  // tipo de datos que te envia el archivo que se ejecuto                              
				method: "GET", // metodo por el cual vas a enviar los parametros GET o POST
				data: {'accion':accion,'datos':$id,'destino':destino}, //parametros GET o POST
				success: function (data) {  
					var arrayDatos = $.map(data, function(value, index) {
						return [value];
					 });     

					var cuerpo =
					'<table class="table table-hover">'+
						'<tr>'+
							'<th colspan="6">Jugadores del sistema</th>'+
						'</tr>'+
						'<tr>'+
							'<th>Nombre</th>'+
							'<th>Apellido</th>'+
							'<th>Identificacion</th>'+
							'<th>Saldo</th>'+
							'<th></th>'+
							'<th></th>'+							
						'</tr>';
						
					for (var i=0 ; i<arrayDatos.length ; i++){
						cuerpo = cuerpo +
						'<tr>'+
							'<td>'+arrayDatos[i].NOMBRE+'</td>'+
							'<td>'+arrayDatos[i].APELLIDO+'</td>'+
							'<td>'+arrayDatos[i].IDENTIFICACION+'</td>'+
							'<td>'+arrayDatos[i].SALDO+'</td>'+
							'<td><i class="fas fa-pencil-alt btn" onclick="DatModUsu(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
							'<td><i class="fas fa-trash-alt btn" onclick="EliminarJugador(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
						'</tr>';
					};
					
					cuerpo = cuerpo + '</table>';
					
					document.getElementById("usu").innerHTML = cuerpo;
					swal("Registro eliminado correctamente!", "", "success");
					
				},
				error: function(result) {
					swal("Error eliminando los datos!", "", "error");
				}
			});
		} else {
			swal("Eliminacion Cancelada!","", "info");
		}
	});
}

function BuscarJugador(){
	var cadena = document.getElementById("txtbuscar").value
	
	if (cadena != ''){
		var accion = "busca";
		var destino = "JUGADORES";
		$.ajax({
			url: "../controlador/controller.php", 
			dataType:'json',  // tipo de datos que te envia el archivo que se ejecuto                              
			method: "GET", // metodo por el cual vas a enviar los parametros GET o POST
			data: {'accion':accion,'datos':cadena,'destino':destino}, //parametros GET o POST
			success: function (data) {  
				/*todo la accion al ejecutar la url */
				var arrayDatos = $.map(data, function(value, index) {
					return [value];
				 });  

				var contdat = arrayDatos.length;
					
				var cuerpo =
				'<table class="table table-hover">'+
					'<tr>'+
						'<th colspan="6">Jugadores del sistema</th>'+
					'</tr>'+
					'<tr>'+
						'<th>Nombre</th>'+
						'<th>Apellido</th>'+
						'<th>Identificacion</th>'+
						'<th>Saldo</th>'+
						'<th></th>'+
						'<th></th>'+						
					'</tr>';
					
				if (contdat > 0){					
					for (var i=0 ; i<arrayDatos.length ; i++){
						cuerpo = cuerpo +
						'<tr>'+
							'<td>'+arrayDatos[i].NOMBRE+'</td>'+
							'<td>'+arrayDatos[i].APELLIDO+'</td>'+
							'<td>'+arrayDatos[i].IDENTIFICACION+'</td>'+
							'<td>'+arrayDatos[i].SALDO+'</td>'+
							'<td><i class="fas fa-pencil-alt btn" onclick="DatModUsu(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
							'<td><i class="fas fa-trash-alt btn" onclick="EliminarJugador(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
						'</tr>';
					};
				}else{
					swal("No hay jugadores registrados!", "", "error");
				}
				cuerpo = cuerpo + '</table>';
				document.getElementById("usu").innerHTML = cuerpo;
			},
			error: function(result) {
				swal("No hay jugadores registrados!", "", "error");
			}
		});
	}else{
		var accion = "listado";
		var destino = "JUGADORES";
		$.ajax({
			url: "../controlador/controller.php", 
			dataType:'json',  // tipo de datos que te envia el archivo que se ejecuto                              
			method: "GET", // metodo por el cual vas a enviar los parametros GET o POST
			data: {'accion':accion,'datos':cadena,'destino':destino}, //parametros GET o POST
			success: function (data) {  
				/*todo la accion al ejecutar la url */
				var arrayDatos = $.map(data, function(value, index) {
					return [value];
				 });     

				var cuerpo =
				'<table class="table table-hover">'+
					'<tr>'+
						'<th colspan="6">Jugadores del sistema</th>'+
					'</tr>'+
					'<tr>'+
						'<th>Nombre</th>'+
						'<th>Apellido</th>'+
						'<th>Identificacion</th>'+
						'<th>Saldo</th>'+
						'<th></th>'+
						'<th></th>'+						
					'</tr>';
					
				for (var i=0 ; i<arrayDatos.length ; i++){
					cuerpo = cuerpo +
					'<tr>'+
						'<td>'+arrayDatos[i].NOMBRE+'</td>'+
						'<td>'+arrayDatos[i].APELLIDO+'</td>'+
						'<td>'+arrayDatos[i].IDENTIFICACION+'</td>'+
						'<td>'+arrayDatos[i].SALDO+'</td>'+
						'<td><i class="fas fa-pencil-alt btn" onclick="DatModUsu(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
						'<td><i class="fas fa-trash-alt btn" onclick="EliminarJugador(\''+arrayDatos[i].ID.trim()+'\')"></i></td>'+
					'</tr>';
				};
				
				cuerpo = cuerpo + '</table>';
				document.getElementById("usu").innerHTML = cuerpo;
			},
			error: function(result) {
				swal("No hay jugadores registrados!", "", "error");
			}
		});		
	}
}
	
function LimCamUsu(){
	document.getElementById("nombre").value ="";
	document.getElementById("apellido").value ="";
	document.getElementById("identificacion").value ="";
	document.getElementById("saldo").value ="15000";
	$("#btnguardar").attr('onclick', 'AgregarJugador()');
	document.getElementById("AgregarJugador").innerHTML = "Nuevo Jugador";
	$('#saldo').removeClass("is-invalid");
	$('#identificacion').removeClass("is-invalid");
	$('#nombre').removeClass("is-invalid");
	$('#apellido').removeClass("is-invalid");
}

function LimCamApu(){
	$('input[name=porcentajeApuesta]').attr('checked',false);
	document.getElementById("idnumapos").value ="";
	$("#id_jugador").val('').trigger('change');	
}

function VistaPrincipal(){
	location.href = "../index.php";
}

function VistaJugadores(){
	location.href = "php/jugadores.php";
}