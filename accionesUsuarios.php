<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php 

//$id_nombre=$_POST["id"];
$accion=$_POST["action"];

//echo "Acción POST: " . $accion; ?> <br><?php
//echo "Id a " . $accion . " " . $id_nombre;



switch ($accion) {

	case 'crear':
		creacionUsuario();
		break;

	case 'editar':
		edicionUsuario();
		break;
	
	case 'eliminar':
		eliminacionUsuario();
		break;

	case 'editarUsuario':
		editarUsuarioBD($_POST["id_usuario"],$_POST["name"],$_POST["surname"],$_POST["email"],$_POST["password"]);
		break;


	case 'eliminarUsuario':
		eliminarUsuarioBD($_POST["id_usuario"]);
		break;


	case 'crearUsuario':
		crearUsuarioBD($_POST["name"],$_POST["surname"],$_POST["email"],$_POST["password"]);
		break;

}

// me permite mostrar los datos a editar
function getUsuario($id){
	
	include("config.php");

	conectarDB();


	$query = "SELECT * FROM users WHERE id=" . $id;

	$result = mysqli_query(conectarDB(), $query);

	if($result){
		$row = $result->fetch_assoc();
	
	}

	else{
		echo "Error en la consulta" . mysqli_error(conectarDB());

		echo $row;
	}

	//Cerramos la conexion
	conectarDB()->close();

	return $row;
}


function eliminacionUsuario(){

	$usuario = getUsuario($_POST["id"]);

	?>
		<h2>¿Desea eliminar el usuario?</h2>
        <form action="accionesUsuarios.php" method="post">

    		<input type="hidden" name="action" value="eliminarUsuario">
    		
    		<input type="hidden" name="id_usuario" value="<?php echo $usuario["id"]?>">
			<h2><?php echo $usuario ["name"]?></h2>
    		<input class="btn btn-success btn-sm" type="submit" value = "Sí">
    	</form> 
    	<form action="listarUsuarios.php" method="post">
    		<input class="btn btn-danger btn-sm" type="submit" value = "No">   		
    	</form>   
        <?php
}


function eliminarUsuarioBD($id_usuario){

	include("config.php");
    

 	$query = "DELETE FROM users ";
    $query .= "WHERE id=" . $id_usuario;

    
    $result = mysqli_query(conectarDB(), $query);
    if ($result) {
        echo "<div class='success-msg'><h5>Usuario Eliminado</h5></div><br>";?>
        <a class="btn btn-dark btn-sm" href="listarUsuarios.php">Volver</a><br>
    <?php 
    }
    else {
        echo "Error query:" . mysqli_error(conectarDB());
    }
        
    conectarDB()->close();

}


function creacionUsuario(){

	?>
<div class="container">
		<h2>Creación usuario</h2>
        <form action="accionesUsuarios.php" method="post">
        <label>Nombre</label><br>
        <input type="text" name="name"><br>
        <label>Apellido</label><br>
        <input type="text" name="surname"><br><br>
        <label>Email</label><br>
        <input type="text" name="email"><br><br>
        <label>Contraseña</label><br>
        <input type="password" name="password"><br><br>
        <input type="hidden" name="action" value="crear">
        <input class="btn btn-success btn-sm" type="submit" value="Crear usuario">
        <input type="hidden" name="action" value="crearUsuario">
    	</form> 
</div>
        <?php
}

function crearUsuarioBD($name,$surname,$email,$password){

    include("config.php");

	$con = conectarDB();

    $sql="INSERT INTO users (name,surname,email,password) VALUES ('$name','$surname','$email','$password')";
	$consulta = mysqli_query($con,$sql);

    if ($consulta) {
        echo "<div class='success-msg'><h5>Usuario Creado</h5></div><br>";?>
        <a class="btn btn-dark btn-sm" href="listarUsuarios.php">Volver</a><br>
    <?php 
    }
    else {
        echo "Error query:" . mysqli_error(conectarDB());
    }

    conectarDB()->close();
}

function edicionUsuario(){

	//por parametro le pasamos el valor del formulario/tabla inicial

	$usuario = getUsuario($_POST["id"]);

?>
	<div class="form-emp">
        <form action="accionesUsuarios.php" method="post">
			<h2>Edita el usuario</h2>
    		<input type="hidden" name="action" value="editarUsuario">
    	
    		<input type="hidden" name="id_usuario" value="<?php echo $usuario["id"]?>">

    		<label for="name">Nombre</label><br>
    		<input type="text" name="name" value="<?php echo $usuario ["name"]?>" >
    		<br>
			<label for="surname">Apellido</label><br>
    		<input type="text" name="surname" value="<?php echo $usuario ["surname"]?>" >
    		<br>
			<label for="email">Email</label><br>
    		<input type="text" name="email" value="<?php echo $usuario ["email"]?>" >
    		<br>
			<label for="password">Contraseña</label><br>
    		<input type="text" name="password" value="<?php echo $usuario ["password"]?>" >
    		<br>

    		<br><br>
			
    		<input class="btn btn-success btn-sm" type="submit" value = "Guardar">
    	</form> 
		<br>
    	<form action="listarUsuarios.php" method="post">
    		<input class="btn btn-danger btn-sm" type="submit" value = "Cancelar">   		
    	</form>   
	</div>
        <?php
    }

    function editarUsuarioBD($id_usuario,$name,$surname,$email,$password){
        include("config.php");
        $con=conectarDB();
        
        $query = "UPDATE users ";
        $query .="SET ";
        $query .=" name ='" . $name . "',";
        $query .=" surname ='" . $surname . "',";
        $query .=" email ='" . $email . "',";
        $query .=" password ='" . $password . "' ";
        $query .="WHERE ID=" . $id_usuario;
     
    
    
        
        $result = mysqli_query($con, $query);
        if ($result==false) {
            $error = mysqli_error($con);
            if(str_contains($error,'email')){
                echo "<div class='btn-dlt'>El email " . $email . " ya está registrado</div><br><br>";
                ?><a class="btn btn-dark btn-sm" href="listarUsuarios.php">Volver</a><br><?php
            }
    
            else{
            echo "Error query:" . mysqli_error(conectarDB());
            echo $query;
            ?><a class="btn btn-dark btn-sm" href="listarUsuarios.php">Volver</a><br><?php
        }
    
        }
        else {
            
            echo "<div class='success-msg'><h5>Usuario modificado</h5></div><br> <br>";?>
            <a class="btn btn-dark btn-sm" href="listarUsuarios.php">Volver</a><br>
        <?php 
        }
            
        conectarDB()->close();
    
    }

?>
	
</body>
</html>