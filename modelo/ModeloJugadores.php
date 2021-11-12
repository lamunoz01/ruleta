<?php
	require_once('ModeloAbstractoDB.php');
	class model_jugadores extends ModeloAbstractoDB {  
		public $ID;
		
		function __construct() {
			//$this->db_name = '';
		}
  
		public function consulta($ID='') {	
			if($ID != ''):
				$this->query = "
				SELECT ID, NOMBRE, APELLIDO, IDENTIFICACION, SALDO
				FROM JUGADORES
				WHERE NOMBRE like '%$ID%';";
				$this->obtener_resultados_query();
				return $this->rows;
			endif;
		}
		
		public function consul_modi($ID='') {
			if($ID != ''):
				$this->query = "
				SELECT ID, NOMBRE, APELLIDO, IDENTIFICACION, SALDO
				FROM JUGADORES
				WHERE ID = $ID
				";
				$this->obtener_resultados_query();
				return $this->rows;
			endif;
		}
				
		
		public function lista() {
			$this->query = "SELECT ID, NOMBRE, APELLIDO, IDENTIFICACION, SALDO FROM JUGADORES;";
			$this->obtener_resultados_query();
			return $this->rows;
		}
                
				
		public function nuevo($datos=array()) {		
			$this->query = "
			INSERT INTO JUGADORES
			(NOMBRE,APELLIDO,IDENTIFICACION, SALDO)
			VALUES
			('".$datos['NOMBRE']."', '".$datos['APELLIDO']."', '".$datos['IDENTIFICACION']."', '".$datos['SALDO']."')";
			$this->ejecutar_query_simple();
		}
		
		
		public function editar($datos=array()) {			
			$this->query = "UPDATE JUGADORES
			SET NOMBRE='".$datos['NOMBRE']."', APELLIDO='".$datos['APELLIDO']."', IDENTIFICACION='".$datos['IDENTIFICACION'].
			"', SALDO='".$datos['SALDO']."' WHERE ID = ".$datos['JUGAID'];
			$this->ejecutar_query_simple();
		}

		
		public function borrar($ID='') {
			$this->query = "DELETE FROM JUGADORES WHERE ID = $ID";
			$this->ejecutar_query_simple();
		}
	}
?>