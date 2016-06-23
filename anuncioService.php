<?php
	include('dbManager.php');
	
	class aService{
		protected $titulo;
		protected $descripcion;
		protected $capacidad;
		protected $ciudad;
		protected $tipo;
		protected $imagen;
		protected $user;
		protected $date;

		public function levantarProv(){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM provincia";
			$resulSQL= $conec->ejecutarSQL($consulta);
			return $resulSQL;
		}
		public function levantarCiudad($idProv){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM ciudad WHERE ID_provincia=$idProv";
			$resulSQL= $conec->ejecutarSQL($consulta);
			return $resulSQL;
		}
		public function levantarTipos(){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM tipo_hospedaje WHERE deleted=0";
			$resulSQL= $conec->ejecutarSQL($consulta);
			return $resulSQL;
		}
		public function levantarNombreTipo($id){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT Nombre FROM tipo_hospedaje WHERE ID=$id";
			$resulSQL= $conec->ejecutarSQL($consulta);
			return $resulSQL;
		}		
		public function levantarNombreProvincia($id){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT Nombre FROM provincia WHERE ID=$id";
			$resulSQL= $conec->ejecutarSQL($consulta);
			return $resulSQL;
		}	
		public function levantarNombreCiudad($id){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT nombre FROM ciudad WHERE ID=$id";
			$resulSQL= $conec->ejecutarSQL($consulta);
			return $resulSQL;
		}	
		public function publicarAnuncio($titulo, $desc, $cap, $ciudad, $tipo, $imagen){
			session_start();
			$date = date("Y-m-d H:i:s");
			$user = $_SESSION['id'];
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("INSERT INTO anuncio(Capacidad, Titulo, Descripcion, Fecha, ID_tipo_hospedaje, ID_ciudad,ID_usuario) VALUES ('$cap', '$titulo','$desc', '$date', '$tipo', '$ciudad', '$user')");
			$res = $conec->ejecutarSQL($consulta);
			$avisoid = $conec->lastId();
			$consulta = ("INSERT INTO imagen(enlace,ID_anuncio) VALUES ('$imagen' , '$avisoid')");
			$res = $conec->ejecutarSQL($consulta);
			return($res);
		}
		public function modificarAnuncio($titulo, $desc, $cap, $ciudad, $tipo, $imagen,$idA){
			session_start();
			$date = date("Y-m-d H:i:s");
			$user = $_SESSION['id'];
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("UPDATE anuncio SET Capacidad = '$cap', Titulo = '$titulo', Descripcion = '$desc', Fecha = '$date', ID_tipo_hospedaje = '$tipo', ID_ciudad = '$ciudad', ID_usuario = '$user' WHERE ID = '$idA'");
			$res = $conec->ejecutarSQL($consulta);
			if ($imagen){
				$consulta = ("UPDATE imagen SET enlace='$imagen' WHERE ID_anuncio='$idA'");
				$res = $conec->ejecutarSQL($consulta);
			}
			return($res);
		}
		
		public function levantarAnuncios($tipo, $ciudad, $provincia, $capacidad){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT *, anuncio.ID AS anuncio_ID
						FROM 	anuncio 
								INNER JOIN imagen ON imagen.ID_anuncio=anuncio.ID
								INNER JOIN usuario ON anuncio.ID_usuario=usuario.ID
								INNER JOIN ciudad ON ciudad.ID=anuncio.ID_ciudad
						WHERE 	(1=(CASE WHEN $tipo=-1 THEN 1 ELSE 0 END) OR anuncio.ID_tipo_hospedaje=$tipo)
						AND 	(1=(CASE WHEN $provincia=-1 THEN 1 ELSE 0 END) OR ciudad.ID_provincia=$provincia)
						AND 	(1=(CASE WHEN $ciudad=-1 THEN 1 ELSE 0 END) OR ciudad.ID=$ciudad)
						AND 	(1=(CASE WHEN $capacidad=-1 THEN 1 ELSE 0 END) OR anuncio.capacidad>=$capacidad)
						ORDER BY anuncio.ID DESC";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function levantarReservas($idAnuncio){
			$conec=new dbManager();
			$conec->conectar();
			$consulta = "SELECT fecha_inicio, fecha_fin FROM solicitud_reserva where ID_Anuncio='$idAnuncio' and estado='aceptada' order by fecha_inicio;";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function enviarSolicitud($inicial, $final, $idAnunc, $cantidad, $comentario){
			session_start();
			$date = date("Y-m-d H:i:s");
			$inicial=date_create($inicial);
			$inicial=date_format($inicial,"Y-m-d");
			$final=date_create($final);
			$final=date_format($final,"Y-m-d");
			$user = $_SESSION['id'];
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("INSERT INTO solicitud_reserva(fecha_solicitud, cantidad_personas, comentario, fecha_inicio, fecha_fin, ID_anuncio, ID_usuario) VALUES ('$date', '$cantidad','$comentario', '$inicial', '$final', '$idAnunc', '$user')");
			$res = $conec->ejecutarSQL($consulta);
			return($res);
		}
		
		public function preguntasEnviadas($idUser){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("SELECT * FROM pregunta WHERE ID_usuario='$idUser';");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function preguntasRecibidas($idUser){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("SELECT *	FROM pregunta 
									INNER JOIN anuncio ON pregunta.ID_anuncio = anuncio.ID
									WHERE anuncio.ID_usuario='$idUser';");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function solicitudesEnviadas($idUser){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("SELECT *, solicitud_reserva.ID as solicitud_ID, anuncio.ID_usuario as anuncio_user
									FROM solicitud_reserva 
									INNER JOIN anuncio ON solicitud_reserva.ID_anuncio = anuncio.ID
									WHERE solicitud_reserva.ID_usuario='$idUser'
									ORDER BY estado;");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function solicitudesRecibidas($idUser){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("SELECT *,	solicitud_reserva.ID as solicitud_ID, solicitud_reserva.ID_usuario as solicitud_user
									FROM solicitud_reserva 
									INNER JOIN anuncio ON solicitud_reserva.ID_anuncio = anuncio.ID
									INNER JOIN usuario ON solicitud_reserva.ID_usuario = usuario.ID
									WHERE anuncio.ID_usuario='$idUser'
									ORDER BY estado;");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function levantarSolicitud($id){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("SELECT * 	FROM solicitud_reserva WHERE ID='$id';");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function levantarSolicitudesFecha($inicial, $final, $idS, $idA){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("SELECT *, solicitud_reserva.ID as solicitud_ID, solicitud_reserva.ID_usuario as solicitud_user
									FROM solicitud_reserva 
									INNER JOIN anuncio ON solicitud_reserva.ID_anuncio = anuncio.ID
									INNER JOIN usuario ON solicitud_reserva.ID_usuario = usuario.ID
									WHERE 	((estado='pendiente')
									AND 	(solicitud_reserva.ID_anuncio=$idA)
									AND 	(((fecha_inicio>='$inicial' AND fecha_inicio<='$final') OR (fecha_fin>='$inicial' AND fecha_fin<='$final'))
									OR		(('$inicial'>=fecha_inicio AND '$inicial'<=fecha_fin) OR ('$final'>=fecha_inicio AND '$final'<=fecha_fin)))
									AND 	(solicitud_reserva.ID!=$idS));");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function cancelarSolicitudHuesped($id){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("UPDATE solicitud_reserva SET estado='cancelada', Visto_autor='0', Visto_huesped='1' WHERE ID='$id'");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function cancelarSolicitudAutor($id){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("UPDATE solicitud_reserva SET estado='cancelada', Visto_autor='1', Visto_huesped='0' WHERE ID='$id'");
			$conec->ejecutarSQL($consulta);
			$consulta = ("DELETE FROM reserva WHERE ID_solicitud='$id'");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function rechazarSolicitud($id){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("UPDATE solicitud_reserva SET estado='rechazada', Visto_autor='1', Visto_huesped='0' WHERE ID='$id'");
			return ($conec->ejecutarSQL($consulta));
		}
		
		public function aceptarSolicitud($id){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("UPDATE solicitud_reserva SET estado='aceptada', Visto_autor='1', Visto_huesped='0' WHERE ID='$id'");
			$conec->ejecutarSQL($consulta);
			$date = date("Y-m-d");
			$consulta = ("INSERT INTO reserva(fecha_aceptacion,ID_solicitud) VALUES ('$date' , '$id')");
			return ($conec->ejecutarSQL($consulta));
		}
		
		/*
		public function notificarPregunta($id){  //al que publico el anuncio se le informa que recibio una pregunta
			$conec=new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function notificarRespuesta($id){  //al que preguntó se le informa que le respondieron 
			$conec=new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function notificarSolicitud($id){ // al que publico el anuncio se le informa que recibio una solicitud 
			$conec=new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function notificarReserva($id){ // al que pidio solicitud se le informa si fue aceptada o rechazada 
			$conec=new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function notificarCalificación($id){ // al usuario se le informa que recibio una nueva calificación 
			$conec=new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		*/
		
		public function levantarAnuncio($idAnuncio){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "	SELECT *, 	usuario.Username AS usuario_Username,
										usuario.ID AS usuario_ID,
										tipo_hospedaje.Nombre AS tipo_hospedaje_Nombre,
										ciudad.nombre AS ciudad_nombre,
										provincia.Nombre AS provincia_Nombre,
										provincia.ID AS provincia_ID
							FROM 	anuncio 	
									INNER JOIN tipo_hospedaje ON anuncio.ID_tipo_hospedaje=tipo_hospedaje.ID 
									INNER JOIN usuario ON anuncio.ID_usuario=usuario.ID 
									INNER JOIN ciudad ON anuncio.ID_ciudad=ciudad.ID
									INNER JOIN provincia ON ciudad.ID_provincia=provincia.ID
									INNER JOIN imagen ON imagen.ID_anuncio=anuncio.ID
							WHERE anuncio.ID=$idAnuncio";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		public function levantarUsuario($idUsuario){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM usuario WHERE ID=$idUsuario";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function levantarImagen($id){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM imagen WHERE ID=$id";
			$resultSQL = $conec->ejecutarSQL($consulta);
		}
		
		public function levantarAnuncioDeUsuario($idUser){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT *, anuncio.ID AS anuncio_ID
						FROM 	anuncio 
								INNER JOIN imagen ON imagen.ID_anuncio=anuncio.ID
								INNER JOIN usuario ON anuncio.ID_usuario=usuario.ID
						WHERE ID_usuario=$idUser
						ORDER BY anuncio.ID DESC";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		public function publicarPregunta($idAnun, $idUser, $pregunta){
			$date = date("Y-m-d H:i:s");
			$conec = new dbManager();
			$conec->conectar();
			$consulta = ("INSERT INTO pregunta(fecha, texto, ID_anuncio, ID_usuario) VALUES('$date', '$pregunta', '$idAnun', '$idUser')");
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function levantarPreguntasAnuncio($idAnuncio){
 			$conec = new dbManager();
 			$conec->conectar(); 
			$consulta = "SELECT *, pregunta.ID AS pregunta_ID
 							FROM pregunta 
 								INNER JOIN usuario ON pregunta.ID_usuario=usuario.ID 
 								INNER JOIN anuncio ON pregunta.ID_anuncio=anuncio.ID
							WHERE ID_anuncio=$idAnuncio";
 			$resultSQL = $conec->ejecutarSQL($consulta);
 			return $resultSQL;
 		}

		public function publicarRespuesta($idPregunta, $respuesta){
			$date = date("Y-m-d H:i:s");
			$conec = new dbManager();
			$conec->conectar();
			$consulta = ("INSERT INTO respuesta(fecha, texto, ID_pregunta) VALUES('$date', '$respuesta', '$idPregunta')");	
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}

		public function levantarRespuestaAnuncio($idPregunta){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT *, respuesta.texto AS respuesta_texto
							FROM respuesta 
								INNER JOIN pregunta ON respuesta.ID_pregunta=pregunta.ID
								INNER JOIN anuncio ON pregunta.ID_anuncio=anuncio.ID
								INNER JOIN usuario ON anuncio.ID_usuario=usuario.ID 
							WHERE ID_pregunta=$idPregunta";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
		
		public function darDeBajaAnuncio($idAnuncio){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = ("UPDATE anuncio SET activo='0' WHERE ID='$idAnuncio'");
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}

		public function activarAnuncio($idAnuncio){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = ("UPDATE anuncio SET activo='1' WHERE ID='$idAnuncio'");
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
	}
?>