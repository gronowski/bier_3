<!DOCTYPE html>
<html>
<head>
<title>Bier Datenbank</TITLE>
<link rel="stylesheet"type="text/css" href="style/style.css"/> 
</head>
<body>
<?php
//Filname: bier_pflege.php
//überall wo Login notwendig ist, einschliessen
require "credentials.inc";

/*
session_start();

//$iuser="Hans";
//$ipw=md5("123");

$epw=$_SESSION["sepw"];
$euser=$_SESSION["seuser"];

require "db.inc";

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
//$iuser="Hans";
//$ipw=$assozArray['Hans'];
if (array_key_exists($euser,$assozArray)){
$ipw=$assozArray["$euser"];
$iuser=$euser;
}
else
echo "User ".$euser." existiert nicht</ br>";
if($epw=="") echo "Epw ist leer";
*/

//if($euser==$iuser && $ipw==$epw){

//Problem mit Umlauten, grossem Ö => Oesterreich anstatt Östereich
$land="Alle";
if (isset($_POST['land']))
   $land=$_POST['land'];
//echo "Wir wählen ".$land;

require "../db.inc";
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
 $sql = "SELECT DISTINCT herkunftsland FROM bier ORDER BY herkunftsland ASC";
 $result = mysql_query($sql, $conn);
  if ($result){
     $landArray = array();
     $i=0;
     while ($row=mysql_fetch_object($result)){
	   $landArray[$i]=$row->herkunftsland;
	   //echo $landArray[$i];
	   $i++;	   
	 }
  }         
?>

<form name="f1" method="post">
 <select name="land">
    <option value="Alle">Alle</option>	
	<?php
     foreach($landArray as $einzel_land)
       echo "<option value=\"".$einzel_land."\">".$einzel_land."</option>";
     ?> 
 </select>
<input type="submit">
<?php
echo "<h1><a href=einfuegen.php>Einfügen</a></h1>\n";
?>
</form>
<br>
<?php
//Sql Statement
if(strcmp($land,"Alle")==0)
   $sql = "SELECT * FROM $table ORDER BY herkunftsland";
else
   $sql = "SELECT * FROM $table WHERE herkunftsland=\"$land\"";
//echo $sql."\n";

$result = mysql_query($sql, $conn);
if ($result)
{
$number = mysql_num_rows($result);
echo "<P>Es ";
/////////////////
if($number == 1){
	echo "ist";
}
if($number > 1){
	echo "sind";
}
/////////////////
echo " $number ";
/////////////////
if($number == 1){
	echo "köstliches ";
}
if($number > 1){
	echo "köstliche ";
}
/////////////////
if($number == 1){
	echo "Bier";
}
if($number > 1){
	echo "Biere";
}
echo " gefunden worden.\n";
//Äussere Tabelle
echo "<table border=\"0\" style=\"border-color:red\"> \n";
// Lösung mit mysql_fetch_object

$hklalt=""; //Herkunftsland
while ($row=mysql_fetch_object($result)){
echo "<tr><td style=\"border-color:blue\">\n";  //erste Zelle äussere Tabelle

//Zwischentitel
$hkl=$row->herkunftsland;
if ($hkl!=$hklalt){
	echo "<table><tr><td width=\"200\">";
	echo "<h1 class=\"rot\">".utf8_encode($row->herkunftsland)."</h1>";
	echo "</td><td>";
	
	//Zwischentitel mit Flaggen ausgeben
	 foreach($landArray as $einzel_land){
	    if (strcmp($hkl,trim($einzel_land))==0){    
		   echo "<img src=\"../flaggen/".$einzel_land.".png\" height=\"80\">";
		   //echo "Bildname: ".$einzel_land.".png";
           }		   
	 }		
	echo "</td></tr></table>";	
	};

//Interne Tabelle
echo "<table  style=\"width:100%\" border=\"0\">\n";
echo "<td rowspan=\"4\" class=\"bild\">\n";
echo "<img src=..\bier_bilder/".$row->bild." height=\"100\"></td><td id=\"titel\">\n";
echo "<h1>".utf8_encode($row->name)."  (".$row->groesse." cl / ".$row->volumen." %)	<a href=\"edit.php?id=$row->id\">Ändern</a>&nbsp;<a href=\"loeschen.php?id=$row->id&name=$row->name\">L&oumlschen</a></h1></td></tr><tr></td><td>\n";
echo "<h2>".utf8_encode($row->herkunftsort).", ".utf8_encode($row->herkunftsland)."</h2></tr><tr></td><td>\n";
echo utf8_encode($row->beschreibung)."\n";
echo "<hr/>\n";
echo "</tr>\n";     
echo "</table>\n";
echo "</td></tr>\n"; //Schliessen td äussere Tabelle
$hklalt=$hkl; //letztes Herkunftsland sichern
}
echo "</table>\n";
//echo "<P>Abfrage: <I>$sql</I>";
}
else
{
echo "<P>".mysql_error($conn);
}
mysql_close($conn);
?>

</body>
</html>