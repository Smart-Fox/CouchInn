<?php
	include('anuncioService.php');

	$titulo = $_POST['titulo'];
	$descripcion = $_POST['desc'];
	$capacidad = $_POST['capacidad'];
	$provincia = $_POST['provincia'];
	$ciudad = $_POST['ciudad'];
	$tipo = $_POST['tipo'];
	
	$target_dir = "img/";
	$newfilename = round(microtime(true)).'_'. basename($_FILES["fileToUpload"]["name"]);
	$target_file = $target_dir . $newfilename;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
  	  	$uploadOk = 1;
	}else{
	   	$uploadOk = 0;
    }
	if (file_exists($target_file)) {
	    $uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "JPEG" && $imageFileType != "PNG" && $imageFileType != "gif" && $imageFileType != "GIF") {
    	$uploadOk = 0;
	}
	if ($uploadOk == 0){
	}else{
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
		}
	}
	$service = new aService();
	$res = $service->publicarAnuncio($titulo, $descripcion, $capacidad, $ciudad,$tipo,$newfilename);
	header("Location: pagPrinc.php");
 ?>