<?php
if (isset($_POST['senden'])){
	$iuser=$_POST['iuser'];
	$ipw=$_POST['ipw'];
    $ipw2=$_POST['ipw2'];
  
  // Verbinden mit Datenbankserver
  require "..\db.inc";
 
    if (!($conn = mysql_connect($server, $user, $pass))) {
		echo("Fehler bei der Verbindung mit dem Host");
		exit();
		}
    if (!mysql_select_db($db, $conn)) {
      echo "Fehler beim Selektieren der Datenbank: $databaseName<br>";
      echo "Fehlernummer " . mysql_errno($conn) . "<br>";      
      exit();
   }
   //Passwörter
   $ipw=md5($ipw);
   $ipw2=md5($ipw2);
   
   //Benutzer
   $iuser = trim($iuser);
   
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
</html>
<head>
<title>Benutzer erstellen</title>
<link rel="stylesheet"type="text/css" href="login_register.css"/> 
<meta charset="utf-8">
</head>
<body>
<h2>Neuer Benutzer erstellen</h2>
<form method="post">
<p><input type="text" name="iuser" placeholder="Benutzername" required></p>
<p><input type="password" name="ipw" placeholder="Passwort" required></p>
<p><input type="password" name="ipw2" placeholder="Passwort wiederholen" required></p>
<p><input type="submit" value="Erstellen" name="senden"></p>
</form>

</body>
</html>