<?php
	include('anuncioService.php');
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['desc'];
	$capacidad = $_POST['capacidad'];
	$provincia = $_POST['provincia'];
	$ciudad = $_POST['ciudad'];
	$tipo = $_POST['tipo'];
	$idA=$_POST['anunc'];

	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if($_FILES["fileToUpload"]["tmp_name"]) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
  	  	$uploadOk = 1;
		} else {
    	$uploadOk = 0;
    }
	if (file_exists($target_file)) {
	    $uploadOk = 0;
		}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "JPEG" && $imageFileType != "PNG" && $imageFileType != "gif" && $imageFileType != "GIF") {
    	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    	$uploadOk = 0;
		}
	if ($uploadOk == 0) {

	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	    	//OK
	    } 
	}}
	$service = new aService();
	$res = $service->modificarAnuncio($titulo, $descripcion, $capacidad, $ciudad,$tipo,basename( $_FILES["fileToUpload"]["name"]),$idA);
	// header("Location: pagPrinc.php");
?>