
<?php

session_start();
require "conexion.php";

$email = $_POST['email'];
$clave = $_POST['clave'];

$query = "SELECT * FROM usuarios WHERE email = '$email' AND clave = '$clave'";

$field = mysqli_query($cnx, $query);

$column = mysqli_fetch_assoc($field);

if($column == false){   
	header("Location: ../index.php?e=1");  
}else{
    $_SESSION['id_usuario'] = $column['id_usuario'];
    $_SESSION['nombre'] = $column['nombre'];
    $_SESSION['apellido'] = $column['apellido'];
    $_SESSION['email'] = $column['email'];
    $_SESSION['rol'] = $column['rol'];

    header("Location: ../index.php");
    
}



mysqli_close($cnx);

?>

