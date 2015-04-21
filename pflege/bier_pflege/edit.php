<!DOCTYPE html>
<html>
<head>
<title>Zeile Editieren</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../style/pflege.css"/>
</head>
<body>
<br />
<?php
//Filename: edit.php
//beim ersten Laden 
require "..\credentials.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  
require "..\..\db.php";
$table = "bier"; //MySQL-Tabelle

$conn = mysql_connect($server, $user, $pass);
if($conn) {
//echo "<B>Datenbank OK!";
} else {
echo "<B>Datenbank funktioniert nicht";
exit;
}
$select = mysql_select_db($db,$conn);
$sql = "SELECT * FROM $table WHERE id=".$id;
$result = mysql_query($sql, $conn);
if ($result)
{
// Lösung mit mysql_fetch_object
while ($row=mysql_fetch_object($result)){
$id= $row->id;
$name= $row->name;
$beschreibung= $row->beschreibung;
$bild= $row->bild;
$groesse= $row->groesse;
$volumen= $row->volumen;
$herkunftsland= $row->herkunftsland;
$herkunftsort= $row->herkunftsort;
}
}
else
{
echo "<P>".mysql_error($conn);
}
mysql_close($conn); 
}
//beim zweiten Laden, falls Formular abgeschickt wurde
if (isset($_POST['knopf'])){
$id=$_POST['id'];
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
echo "Update erfolgreich!";
}
else
{
echo "Datenbank funktioniert nicht";
echo mysql_errno($conn) . ": " . mysql_error($conn). "\n";
exit;
}
$select = mysql_select_db($db,$conn);
$sql="UPDATE $table SET name='$name', beschreibung='$beschreibung', bild='$bild', 
groesse='$groesse',volumen='$volumen' ,herkunftsland='$herkunftsland' ,herkunftsort='$herkunftsort' WHERE id=$id";
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

<table border="0">
<tr><td>
Id: </td><td><input type="text" readonly name="id" value="<?php echo $id ?>"><br /></td>
</tr>
<tr><td>
Name:</td><td> <input type ="text" name="name" value="<?php echo utf8_encode($name) ?>"><br /></td>
</tr>
<tr><td>
Beschreibung: </td><td><textarea rows="6" cols="50" name="beschreibung"><?php echo utf8_encode($beschreibung) ?></textarea></td>
</tr>
<tr><td>
Bild:</td><td> 
<?php
// Mit den folgenden Zeilen lassen sich
// alle Dateien in einem Verzeichnis auslesen
$handle=opendir ("..\..\bier_bilder");
echo "<select name=\"bild\">";
echo "<option name=\"$bild\">$bild</option>"; 
while ($datei = readdir ($handle)) {
 if(!is_dir($datei)){
   echo "<option name=\"$datei\">$datei</option>"; 
   }
}
echo "</select><br />";
closedir($handle);
?>
</td></tr>

	<tr>
		<td>
			Volumen (in Cl.): 
		</td>
		<td>
			<input size="5" type="text" name="groesse" value="<?php echo $groesse ?>"><br />
		</td>
	</tr><td>


Herkunftsland: </td><td><input type="text" size="30" name="herkunftsland" value="<?php echo utf8_encode($herkunftsland) ?>"></td>
</tr>
<tr><td>
Herkunftsort:</td><td> <input type="text" size="30" name="herkunftsort" value="<?php echo utf8_encode($herkunftsort) ?>"></td>
</tr>
<tr><td>
Prozent: </td><td> <input type="text" size="5" name="volumen" value="<?php echo $volumen?>"></td>
</tr>
</table>
<input type="submit" name="knopf" value="speichern">
</form>
<a href="bildupload.php?ziel=bierbild" target="_blank">Bier-Bild hinaufladen</a>
<?php
}
?>
<br />
<a href="bier_pflege.php">Zurück</a>
</body>
</html>