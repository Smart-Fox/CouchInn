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
		/*public function __construct($titulo, $desc, $cap, $ciudad, $tipo, $imagen){
			$this->titulo= $titulo;
			$this->descripcion = $desc;
			$this->capacidad = $cap;
			$this->ciudad = $ciudad;
			$this->tipo = $tipo;
			$this->imagen = $imagen;
			$this->user = $_SESSION['id'];
			$this->date = date("Y-m-d H:i:s");
		}*/
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
			$res = $conec->ejecutarSQL($consulta);}
			return($res);
		}
		public function levantarAnuncios(){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM anuncio ORDER BY ID DESC";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}		
		public function levantarAnuncio($idAnuncio){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM anuncio WHERE ID=$idAnuncio";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}		
		public function levantarAnuncioTipo($idTipo){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM tipo_hospedaje WHERE ID=$idTipo";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}		
		public function levantarAnuncioAutor($idUser){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM usuario WHERE ID=$idUser";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}		
		public function levantarAnuncioCiudad($idCiudad){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM ciudad WHERE ID=$idCiudad";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}		
		public function levantarAnuncioProv($idProv){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM provincia WHERE ID=$idProv";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}		
		public function levantarImagen($idAnuncio){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM imagen WHERE ID_anuncio=$idAnuncio";
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
		public function levantarAnuncioDeUsuario($idUser){
			$conec = new dbManager();
			$conec->conectar();
			$consulta = "SELECT * FROM anuncio WHERE ID_usuario=$idUser";
			$resultSQL = $conec->ejecutarSQL($consulta);
			return $resultSQL;
		}
	}
?>