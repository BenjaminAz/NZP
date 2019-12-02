<?php
require "conexion.php";

$usuario = mysqli_real_escape_string( $cnx, $_POST['usuario']);
$clave = mysqli_real_escape_string( $cnx, $_POST['clave']);
$nombre = mysqli_real_escape_string( $cnx, $_POST['nombre']);
$apellido = mysqli_real_escape_string( $cnx, $_POST['apellido']);
$id_localidad = mysqli_real_escape_string( $cnx, $_POST['localidad']);

$consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$respuesta = mysqli_query($cnx, $consulta);

$columnas = mysqli_fetch_assoc($respuesta);

if($columnas != false){
    header("Location: ../index.php?e=3");
    exit;
}else{
    $cons_alta = "INSERT INTO usuarios (usuario, clave, nombre, apellido, id_localidad, id_nivel) VALUES ('$usuario', '$clave', '$nombre', '$apellido', $id_localidad, 2)";
    
    mysqli_query($cnx, $cons_alta);
    // creamos las variables de sesión...
    
    // $_SESSION['id_usuario'] = mysqli_insert_id($cnx);
    
    header("Location: ../index.php?e=4");

}

mysqli_close($cnx);
?>












