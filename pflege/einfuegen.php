<!DOCTYPE html>
<html>
<head>
<title>Neues Bier</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<br>
<?php
require "credentials.inc";
//einfuegen.php
//Variablen einfangen, falls Register-globals auf off

if (isset($_POST['knopf'])){
$name=$_POST['name'];
$beschreibung=$_POST['beschreibung'];
$bild=$_POST['bild'];
$groesse=$_POST['groesse'];
$volumen=$_POST['volumen'];
$herkunftsland=$_POST['herkunftsland'];
$herkunftsort=$_POST['herkunftsort'];

require "..\db.inc";
/*
$server = "localhost"; // MySQL-Server
$user = "root"; // MySQL-Nutzer
$pass = ""; // MySQL-Kennwort
$db = "miguel"; // MySQL-Datenbank
$table = "bier"; //Tabelle
*/
$conn = mysql_connect($server, $user, $pass);
if($conn)
{
echo "<B>Daten wurden gespeichert.";
}
else
{
echo "<B>Datenbank funktioniert nicht";
echo mysql_errno($conn) . ": " . mysql_error($conn). "\n";
exit;
}
$select = mysql_select_db($db,$conn);
$sql = "INSERT INTO $table (name, beschreibung, bild, groesse, volumen, herkunftsland, herkunftsort) VALUES ('$name','$beschreibung','$bild',$groesse, $volumen,'$herkunftsland','$herkunftsort');";
//echo $sql;
$result = mysql_query($sql, $conn);
if(!$result)
   echo mysql_errno($conn) . ": " . mysql_error($conn). "\n";
mysql_close($conn);
}
else
{
?>
<form method="POST">
Name: <input type ="text" name="name"><br />
Beschreibung: <br /><textarea rows="6" cols="50" name="beschreibung"></textarea><br />
Bild: <input type="file" name="bild"><br />
Grösse: <input size="5" type="text" name="groesse"><br />
Herkunftsland: <input type="text" size="30" name="herkunftsland"><br />
Herkunftsort: <input type="text" size="30" name="herkunftsort"><br />
Volumen: <input type="text" size="5" name="volumen"><br />
<input type="submit" name="knopf" value="speichern">
</form>
<?php
}
?>
<br/>
<a href="upload_bierbilder.php">Bier-Bild hinaufladen</a>
<br/>
<a href="upload_flaggen.php">Landesflagge hinaufladen</a>
<br/>
<a href="bier_pflege.php">Zurück</a>
</body>
</html>