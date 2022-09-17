<?php

$hour = $_POST["hour"];
$date = $_POST["date"];
$email = $_POST["user"];
$password = $_POST["pass"];

include("config.php");

	$con = conectarDB();

	$sql="INSERT INTO registration (date,hour) VALUES ('$date','$hour')";
	$consulta = mysqli_query($con,$sql);

?>

