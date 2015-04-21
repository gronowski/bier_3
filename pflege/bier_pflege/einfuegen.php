<!DOCTYPE html>
<html>
<head>
<title>Neues Bier</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../style/pflege.css"/>
</head>
<body>
<br />
<?php
require "..\credentials.php";
//Filename: einfuegen.php
//Variablen einfangen, falls Register-globals auf off

if (isset($_POST['knopf'])){
$name=$_POST['name'];
$beschreibung=$_POST['beschreibung'];
$bild=$_POST['bild'];
$groesse=$_POST['groesse'];
$volumen=$_POST['volumen'];
$herkunftsland=$_POST['herkunftsland'];
$herkunftsort=$_POST['herkunftsort'];

require "..\..\db.php";
$table = "bier"; //MySQL-Tabelle

$conn = mysql_connect($server, $user, $pass);
if($conn)
{
echo "Daten wurden gespeichert.";
}
else
{
echo "Datenbank funktioniert nicht";
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
<br />
<a href="bildupload.php?ziel=bierbild" target="_blank">Bier-Bild hinaufladen</a>
<br />
<a href="bildupload.php?ziel=flagge" target="_blank">Landesflagge hinaufladen</a>
<br />
<form method="POST">
<br>
<table border="0">
<tr><td>
Name: </td><td><input type ="text" name="name"><br /></td>
<tr><td>
Beschreibung: </td><td><br /><textarea rows="6" cols="50" name="beschreibung"></textarea></td>
<tr><td>
Bild: </td><td>
<?php
// Mit den folgenden Zeilen lassen sich
// alle Dateien in einem Verzeichnis auslesen
$handle=opendir ("..\..\bier_bilder");
echo "<select name=\"bild\">";
while ($datei = readdir ($handle)) {
 if(!is_dir($datei)){
   echo "<option name=\"$datei\">$datei</option>"; 
   }
}
echo "</select><br />";
closedir($handle);
?>
</td>
<tr><td>
Volumen (in Cl): </td><td><input size="5" type="text" name="groesse"><br /></td>
<tr><td>
Herkunftsland: </td><td><input type="text" size="30" name="herkunftsland"><br /></td>
<tr><td>
Herkunftsort: </td><td><input type="text" size="30" name="herkunftsort"><br /></td>
<tr><td>
Prozent: </td><td><input type="text" size="5" name="volumen"><br /></td>
</tr>
</table>
<input type="submit" name="knopf" value="speichern">
</form>
<?php
}
?>
<br>
<a href="bier_pflege.php">Zurück</a>
</body>
</html>