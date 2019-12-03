<?php

require "conexion.php";

$id_localidad = mysqli_real_escape_string( $cnx, $_POST['localidad']);
$nombre = mysqli_real_escape_string( $cnx, $_POST['nombre']);
$apellido = mysqli_real_escape_string( $cnx, $_POST['apellido']);
$email = mysqli_real_escape_string( $cnx, $_POST['email']);
$clave = mysqli_real_escape_string( $cnx, $_POST['clave']);
$rol = mysqli_real_escape_string( $cnx, $_POST['rol']);

$query = "SELECT * FROM usuarios WHERE email = '$email'";
$res = mysqli_query($cnx, $consulta);

$column = mysqli_fetch_assoc($respuesta);

if($column != false){
    header("Location: ../index.php?e=3");
    exit;
}else{
    $insertUser = "INSERT INTO usuarios (id_localidad, nombre, apellido, email, clave, rol) VALUES ($id_localidad, '$nombre', '$apellido', '$email', '$clave', 'user')";
    
    mysqli_query($cnx, $insertUser);

    // $_SESSION['id_usuario'] = mysqli_insert_id($cnx);
    
    header("Location: ../index.php?e=4");

}

mysqli_close($cnx);
?>












