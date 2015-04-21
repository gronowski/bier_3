<?php
session_start();

//$iuser="Hans";
//$ipw=md5("123");
$euser="";
if(isset($_SESSION['sepw'])){
$epw=$_SESSION["sepw"];
$euser=$_SESSION["seuser"];
}
require "..\..\db.php";
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
if (array_key_exists($euser,$assozArray) && $epw!=""){
$ipw=$assozArray["$euser"];
$iuser=$euser;
}
else
{
echo "User ".$euser." existiert nicht oder falsches Passwort.</br>";
exit;
}
?>