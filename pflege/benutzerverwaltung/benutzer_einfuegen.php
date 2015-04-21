<!DOCTYPE html>
<html>
<head>
<title>Benutzer erstellen</title>
<link rel="stylesheet" type="text/css" href="../style/pflege.css"/> 
<meta charset="utf-8">
</head>
<body>
<?php
//Filename: benutzer_einfuegen.php
require "..\credentials.php";

if (isset($_POST['senden'])){
	$iuser=$_POST['iuser'];
	$ipw=$_POST['ipw'];
    $ipw2=$_POST['ipw2'];
  
  // Verbinden mit Datenbankserver
  require "..\..\db.php";
  $table = "login"; //MySQL-Tabelle
 
    if (!($conn = mysql_connect($server, $user, $pass))) {
		echo("Fehler bei der Verbindung mit dem Host");
		exit();
		}
    if (!mysql_select_db($db, $conn)) {
      echo "Fehler beim Selektieren der Datenbank: $databaseName<br />";
      echo "Fehlernummer " . mysql_errno($conn) . "<br />";      
      exit();
   }
   
   //Überprüfen, ob Username schon exisitert
    $sql = "SELECT iuser FROM login";
    $result = mysql_query($sql, $conn);
		if (!$result){
		   echo mysql_errno($conn) . ": " . mysql_error($conn) . "\n";
			mysql_close($conn);
	   }
    else{
     $userArray = array();
     $i=0;
     while ($row=mysql_fetch_object($result)){
	   $userArray[$i]=$row->iuser;
	   //echo $userArray[$i];
	   $i++;	   
	 }
  }      
   
    //Benutzer
   $iuser = trim($iuser);
   
   //Prüfen, ob IUsername schon im Array vorhanden
   if (in_array($iuser,$userArray)){
      echo "Username $iuser schon vorhanden";
	  exit;
	  }
      
   
   
   //Passwörter
   $ipw=md5($ipw);
   $ipw2=md5($ipw2);
   
  
   
   if($ipw == $ipw2 && $iuser != NULL){
	   $sql = "INSERT INTO login (iuser, ipw) VALUES ('$iuser','$ipw');";
	   //echo $sql;
	   echo "<h2>Benutzer wurde erstellt.</h2>";
	   $result = mysql_query($sql, $conn);
		if (!$result){
		   echo mysql_errno($conn) . ": " . mysql_error($conn) . "\n";
			mysql_close($conn);
	   }
   }
	else{
		echo "<h2>Passwörter stimmen nicht überein.</h2>";
		echo "<h2>Oder mindestens eines der Felder ist leer.</h2>";
		   
		   
	}
   mysql_close($conn);
}
?>

<h2>Neuen Benutzer erstellen</h2>
<form method="post">
<p><input type="text" name="iuser" placeholder="Benutzername" required></p>
<p><input type="password" name="ipw" placeholder="Passwort" required></p>
<p><input type="password" name="ipw2" placeholder="Passwort wiederholen" required></p>
<p><input type="submit" value="Erstellen" name="senden"></p>
</form>
<a href="benutzerverwaltung.php">Zurück</a>
</body>
</html>