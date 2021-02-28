<?php
// Systemeinstellungen
// 06.06.2013 some changes we should not use register globals on
// 11.09.2013 error_reporting = E_ALL, show all errors,warnings and notices including coding standards
// 22.02.2017 mysql durch mysqli ersetzt
// 17.02.2018 HTML mit echo an Präsentation Layer schicken 
// 17.02.2018 SQL -Statement anpassen  
// 17.02.2018 Variable $script eingeführt  
// 07.05.2020 HTML-Grundgerüst ergänzt, HTML-Struktur überarbeitet, einige Logik-Fehler korrigiert, SQL-Injection verhindert, Formularwerte escaped
?>
<!doctype html>
<html>
<head>
	<title>Artikelliste</title>
	<style>
		body {
			padding-left: 40px;
		}
		.margin-bottom {
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
<?php
$id = "tawohuna_m133";
$pw = "J7Z5XQ4nMieidKcsE54r2JEMgBz8Gn39K8tuDSQwXxd";
$host = "tawohuna.mysql.db.hostpoint.ch";
$database = "tawohuna_m133";
$table = "artikel1";
$meldung = "";

//$_SERVER['alter_test_3-Eidf.php']='alter_test.php';
//$script=$_SERVER['alter_test_3-Eidf.php'];
$script = $_SERVER['PHP_SELF'];

//print_r($script);


//print_r($_REQUEST);
//var_dump($action);

$link = mysqli_connect ($host, $id, $pw) or die ("cannot connect");
mysqli_select_db($link, $database) or die ("cannot select DB");

// check variables from the form
// use mysqli_real_escape_string to prevent SQL injection
if (isset ($_REQUEST["nr"]))
    $nr = mysqli_real_escape_string($link, $_REQUEST["nr"]);

if (isset ($_REQUEST["action"]))
    $action = $_REQUEST["action"];
else
    $action ="";

if (isset ($_REQUEST["artnr"]))
    $artnr = mysqli_real_escape_string($link, $_REQUEST["artnr"]);

if (isset ($_REQUEST["titel"]))
    $titel = mysqli_real_escape_string($link, $_REQUEST["titel"]);

if (isset ($_REQUEST["preis"]))
    $preis = mysqli_real_escape_string($link, $_REQUEST["preis"]);

if (isset ($_REQUEST["inhalt"]))
    $inhalt = mysqli_real_escape_string($link, $_REQUEST["inhalt"]);

    if (isset ($_REQUEST["kat"]) && is_numeric($_REQUEST["kat"]) && ($_REQUEST["kat"] > 1) && ($_REQUEST["kat"] < 11)) {
        $kat = mysqli_real_escape_string($link, $_REQUEST["kat"]);  
    } else {
        $meldung = "Kat darf nur zwischen 1 und 10 sein!";
    }


        
      



//  overwrite mysql_result because deprecated

if (!function_exists('mysql_result')) {
    function mysql_result($result, $number, $field=0) {
        mysqli_data_seek($result, $number);
        $row = mysqli_fetch_array($result);
        return $row[$field];
    }
}




if ($action == "loeschen") {
    $sql =  "delete from $table where nr = '$nr'" ;
//print_r($sql);
    mysqli_query ($link, $sql);
    $meldung = "Der Artikel wurde geloescht.";

// Aktualisiert einen Datensatz
} elseif($action == "save") {
    $sql = "update $table set titel = '$titel', artnr = $artnr, preis = '$preis', inhalt = '$inhalt', kat = '$kat' where nr = '$nr'" ;
    print_r($sql);
    mysqli_query($link, $sql);
    $meldung = "Der Artikel wurde upgedated.";

//  einen neuen Artikel hinzu
} elseif ($action == "neu") {
    $sql = "insert into $table (titel, artnr, preis, inhalt, kat) VALUES('$titel', '$artnr', '$preis', '$inhalt', '$kat')" ;
    print_r($sql);
    mysqli_query ($link, $sql);
    $meldung = "Der Artikel wurde hinzugefuegt.";


// Selektiert den  Artikel zum Updaten
} elseif ($action == "update") {
    $sql = 	"select * from $table where nr =  '".$nr. "'" ;
    $result = mysqli_query($link, $sql);
    $titel = mysql_result($result,0, "titel");
    $artnr = mysql_result($result,0, "artnr");
    $preis = mysql_result ($result,0, "preis");
    $inhalt = mysql_result ($result,0, "inhalt");
    $kat = mysql_result($result, 0, "kat");

    echo '<div class="margin-bottom">';

    if($titel !== '') {
        echo "<h3>'$titel' bearbeiten</h3>";
    }

    // use htmlspecialchars() to escape values in tag attributes
    echo '<form action="'.$script.'" method="post">


    <input type="hidden" name="action" value="save">
    <input type="hidden" name="nr" value=' . $nr . '>
  <table>
  <tr>
  <td>Art.-Nr.</td>
    <td><input type=text name="titel" value="' . htmlspecialchars($titel) .'"></td>
  </tr><tr>
  <td>Titel</td>
  <td><input type="text" name="artnr" value="' . htmlspecialchars($artnr).'"></td>
  </tr>
  <tr>
    <td>Preis</td>
    <td><input type=text name="preis" value="' . htmlspecialchars($preis) .'"></td>
  </tr>

  <tr>
        <td>Kat</td>
        <td><input type=text name="kat" value="' . htmlspecialchars($kat) .'"></td>
    </tr>

  <tr>
  <td>Text</td>
  <td><textarea name="inhalt">' .  $inhalt . '</textarea><td>
  </tr><tr>
  </tr> </td>
  <td><input type=submit value="Artikel Updaten"></td>
  </tr>
  </table></form></div>';



// Formular  ein neues Produkt
} elseif($action == "formneu" ) {

    echo '<div class="margin-bottom"><form action="'.$script.'" method="post">
 <input type="hidden" name="action" value="neu">
 <table>
	 <tr>
		<td>Titel</td>
		<td><input type=text name="titel"></td>
	 </tr>
	 <tr>
		<td>Artikelnummer</td>
		<td><input type=text name="artnr"></td>
	 </tr>
	 <tr>
		<td>Preis</td>
		<td><input type=text name="preis"></td>
	 </tr>
     <tr>
        <td>kat</td>
        <td><input type=number name="kat"></td>
    </tr>
	 <tr>
		<td>Text</td>
		<td><textarea name="inhalt"></textarea></td>
	 </tr>
	 <tr>
		<td> </td>
		<td><input type=submit value="Neuen Artikel hinzufuegen"></td>
	 </tr>

 </table>
 </form></div>';


// Gibt alle Datensaetz aus der Datenbank aus.
} else {

    echo "<div class='margin-bottom'><b>Alle Artikel in der Übersicht:</b>";
    echo "<br>";
    echo "<table border= 'l' width='700'>";
    echo "<tr bgcolor='#00cc00'><td width='100'><b>Titel.<b></td>
	<td width='100'><b>Artikelnummer</b></td>
	<td width='300'><b>Preis</b></td>
	<td width='100'><b>Inhalt</b></td>
    <td width='100'><b>Kat</b></td>
	<td width='50'><b>Update</b></td>
	<td width='50'><b>Loeschen</b></td></tr>";

    $sql = "select * from $table" ;
    $result = mysqli_query($link, $sql);
    if ($num = mysqli_num_rows($result)) {

        $bgColor = "#ffffff";
        for ($i=0;$i < $num; $i++) {

            $bgColor = $bgColor=="#ffffff" ?  "#888888" : "#ffffff";
            $nr = mysql_result($result,$i,"nr");
            $titel = mysql_result($result,$i,"titel");
            $artnr = mysql_result($result,$i,"artnr");
            $preis = mysql_result($result,$i,"preis");
            $inhalt = mysql_result($result,$i,"inhalt");
            $kat = mysql_result($result, $i, "kat");

            echo "<tr style=\"background-color: $bgColor;\">";
            echo "<td>$titel</td>";
            echo "<td>$artnr</td>";
            echo "<td>$preis Fr. -</td>";
            echo "<td>$inhalt</td>";
            echo "<td>$kat</td>";
            echo "<td><a href=\"$script?nr=$nr&action=update\">Update</a></td>";
            echo "<td><a href=\"$script?nr=$nr&action=loeschen\">Loeschen</a></td>";
            echo "</tr>";
        } // end for

    } else echo "<tr><td colspan='6' width='100%'>kein Artikel vorhanden!</td></tr>";
    echo "</table></div>";
}

if (!$meldung) $meldung = "Optionen";
echo "<p>$meldung</p>";

echo "<nav><a href=\"$script?action=start\">Zur Startseite</a>";
echo " - <a href=\"$script?action=formneu\">Neuen Artikel einfuegen?</a>";
echo "</nav>";
?>
</body>
</html>