<?php
	
	include_once('dbManager.php');
	
	public function reportePagos($inicial, $final){
		$inicial=date_create($inicial);
		$inicial=date_format($inicial,"Y-m-d");
		$final=date_create($final);
		$final=date_format($final,"Y-m-d");
		$conec = new dbManager();
		$conec->conectar();	
		$consulta = ("SELECT *	FROM pago
								INNER JOIN usuario on usuario.ID_pago=pago.ID
								WHERE fecha <=$final AND fecha>=$inicial;");
		return ($conec->ejecutarSQL($consulta));
	}
	
	public function reporteReservas($inicial, $final){
		$inicial=date_create($inicial);
		$inicial=date_format($inicial,"Y-m-d");
		$final=date_create($final);
		$final=date_format($final,"Y-m-d");
		$conec = new dbManager();
		$conec->conectar();	
		$consulta = ("SELECT *	FROM solicitud_reserva
								INNER JOIN usuario on solicitud_reserva.ID_usuario=usuario.ID
								INNER JOIN anuncio on solicitud_reserva.ID_anuncio=anuncio.ID
								WHERE DATE(fecha_solicitud)<='$final' AND DATE(fecha_solicitud)>='$inicial';");
		return ($conec->ejecutarSQL($consulta));
	}
	
?>