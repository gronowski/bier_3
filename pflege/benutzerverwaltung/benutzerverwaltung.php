<!DOCTYPE html>
<html>
<head>
<title>Benutzerverwaltung</title>
<link rel="stylesheet" type="text/css" href="../style/pflege.css"/> 
<meta charset="utf-8">
</head>
<body>


<?php
//Filename: benutzerverwaltung.php
require "..\credentials.php";
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
   echo "<h2>Benutzerverwaltung</h2>";
   //Alle Benutzer Anzeigen
   $sql = "SELECT * FROM login";
 $result = mysql_query($sql, $conn);
  if ($result){
    $benutzerArray = array();
    $i=0;
    while ($row=mysql_fetch_object($result)){
		echo $row->id;
		echo $row->iuser;
		echo "<a href=\"benutzer_loeschen.php?id=$row->id&name=$row->iuser\">L&oumlschen</a>";
		echo "<br />";
	}
  }   
  echo "<h1><a href=benutzer_einfuegen.php>Einfügen</a></h1>\n";
mysql_close($conn);   
?>

</body>
</html>