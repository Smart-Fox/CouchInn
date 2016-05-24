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
			$consulta = ("SELECT Username,Email,Contraseña,Tipo FROM usuario WHERE Email='$this->user' and Contraseña='$this->pass';");
			echo $this->pass;
			return ($conec->ejecutarSQL($consulta));
		}



	}



?>