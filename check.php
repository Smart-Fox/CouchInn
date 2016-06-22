<?php

if(isSet($_POST['username'])){
	$username = $_POST['username'];


	$db = new mysqli('localhost', 'root', 'admin', 'couchinn') or die ('Cannot connect to db');

	$sql_check = $db->query("SELECT username FROM usuario WHERE username = '".$username."';");

	if(mysqli_num_rows($sql_check)){
		echo '<font color="red">Nombre de usuario en uso</font>';
		}
		else{
			echo '<font color="green">Nombre de usuario disponible</font>';
		}
}


?>