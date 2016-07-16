<?php

if(isSet($_POST['email'])){
	$email = $_POST['email'];


	$db = new mysqli('localhost', 'root', '', 'couchinn') or die ('Cannot connect to db');

	$sql_check = $db->query("SELECT Email FROM usuario WHERE Email = '".$email."';");

	if(mysqli_num_rows($sql_check)){
		echo '<font color="red">E-mail en uso</font>';
		}
		else{
			echo '<font color="green">E-mail disponible</font>';
		}
}


?>