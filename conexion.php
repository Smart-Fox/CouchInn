<?php

class Conexion extends mysqli{

	public function __construct(){
		parent::__construct('localhost','root','admin','couchinn');
		$this->query("SET NAMES 'utf8';");
		$this->connect_errno ? die('Error con la conexi&oacute;n') : $x = 'Conectado';
	}
}

?>