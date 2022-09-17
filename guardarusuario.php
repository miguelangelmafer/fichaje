<?php

$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$password = $_POST["password"];

include("config.php");

	$con = conectarDB();

    $sql="INSERT INTO users (name,surname,email,password) VALUES ('$name','$surname','$email','$password')";
	$consulta = mysqli_query($con,$sql);

    if($consulta){
        header("Location: index.html");
    }

?>
