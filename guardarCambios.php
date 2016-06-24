<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perfil</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel='stylesheet' href='style.css'/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<?php
		include('anuncioService.php');
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['desc'];
		$capacidad = $_POST['capacidad'];
		$provincia = $_POST['provincia'];
		$ciudad = $_POST['ciudad'];
		$tipo = $_POST['tipo'];
		$idA=$_POST['anunc'];
		
		$boolean=false;
		$newfilename='';
		if ($_FILES["fileToUpload"]["name"]!=""){
			$target_dir = "img/";
			$newfilename = round(microtime(true)).'_'. basename($_FILES["fileToUpload"]["name"]);
			$target_file = $target_dir . $newfilename;
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
					move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)
					} 
				}
			}
		}
		$service = new aService();
		$res = $service->modificarAnuncio($titulo, $descripcion, $capacidad, $ciudad,$tipo,$newfilename,$idA);
		$boolean=true;
	
		if($boolean){
			echo "	
				<form id='back' action='cambiosG.php' method='POST' enctype='multipart/form-data'>
					<input class='hidden' name='anunc' value=".$idA.">	
				</form>
				<script type='text/javascript'>
					function submitForm() {
						document.getElementById('back').submit();
					}
					window.onload = submitForm;
				</script>
			";
		}
	?>
</body>
</html>