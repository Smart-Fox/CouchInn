<?php
	
	include_once('dbManager.php');
	
	function reportePagos($inicial, $final){
		$inicial=date_create_from_format("d/m/Y",$inicial);
		$inicial=date_format($inicial,"Y-m-d");
		$final=date_create_from_format("d/m/Y",$final);
		$final=date_format($final,"Y-m-d");
		$conec = new dbManager();
		$conec->conectar();	
		$consulta = ("SELECT *	FROM pago
								INNER JOIN usuario on usuario.ID_pago=pago.ID
								WHERE pago.fecha<='$final' AND pago.fecha>='$inicial';");
		return ($conec->ejecutarSQL($consulta));
	}
	
	function reporteReservas($inicial, $final){
		$inicial=date_create_from_format("d/m/Y",$inicial);
		$inicial=date_format($inicial,"Y-m-d");
		$final=date_create_from_format("d/m/Y",$final);
		$final=date_format($final,"Y-m-d");
		$conec = new dbManager();
		$conec->conectar();	
		$consulta = ("SELECT *	FROM solicitud_reserva
								INNER JOIN usuario on solicitud_reserva.ID_usuario=usuario.ID
								INNER JOIN anuncio on solicitud_reserva.ID_anuncio=anuncio.ID
								WHERE fecha_solicitud<='$final' AND fecha_solicitud>='$inicial';");
		return ($conec->ejecutarSQL($consulta));
	}
	
?>