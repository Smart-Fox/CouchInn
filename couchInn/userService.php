<?php
	
	include('dbManager.php');
	
	class UserService {

		protected $user;
		protected $pass;

		public function __construct($us, $pw){
			$this->user = $us;
			$this->pass = $pw;
		}

		public function dameUsuario(){
			$conec = new dbManager();
			$conec->conectar();	

			$consulta = ("SELECT Nombre,Email,Contraseña FROM usuario WHERE Email='$this->user' and Contraseña= '$this->pass';");

			return ($conec->ejecutarSQL($consulta));
		}



	}



?>