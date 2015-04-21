<!DOCTYPE html>
<html>
<head>
<title>Bier Datenbank</title>
<link rel="stylesheet" type="text/css" href="style/style.css"/> 
</head>
<body>

<?php
//Filename: bier.php

//Problem mit Umlauten, grossem Ö => Oesterreich anstatt Östereich
$land="Alle";
if (isset($_POST['land']))
   $land=$_POST['land'];

require "db.php";
$table = "bier"; //MySQL-Tabelle

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
	   $i++;	   
	 }
  }         
?>

<form name="f1" method="post">
 <select name="land" onchange="document.f1.submit();">
	<option value="Alle">Wählen Sie</option>
    <option value="Alle">Alle</option>	
	<?php
     foreach($landArray as $einzel_land)
       echo "<option value=\"".$einzel_land."\">".$einzel_land."</option>";
     ?> 
 </select>
</form>

<br />
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
//Angabe der selektierten Biere
$number = mysql_num_rows($result);
if ($number>1)
   echo "Es sind $number köstliche Biere gewählt worden";
else
   echo "Es ist $number köstliches Bier gewählt worden";

//Äussere Tabelle
echo "<table border=\"0\" style=\"border-color:red\"> \n";

$hklalt=""; //Herkunftsland alt
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
		   echo "<img src=\"flaggen/".$einzel_land.".png\" height=\"80\">";
           }		   
	 }		
	echo "</td></tr></table>";	
	};

//Interne Tabelle
echo "<table  style=\"width:100%\" border=\"0\">\n";
echo "<tr><td rowspan=\"4\" id=\"bild\">\n";
echo "<img src=bier_bilder/".$row->bild." height=\"100\"></td><td id=\"titel\">\n";
echo "<h1>".utf8_encode($row->name)."  (".$row->groesse." cl / ".$row->volumen." %)</h1></td></tr><tr><td>\n";
echo "<h2>".utf8_encode($row->herkunftsort).", ".utf8_encode($row->herkunftsland)."</h2></td></tr><tr><td>\n";
echo utf8_encode($row->beschreibung)."\n";
echo "<hr/>\n";
echo "</tr>\n";     
echo "</table>\n";

echo "</td></tr>\n"; //Schliessen td äussere Tabelle
$hklalt=$hkl; //letztes Herkunftsland sichern
}
echo "</table>\n";
}
else
{
echo "<P>".mysql_error($conn);
}
mysql_close($conn);
?>
</body>
</html>