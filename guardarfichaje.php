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

$hour = $_POST["hour"];
$date = $_POST["date"];

include("config.php");

	$con = conectarDB();

	$sql="INSERT INTO registration (date,hour) VALUES ('$date','$hour')";
	$consulta = mysqli_query($con,$sql);

?>
    
</body>
</html>