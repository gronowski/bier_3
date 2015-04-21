<!DOCTYPE html>
<html>
<head>
<title>Bier löschen</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../style/pflege.css"/>
</head>
<body>
<?php
//Filename: loeschen.php
require "..\credentials.php";
$id=$_GET['id'];
$name=$_GET['name'];
if (isset($_POST['senden']))
{
	$id=$_POST['id1'];
	
	require "..\..\db.php";
	$table = "bier"; //MySQL-Tabelle

$conn = mysql_connect($server, $user, $pass);
if($conn)
{
//echo "<B>Datenbank OK!";
}
else
{
echo "Datenbank funktioniert nicht";
echo mysql_errno($conn) . ": " . mysql_error($conn). "\n";
exit;
}
$select = mysql_select_db($db,$conn);
$sql = "DELETE FROM $table WHERE id=".$id;
//echo $sql;
$result = mysql_query($sql, $conn);
if(!$result){
echo mysql_errno($conn) . ": " . mysql_error($conn). "\n";
mysql_close($conn);
}
else
echo "Gelöscht";
}
else
{
?>
<form method="post">
<?php
echo "<h1>Wollen sie dieses Bier wirklich Löschen?</h1>"
?>
<input type="text" name="id1" value="<?php echo $id; ?>" readonly><br />
<input type="text" name="name" value="<?php echo $name; ?>" readonly>
<input type="submit" name="senden" value="Löschen">
</form>
<br />
<?php
}
?>
<br />
<a href="bier_pflege.php">Zurück</a>
</body>
</html>
