<?php
	
	include('dbManager.php');

	class registerService{

		protected $nombre;
		protected $apellido;
		protected $email;
		protected $password;
		protected $telefono;
		protected $nomUser;

		public function __construct($nom, $ape, $mail, $pass, $telefono, $nomUser){
			$this->nombre = $nom;
			$this->apellido = $ape;
			$this->email = $mail;
			$this->password = $pass;
			$this->telefono = $telefono;
			$this->nomUser = $nomUser;
		}

		public function registrarUsuario(){
			$conec = new dbManager();
			$conec->conectar();	

			$consulta = ("INSERT INTO usuario(Nombre, Apellido, Telefono, Username, Email, Contraseña) VALUES ('$this->nombre', '$this->apellido','$this->telefono', '$this->nomUser', '$this->email', '$this->password');");
			return ($conec->ejecutarSQL($consulta));
			
		}

		public function verificarUsuario($mail, $user){
			$conec = new dbManager();
			$conec->conectar();	

			$consulta = ("SELECT Email FROM usuario WHERE Email= '$this->email';");
			$consulta2 = ("SELECT Username FROM usuario WHERE Username='$this->nomUser';");

			$resulSQL = $conec->ejecutarSQL($consulta);
			$result2 = $conec->ejecutarSQL($consulta2);

			$dato = $resulSQL->fetch_assoc();
			$dato2 = $result2->fetch_assoc();
			if ($dato['Email'] == $mail || $dato2['Username'] == $user) {
				return true;
			}else{
				return false;
			}
			
		}



	}


?>