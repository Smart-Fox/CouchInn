<?php
	include('dbManager.php');
	session_start();
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
			// return $consulta;

		}
		public function levantarTipos(){
			$conec = new dbManager();
			$conec->conectar();

			$consulta = "SELECT * FROM tipo_hospedaje WHERE deleted=0";
			$resulSQL= $conec->ejecutarSQL($consulta);
			return $resulSQL;

		}
		public function publicarAnuncio($titulo, $desc, $cap, $ciudad, $tipo, $imagen){
			$date = date("Y-m-d H:i:s");
			$user = $_SESSION['id'];
			$conec = new dbManager();
			$conec->conectar();	

			$consulta = ("INSERT INTO anuncio(Capacidad, Titulo, Descripcion, Fecha, ID_tipo_hospedaje, ID_ciudad,ID_usuario) VALUES ('$cap', '$titulo','$desc', '$date', '$tipo', '$ciudad',$user)");
			$conec->ejecutarSQL($consulta);
			$avisoid = $conec->lastId();
			$consulta = ("INSERT INTO imagen(enlace,ID_anuncio) VALUES ('$imagen' , '$avisoid')");
			$res = $conec->ejecutarSQL($consulta);
			return($res);
		}
	}

?>