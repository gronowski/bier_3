<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet"type="text/css" href="style/login_register.css"/> 
</head>
<body>
<?php
//Filname: login.php
session_start();
$ipw=""; 

require "..\db.inc";

$conn = mysql_connect($server, $user, $pass);
if($conn) {
//echo "<B>Datenbank OK!";
} else {
echo "<B>Datenbank funktioniert nicht";
exit;
}
$select = mysql_select_db($db,$conn);
 $sql = "SELECT * FROM login";
 $result = mysql_query($sql, $conn);
  if ($result){
     $assozArray = array();
     $i=0;
     while ($row=mysql_fetch_object($result)){
	   $assozArray[$row->iuser]=$row->ipw;	      
	 }
  }         

  //Testausgabe
//echo "Passwort: ".$assozArray['Hans'];

if (isset($_POST['senden'])){
$euser=$_POST['euser'];
$epw=$_POST['epw'];

//ipw mit euser aus assoziativem Arrray herausnehmen
//Falls ein Index nicht vorhanden ist => Nirwana, daher abfangen
if (array_key_exists($euser,$assozArray)){
$ipw=$assozArray["$euser"];
$iuser=$euser;
}
//else
//echo "User ".$euser." existiert nicht, </ br>";

//echo "ipw :".$ipw;

//$ipw=md5($ipw);

$epw=md5($epw);

//echo "<br>User: $euser <br>";
//echo "PW: $epw $ipw<br>";
if($ipw==$epw){
	$_SESSION["sepw"]=$epw;
	$_SESSION["seuser"]=$euser;
	header('Location: bier_pflege.php');
//echo "Sie haben Zutritt: ";
//echo "<a href=\"bier_pflege.php\">Bier Pflege</a>";
}
else
{
echo "<h2>Benutzername oder Passwort falsch</h2>";
}

}

?>
<h2>Login to your bier</h2>
<form method="post">
<p><input type="text" name="euser" placeholder="Benutzername" required></p>
<p><input type="password" name="epw" placeholder="Passwort" required></p>
<p><input type="submit" value="Login" name="senden"></p>
</form>
<?php

?>
</body>
</html>


