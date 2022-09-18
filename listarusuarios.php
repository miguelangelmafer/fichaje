<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>

<br>
<div class="container">
	
<h2>Listado de usuarios</h2>

<form action="accionesUsuarios.php" method="post">
		<input type="hidden" name="action" value="crear">
		<input class="btn btn-success btn-sm" type="submit" value="Crear Usuario">
</form>
<br>

	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Email</th>
			<th></th>
			<th></th>
		</tr>

<?php

require("config.php");

$sql="SELECT * FROM users";

//result set , record set

$consulta = mysqli_query(conectarDB(),$sql);
//fetch accede a la primera linea del result set con el while accedemos a todos
//while($mostrar = mysqli_fetch_row($consulta)) con valores [0] o [1]
while($mostrar = $consulta->fetch_assoc()){
	?>
<tr>
	<td><?php echo $mostrar["id"]?></td>
	<td><?php echo $mostrar["name"]?></td>
	<td><?php echo $mostrar["surname"]?></td>
	<td><?php echo $mostrar["email"]?></td>
	<td>
		<!--En la primera linea obtenemos el id que queremos editar, en la segunda definimos la accion del boton para el switch-->
		<form action="accionesUsuarios.php" method="post">
			<input type="hidden" name="id" value="<?php echo $mostrar ["id"]?>">
			<input type="hidden" name="action" value="editar">
			<input class="btn btn-warning btn-sm" type="submit" value="Editar">
		</form>
	
	</td>

	<td>
		<form action="accionesUsuarios.php" method="post">
			<input type="hidden" name="id" value="<?php echo $mostrar ["id"]?>">
			<input type="hidden" name="action" value="eliminar">
			<input class="btn btn-danger btn-sm" type="submit" value="Eliminar">
		</form>
	
	</td>
</tr>
<?php
}

mysqli_close(conectarDB());

?>

</table>
</div>
    
</body>
</html>