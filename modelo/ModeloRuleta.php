<?php
	require_once('ModeloAbstractoDB.php');
	class model_ruleta extends ModeloAbstractoDB {  		
		function __construct() {
			
		}
		
		public function datosIniciales() {
			$this->query = "SELECT ID, RESULTADO FROM rondas ORDER BY ID DESC;";
			$this->obtener_resultados_query();

			if( count($this->rows) == 0){
				$this->query = "INSERT INTO rondas(RESULTADO) VALUES(NULL)";
				$this->ejecutar_query_simple();
			}else{
				if($this->rows[0]['RESULTADO'] != NULL){
					$this->query = "INSERT INTO rondas(RESULTADO) VALUES(NULL)";
					$this->ejecutar_query_simple();
				}
			}
		}

		public function listaNumeros() {
			$this->query = "SELECT NUMERO, COLOR FROM numeros ORDER BY ORDEN;";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaJugadores() {
			$this->query = "SELECT ID, CONCAT(NOMBRE,' ',APELLIDO) AS NOMBRE, SALDO FROM jugadores WHERE SALDO > 0;";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaRondas() {
			$this->query = "SELECT ID, RESULTADO FROM rondas ORDER BY ID DESC;";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function rondaActual() {
			$this->query = "SELECT ID FROM rondas WHERE RESULTADO is null ORDER BY ID DESC;";
			$this->obtener_resultados_query();
			return $this->rows;
		}		

		public function listaApuestas() {
			$this->query = "SELECT a.ID, a.RONDA, CONCAT(b.NOMBRE,' ',b.APELLIDO) AS JUGADOR, a.NUMERO_APUESTA, a.VALOR_APUESTA, a.RESULTADO FROM apuestas a
			LEFT JOIN jugadores b ON b.id = a.jugador
			ORDER BY ID DESC;";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function guardarApuesta($datos=array()) {
			$this->query = "
			INSERT INTO apuestas
			(ronda,jugador,numero_apuesta,valor_apuesta)
			VALUES
			('".$datos['RONDA']."', '".$datos['JUGADOR']."', '".$datos['NUMERO_APUESTA']."', '".$datos['VALOR_APUESTA']."')";
			$this->ejecutar_query_simple();

			$this->query = "UPDATE jugadores
			SET SALDO = SALDO - ".$datos['VALOR_APUESTA']." WHERE ID = ".$datos['JUGADOR'];
			$this->ejecutar_query_simple();			
		}

		public function girarRuleta($datos=array()) {
			$this->query = "SELECT RESULTADO FROM rondas WHERE id = ".$datos['RONDA'].";";
			$this->obtener_resultados_query();

			if($this->rows[0]['RESULTADO'] == NULL){
				$this->query = "UPDATE rondas
				SET RESULTADO = '".$datos['NUMERO_RESULTADO']."' WHERE ID = ".$datos['RONDA'];
				$this->ejecutar_query_simple();

				$this->query = "SELECT COLOR FROM numeros WHERE NUMERO = ".$datos['NUMERO_RESULTADO'].";";
				$this->obtener_resultados_query();
				$datNumResultado = $this->rows;
				
				$this->query = "SELECT ID, RONDA, JUGADOR, NUMERO_APUESTA, VALOR_APUESTA, RESULTADO FROM apuestas
				WHERE RONDA = ".$datos['RONDA'].";";
				$this->obtener_resultados_query();
				$listaApuestas = $this->rows;

				if( count($listaApuestas) != 0){
					for($i=0;$i<count($listaApuestas);$i++){
						if( $datos['NUMERO_RESULTADO'] == $listaApuestas[$i]["NUMERO_APUESTA"]){

                            if($datNumResultado[0]["COLOR"] == '#00ff00'){
                                $resultado = ($listaApuestas[$i]["VALOR_APUESTA"] * 10);
                            }else{
                                $resultado = ($listaApuestas[$i]["VALOR_APUESTA"] * 2);                    
                            }

							$this->query = "UPDATE apuestas
							SET RESULTADO = ".$resultado." WHERE ID = ".$listaApuestas[$i]["ID"];
							$this->ejecutar_query_simple();

							$this->query = "UPDATE jugadores
							SET SALDO = SALDO + ".$resultado." WHERE ID = ".$listaApuestas[$i]['JUGADOR'];
							$this->ejecutar_query_simple();
						}else{
							$this->query = "UPDATE apuestas
							SET RESULTADO = -".$listaApuestas[$i]["VALOR_APUESTA"]." WHERE ID = ".$listaApuestas[$i]["ID"];
							$this->ejecutar_query_simple();							
						}
					}
				}

			}			
		}		
	}
?>