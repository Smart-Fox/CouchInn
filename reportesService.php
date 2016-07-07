<?php
	
	include_once('dbManager.php');
	
	public function reportePremium(){
		$conec = new dbManager();
		$conec->conectar();	
		$consulta = ("SELECT * FROM  WHERE ;");
		return ($conec->ejecutarSQL($consulta));
	}
	
	public function reporteReserva(){
		$conec = new dbManager();
		$conec->conectar();	
		$consulta = ("SELECT * FROM  WHERE ;");
		return ($conec->ejecutarSQL($consulta));
	}
	
?>