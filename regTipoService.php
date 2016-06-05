<?php
	
	include('dbManager.php');

	class regTipoService{

		protected $nombre;
				

		public function __construct($nom){
			$this->nombre = $nom;
		}

		public function registrarTipo(){
			$conec = new dbManager();
			$conec->conectar();	

			$consulta = ("INSERT INTO tipo_hospedaje(Nombre) VALUES ('$this->nombre');");
			return ($conec->ejecutarSQL($consulta));
			
		}
		
		public function modificarTipo($newname){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("UPDATE tipo_hospedaje SET Nombre='$newname' WHERE Nombre='$this->nombre';");
			return ($conec->ejecutarSQL($consulta));
			
		}
		
		public function verificarTipo(){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("SELECT Nombre FROM tipo_hospedaje WHERE Nombre='$this->nombre';");
			$resulSQL = $conec->ejecutarSQL($consulta);
			
			if ($resulSQL['Nombre'] == $this->nombre) {
				return true;
			}else{
				return false;
			}
			
		}
		
	}
	
?>