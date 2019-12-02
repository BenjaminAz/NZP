<?php
session_start();
require "conexion.php";

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";

$fila = mysqli_query($cnx, $consulta);

$columnas = mysqli_fetch_assoc( $fila );

if($columnas == false){
    
	header("Location: ../index.php?e=1");
    
}else{

    $_SESSION['id_usuario'] = $columnas['id_usuario'];
    $_SESSION['usuario'] = $columnas['usuario'];
    $_SESSION['nombre'] = $columnas['nombre'];
    $_SESSION['apellido'] = $columnas['apellido'];
    $_SESSION['id_nivel'] = $columnas['id_nivel'];

    header("Location: ../index.php");
}


mysqli_close($cnx);

?>