<?php
/*if(isSet($_POST['username']))
{
$usernames = array('john','michael','terry', 'steve', 'donald');

$username = $_POST['username'];

if(in_array($username, $usernames))
	{
	echo '<font color="red">The nickname <STRONG>'.$username.'</STRONG> is already in use.</font>';
	}
	else
	{
	echo 'OK';
	}
}

*/


// This is a sample code in case you wish to check the username from a mysql db table

if(isSet($_GET['username']))
{
$username = $_GET['username'];


$db = new mysqli('localhost', 'root', '', 'couchinn') or die ('Cannot connect to db');

$sql_check = $db->query("SELECT Username FROM usuario WHERE Username = '".$username."'");

if(mysqli_num_rows($sql_check))
{
echo '<font color="red">The nickname <STRONG>'.$username.'</STRONG> is already in use.</font>';
}
else
{
echo 'OK';
}

}


?>