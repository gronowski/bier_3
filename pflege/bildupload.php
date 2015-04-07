<?php
require "credentials.inc";
$ziel=$_GET['ziel']; //bierbild oder flagge
echo "<p>Hallo, hier kannst du deine Bilder hochladen.</p>";
?>
<form  method="post" enctype="multipart/form-data">
    Bild File wählen:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="upload">
	
</form>
<?php

if (isset($_POST['upload'])) {
	
	if ($ziel=="bierbild")
       $target_dir = "../bier_bilder/";
	else {
	   if ($ziel=="flagge")
          $target_dir = "../flaggen/";
	   else
	      echo "falscher Query String";
     }
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
//    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, Die Datei gibts schon ";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, dein Bild ist zu gross. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "gif" && $imageFileType != "png") {
    echo "Es sind nur Bilder erlaubt, Sorry ;) ";
    $uploadOk = 0;
}
// Überprüft $uploadOk durch einen Fehler auf 0 gesetzt wurde
if ($uploadOk == 0) {
    echo "Sorry, Datei wurde nicht hochgeladen ";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, Es ist ein Fehler beim upload aufgetretten. ";
    }
}

//}
}//Wenn man eingeloggt ist
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/login_register.css"/> 
	<title>Dateien hochladen</title>
</head>
<body>
	<a href="bier_pflege.php">Zur&uuml;ck</a>
</body>
</html>
