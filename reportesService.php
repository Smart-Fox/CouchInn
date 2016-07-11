<?php
	
	include_once('dbManager.php');
	
	public function reportePremium($inicial, $final){
		$conec = new dbManager();
		$conec->conectar();	
		$consulta = ("SELECT *	FROM pago
								INNER JOIN usuario on usuario.ID_pago=pago.ID
								WHERE fecha <=$final AND fecha>=$inicial;");
		return ($conec->ejecutarSQL($consulta));
	}
	
	public function reporteReserva($inicial, $final){
		$conec = new dbManager();
		$conec->conectar();	
		$consulta = ("SELECT *	FROM solicitud_reserva
								INNER JOIN usuario on solicitud_reserva.ID_usuario=usuario.ID
								INNER JOIN anuncio on solicitud_reserva.ID_anuncio=anuncio.ID
								WHERE fecha_solicitud <=$final AND fecha>=$inicial;");
		return ($conec->ejecutarSQL($consulta));
	}
	
?>