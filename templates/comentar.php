<?php

session_start();
require "conexion.php";

$id_auto = $_POST['id_auto'];
$comment = $_POST['comentario'];
$id_usuario = $_SESSION['id_usuario'];
$fecha = date("Y-m-d");

$query = "INSERT INTO comentarios (id_auto, id_usuario, comentario, fecha) VALUES ($id_auto, $id_usuario, '$comment', '$fecha')";

mysqli_query($cnx, $query);
header("Location: ../index.php?p=$id_auto");

?>