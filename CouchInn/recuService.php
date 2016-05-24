<?php
	include('dbManager.php');
	class recuService{
		protected $email;
		protected $telefono;

		public function __construct($mail, $telefono){
			$this->email = $mail;
			$this->telefono = $telefono;
		}

		public function buscarUsuario($mail){
			$conec = new dbManager();
			$conec->conectar();

			$consulta = ("SELECT Email FROM usuario WHERE Email='$this->email' and Telefono='$this->telefono';");
			$resulSQL= $conec->ejecutarSQL($consulta);

			if($resulSQL['Email'] == $mail ) {
				return true;
			} else {
				return false;
			}

		}

		public function recuperaContraseña($mail){
			$conec = new dbManager();
			$conec->conectar();

			$consulta= ("SELECT Email, Contraseña FROM usuario WHERE Email='$this->email';");
			$resulSQL= $conec->ejecutarSQL($consulta);

			if ($resulSQL['Email'] == $mail) {
				return $resulSQL['Contraseña'];
			}

		}

	}

?>