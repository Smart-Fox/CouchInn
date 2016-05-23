<?php

include('conexion.php');

class DbManager{

	protected $db;

	public function conectar(){
		$this->db = new conexion();
	}

	public function ejecutarSQL($consulta){
		$resulBusqueda = $this->db->query($consulta);
		$dato = $this->db->recorrer($resulBusqueda); 
		return $dato;
	}





}


?>