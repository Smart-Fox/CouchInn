<?php

include('conexion.php');

class DbManager{

	protected $db;

	public function conectar(){
		$this->db = new conexion();
	}
	
	public function ejecutarSQL($consulta){
		$resulBusqueda = $this->db->query($consulta);
		return $resulBusqueda;
	}

	public function lastId(){
		return $this->db->insert_id;
	}
}


?>