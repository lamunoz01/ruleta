<?php
	abstract class ModeloAbstractoDB {
		
    protected $query;
    protected $rows = array();
    private $conexion;
	
    // abstract protected function lista();

    # Conectar a la base de datos
    private function abrir_conexion() {
        $this->conexion = mysqli_connect("localhost","root","","ruleta") 
						  or die("Error en la Conexión: ".mysqli_connect_error());
    }

    # Desconectar la base de datos
    private function cerrar_conexion() {
        mysqli_close($this->conexion);
    }

    # Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
    protected function ejecutar_query_simple() {
        $this->abrir_conexion();
        mysqli_query($this->conexion,$this->query) or die(mysqli_error($this->conexion) . "  | Query=" . $this->query);
        $this->cerrar_conexion();
    }

    # Traer resultados de una consulta en un Array
    protected function obtener_resultados_query() {		
        $this->abrir_conexion();
		
		unset($this->rows);
		
        $result = mysqli_query($this->conexion,$this->query) or die(mysqli_error($this->conexion) . "  | Query=" . $this->query);
				
        while ($this->rows[] = mysqli_fetch_array($result, MYSQLI_ASSOC));
		
		mysqli_free_result($result);
        $this->cerrar_conexion();
        array_pop($this->rows);
    }	
}
?>