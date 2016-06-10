<?php
	include('dbManager.php');
	class recuService{
		protected $email;

		public function __construct($mail){
			$this->email = $mail;
		}

		public function buscarUsuario($mail){
			$conec = new dbManager();
			$conec->conectar();

			$consulta = ("SELECT Email FROM usuario WHERE Email='$this->email'");
			$resulSQL= $conec->ejecutarSQL($consulta);
			$datos = $resulSQL->fetch_row();
			if($datos[0] == $mail ) {
				return true;
			} else {
				return false;
			}

		}

		public function recuperaContraseña($mail){
			$conec = new dbManager();
			$conec->conectar();

			$consulta= ("SELECT Email, Contraseña FROM usuario WHERE Email='$this->email'");
			$resulSQL= $conec->ejecutarSQL($consulta);
			$dato = $resulSQL->fetch_assoc();
		
			if ($dato['Email'] == $mail) {
				return $dato['Contraseña'];
			}

		}

	}

?>