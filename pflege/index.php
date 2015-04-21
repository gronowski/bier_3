<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style/pflege.css"/>
</head>
<body>
<h2>Login to your bier</h2>
<?php
//Filename: login.php
session_start();
$ipw=""; 

require "..\db.php";
$table = "login"; //MySQL-Tabelle

$conn = mysql_connect($server, $user, $pass);
if($conn) {
//echo "<B>Datenbank OK!";
} else {
echo "<B>Datenbank funktioniert nicht";
exit;
}
$select = mysql_select_db($db,$conn);
 $sql = "SELECT * FROM $table";
 $result = mysql_query($sql, $conn);
  if ($result){
    $assozArray = array();
    $i=0;
    while ($row=mysql_fetch_object($result)){
		$assozArray[$row->iuser]=$row->ipw;	      
	}
  }         

if (isset($_POST['senden'])){
	$euser=$_POST['euser'];
	$epw=$_POST['epw'];

	//ipw mit euser aus assoziativem Arrray herausnehmen
	//Falls ein Index nicht vorhanden ist => Nirwana, daher abfangen
	if (array_key_exists($euser,$assozArray)){
		$ipw=$assozArray["$euser"];
		$iuser=$euser;
	}

	$epw=md5($epw);
	if($ipw==$epw){
		$_SESSION["sepw"]=$epw;
		$_SESSION["seuser"]=$euser;
		echo "<a href=\"bier_pflege/bier_pflege.php\">Bierpflege</a> <br />";
		echo "<a href=\"benutzerverwaltung/benutzerverwaltung.php\">Benutzerverwaltung</a>";
	}
	else
	{
	echo "<h2>Benutzername oder Passwort falsch</h2>";
	}
}
else
{
?>
<form method="post">
<p><input type="text" name="euser" placeholder="Benutzername" required></p>
<p><input type="password" name="epw" placeholder="Passwort" required></p>
<p><input type="submit" value="Login" name="senden"></p>
</form>
</body>
</html>
<?php
}
?>