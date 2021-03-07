<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post">
        <input type="text" name="name" id="name">
        <input type="password" name="password" id="password">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php

if (!empty($_POST)){



    $name = $_REQUEST["name"];
    $password = password_hash( $_REQUEST["password"], PASSWORD_BCRYPT);

   
    // Datenbankverbindung aufbauen
    $con  = mysqli_connect ("tawohuna.mysql.db.hostpoint.ch", "tawohuna_m133", "J7Z5XQ4nMieidKcsE54r2JEMgBz8Gn39K8tuDSQwXxd");
    if (!mysqli_select_db ($con,"tawohuna_m133"))
    {
    die ("Keine Verbindung zur Datenbank" . $con);
    }

    $sql = "INSERT INTO benutzerdaten (Nickname, Kennwort) VALUES ( '". $name . "','" . $password . "');";
    $result = mysqli_query ($con,$sql);
        

    echo  "res is: " . $result;



}


        
?>

