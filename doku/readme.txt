Readme

Darstellung:
bier.php 
Optionen auf Wunsch:
Dropdown ohne Versenden-Button

Dropdown wird per DISTINCT Befehl aus Tabelle Bier gefiltert. Ein inkonsistenter Ländername wird als eigenes Land dargestellt. 

Bei der Einrichtung eines neuen Landes muss die Flagge mit dem entsprechenden Dateinamen im Ordner flagge gespeichert werden.

Pflege:
login.php: Zuerst muss man sich mit pflege/login.php authentisieren. Kann auf index.php umbenannt werden.

login.php speichert den externen Username/Passwort in einer Session und vergleicht jeweils mit dem Credentials aus der Datenbank (Tabelle: login)

Die Flaggen-Bildnamen werden aus dem Feld "herkunftsland" ergänzt. Die Flaggen-Namen müssen ensprechend gleich lauten.



 