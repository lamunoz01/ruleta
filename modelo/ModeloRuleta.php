<?php
	require_once('ModeloAbstractoDB.php');
	class model_ruleta extends ModeloAbstractoDB {  		
		function __construct() {
			
		}
		
		public function datosIniciales() {
			$this->query = "SELECT ID, RESULTADO FROM RONDAS ORDER BY ID DESC;";
			$this->obtener_resultados_query();

			if( count($this->rows) == 0){
				$this->query = "INSERT INTO RONDAS(RESULTADO) VALUES(NULL)";
				$this->ejecutar_query_simple();
			}else{
				if($this->rows[0]['RESULTADO'] != NULL){
					$this->query = "INSERT INTO RONDAS(RESULTADO) VALUES(NULL)";
					$this->ejecutar_query_simple();
				}
			}
		}

		public function listaNumeros() {
			$this->query = "SELECT NUMERO, COLOR FROM NUMEROS ORDER BY ORDEN;";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaJugadores() {
			$this->query = "SELECT ID, CONCAT(NOMBRE,' ',APELLIDO) AS NOMBRE, SALDO FROM JUGADORES WHERE SALDO > 0;";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaRondas() {
			$this->query = "SELECT ID, RESULTADO FROM RONDAS ORDER BY ID DESC;";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaApuestas() {
			$this->query = "SELECT ID, RONDA, JUGADOR, NUMERO_APUESTA, VALOR_APUESTA, RESULTADO FROM APUESTAS ORDER BY ID DESC;";
			$this->obtener_resultados_query();
			return $this->rows;
		}
	}
?>