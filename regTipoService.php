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
		
		public function reagregarTipo(){
			$conec = new dbManager();
			$conec->conectar();
			$bool=0;
			$consulta = ("UPDATE tipo_hospedaje SET Deleted='$bool' WHERE Nombre='$this->nombre';");
			return($conec->ejecutarSQL($consulta));
		}
		
		public function eliminarFisico($id){
			$conec = new dbManager();
			$conec->conectar();
			$consulta4=("DELETE FROM tipo_hospedaje WHERE Nombre='$this->nombre';");
			return($conec->ejecutarSQL($consulta4));
		}
		
		public function eliminarLogico(){
			$conec = new dbManager();
			$conec->conectar();
			$consulta1 = ("SELECT ID FROM tipo_hospedaje WHERE nombre='$this->nombre';");
			$result=$conec->ejecutarSQL($consulta1);
			$dato=$result->fetch_assoc();
			$id=$dato['ID'];
			$bool=1;
			$consulta3=("UPDATE tipo_hospedaje SET Deleted='$bool' WHERE ID='$id';");
			return($conec->ejecutarSQL($consulta3));
		}
		
		public function revisarTipo(){
			$conec = new dbManager();
			$conec->conectar();
			$consulta1 = ("SELECT ID FROM tipo_hospedaje WHERE nombre='$this->nombre';");
			$result=$conec->ejecutarSQL($consulta1);
			$dato=$result->fetch_assoc();
			$id=$dato['ID'];
			$consulta2=("SELECT * FROM anuncio WHERE ID_tipo_hospedaje='$id';");
			$result=$conec->ejecutarSQL($consulta2);
			return(mysqli_num_rows($result));
		}
		
		public function verificarTipo(){
			$conec = new dbManager();
			$conec->conectar();	
			$consulta = ("SELECT * FROM tipo_hospedaje WHERE Nombre='$this->nombre';");
			$resulSQL = $conec->ejecutarSQL($consulta);
			$dato = $resulSQL->fetch_assoc();
			if ($dato['Nombre'] == $this->nombre) {
				if($dato['Deleted']==1){
					return 0;
				}else{
					return 1;
				}
			}else{
				return 2;
			}
			
		}
		
	}
	
?>