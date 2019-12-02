<?php
session_start();

require "conexion.php";

$id_producto = $_POST['id_producto'];
$comentario = $_POST['comentario'];
$id_usuario = $_SESSION['id_usuario'];
$fecha = date("Y-m-d");

$consulta = "INSERT INTO comentarios (id_producto, id_usuario, comentario, fecha) VALUES ($id_producto, $id_usuario, '$comentario', '$fecha')";

mysqli_query($cnx, $consulta);

header("Location: ../index.php?p=$id_producto");

?>