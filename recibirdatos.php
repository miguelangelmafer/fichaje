<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php  


$email = $_POST["user"];
$password = $_POST["pass"];
$hour = $_POST["hour"];
$date = $_POST["date"];

echo "El correo es:  $email";
?> <br><?php

echo "La contraseña es:   $password";
?> <br><?php
echo "Hora de entrada: $hour";
?> <br><?php
echo "Día: $date";

?>
    
</body>
</html>