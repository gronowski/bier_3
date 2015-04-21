<?php
// Mit den folgenden Zeilen lassen sich
// alle Dateien in einem Verzeichnis auslesen
$handle=opendir ("..\bier_bilder");
echo "Verzeichnisinhalt:<br>";
echo "<select name=\"bierbild\">";
while ($datei = readdir ($handle)) {
 if(!is_dir($datei)){
   echo "<option name=\"$datei\">$datei</option>"; 
   }
}
echo "</select>";
closedir($handle);
?>