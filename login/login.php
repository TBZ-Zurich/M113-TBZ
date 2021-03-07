<?php


// Session starten
// // 08.03.17 Umstellung auf mysqli-connector
session_start ();



// Datenbankverbindung aufbauen
$con  = mysqli_connect ("tawohuna.mysql.db.hostpoint.ch", "tawohuna_m133", "J7Z5XQ4nMieidKcsE54r2JEMgBz8Gn39K8tuDSQwXxd");
if (!mysqli_select_db ($con,"tawohuna_m133"))
{
  die ("Keine Verbindung zur Datenbank" . $con);
}






if (password_verify($_REQUEST["password"], getHashBasedOnName($_REQUEST["name"])))
{

  $sql = "SELECT ".
    "Id, Nickname, Nachname, Vorname ".
  "FROM ".
    "benutzerdaten ".
  "WHERE ".
    "(Nickname like '".$_REQUEST["name"]."') AND ".
    "(Kennwort =  '". password_hash( $_REQUEST["pwd"], PASSWORD_BCRYPT) ."')";


   //"(Kennwort like '" .$_REQUEST["pwd"] . "')";
$result = mysqli_query ($con,$sql);
  // Benutzerdaten in ein Array auslesen.
  $data = mysqli_fetch_array ($result,MYSQLI_ASSOC);

  // Sessionvariablen erstellen und registrieren
  $_SESSION["user_id"] = $data["Id"];
  $_SESSION["user_nickname"] = $data["Nickname"];
  $_SESSION["user_nachname"] = $data["Nachname"];
  $_SESSION["user_vorname"] = $data["Vorname"];

  header ("Location: intern.php");
}
else
{
  header ("Location: formular.php?fehler=1");
}


function getHashBasedOnName ($name) {
    $sql  = "SELECT Passwort FROM benutzerdaten WHERE ( Nickname like '" . $_REQUEST["name"] . "');";


    $result = mysqli_query($con, $sql);

    return $result;
}
?> 