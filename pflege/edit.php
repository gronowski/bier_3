<!DOCTYPE html>
<html>
<head>
<title>Zeile Editieren</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<br>
<?php
//edit.php
//beim ersten Laden 
require "credentials.inc";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  
  require "..\db.inc";
  
  /*
$server = "localhost"; // MySQL-Server
$user = "root"; // MySQL-Nutzer
$pass = ""; // MySQL-Kennwort
$db = "miguel"; //MySQL-Datenbank
$table = "bier"; //MySQL-Tabelle
*/

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
echo "<B>Update erfolgreich!";
}
else
{
echo "<B>Datenbank funktioniert nicht";
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
Id: <input type="text" name="id" value="<?php echo $id ?>"><br />
Name: <input type ="text" name="name" value="<?php echo utf8_encode($name) ?>"><br />
Beschreibung: <br /><textarea rows="6" cols="50" name="beschreibung"><?php echo utf8_encode($beschreibung) ?></textarea><br />
Bild: <input type="text" name="bild" value="<?php echo $bild ?>" ><br />
Grösse: <input size="5" type="text" name="groesse" value="<?php echo $groesse ?>"><br />
Herkunftsland: <input type="text" size="30" name="herkunftsland" value="<?php echo utf8_encode($herkunftsland) ?>"><br />
Herkunftsort: <input type="text" size="30" name="herkunftsort" value="<?php echo utf8_encode($herkunftsort) ?>"><br />
Volumen: <input type="text" size="5" name="volumen" value="<?php echo $volumen?>"><br />
<input type="submit" name="knopf" value="speichern">
</form>
<a href="upload_bierbilder.php">Bier-Bild hinaufladen</a>
<?php
}
?>
<br>
<a href="bier_pflege.php">Zurück</a>
</body>
</html>