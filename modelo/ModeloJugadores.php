<?php
	require_once('ModeloAbstractoDB.php');
	class model_jugadores extends ModeloAbstractoDB {  
		public $ID;
		
		function __construct() {
			//$this->db_name = '';
		}
  
		public function consulta($ID) {	
			if($ID != ''):
				$this->query = "
				SELECT ID, NOMBRE, APELLIDO, IDENTIFICACION, SALDO
				FROM jugadores
				WHERE NOMBRE like '%$ID%';";
				$this->obtener_resultados_query();
				return $this->rows;
			endif;
		}
		
		public function consul_modi($ID='') {
			if($ID != ''):
				$this->query = "
				SELECT ID, NOMBRE, APELLIDO, IDENTIFICACION, SALDO
				FROM jugadores
				WHERE ID = $ID
				";
				$this->obtener_resultados_query();
				return $this->rows;
			endif;
		}
				
		
		public function lista() {
			$this->query = "SELECT ID, NOMBRE, APELLIDO, IDENTIFICACION, SALDO FROM jugadores;";
			$this->obtener_resultados_query();
			return $this->rows;
		}
                
				
		public function nuevo($datos=array()) {		
			$this->query = "
			INSERT INTO jugadores
			(NOMBRE,APELLIDO,IDENTIFICACION, SALDO)
			VALUES
			('".$datos['NOMBRE']."', '".$datos['APELLIDO']."', '".$datos['IDENTIFICACION']."', '".$datos['SALDO']."')";
			$this->ejecutar_query_simple();
		}
		
		
		public function editar($datos=array()) {			
			$this->query = "UPDATE jugadores
			SET NOMBRE='".$datos['NOMBRE']."', APELLIDO='".$datos['APELLIDO']."', IDENTIFICACION='".$datos['IDENTIFICACION'].
			"', SALDO='".$datos['SALDO']."' WHERE ID = ".$datos['JUGAID'];
			$this->ejecutar_query_simple();
		}

		public function listaJugadores($datos) {
			if($datos != null){
				$this->query = "SELECT id, CONCAT(NOMBRE,' ',APELLIDO) AS text FROM jugadores WHERE SALDO > 0 AND 
				CONCAT(NOMBRE,' ',APELLIDO) like '%".$datos."%';";
			}else{
				$this->query = "SELECT id, CONCAT(NOMBRE,' ',APELLIDO) AS text FROM jugadores WHERE SALDO > 0;";				
			}

			$this->obtener_resultados_query();
			return $this->rows;
		}
	}
?>