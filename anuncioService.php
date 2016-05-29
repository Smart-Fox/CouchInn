<?php
	include('dbManager.php');
	class aService{

		protected $titulo;
		protected $descripcion;
		protected $capacidad;
		protected $provincia;
		protected $ciudad;
		protected $tipo;
		protected $imagen;
		protected $user;
		protected $date;

		public function __construct(){
			$this->user = $_SESSION['usuario'];
			$this->date = date("Y-m-d H:i:s");
		}

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

			$consulta = "SELECT * FROM tipo_hospedaje";
			$resulSQL= $conec->ejecutarSQL($consulta);
			return $resulSQL;

		}
	}

?>