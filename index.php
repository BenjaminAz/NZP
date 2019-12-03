<?php

session_start();
require "templates/conexion.php";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Autos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <!------------------------------------------------------------------------------ HEADER --->
    <header class="fondo">
        <div class="container-fluid fondo3">
            <div class="container">
                <div class="row mb-3">
                    <div class="col text-right">
                        <?php   
                        
                        if( isset($_SESSION['nombre']) ){
                            
                        ?>

                        <div class="text-right text-light pt-3 pb-1 mr-4">
                            <img src="imagenes/user.png" alt="Avatar">
                            <p class="d-inline-block ml-2">Bienvenido
                                <?php echo $_SESSION['nombre']; ?>
                                <?php echo $_SESSION['apellido']; ?> <a href="templates/cerrar.php" class="ml-3 text-info">Cerrar sesión</a></p>
                        </div>


                        <?php
                            
                        }else{
                            
                        ?>

                        <a href="index.php?e=2" class="text-secondary mr-3">Registrarse</a>

                        <form action="templates/login.php" method="post" class="form-inline my-2 mr-3 d-inline-flex justify-content-end">
                            <input class="form-control mr-sm-2" type="text" placeholder="Email" aria-label="Email" name="email">
                            <input class="form-control mr-sm-2" type="password" placeholder="Clave" aria-label="Clave" name="clave">
                            <input type="submit" value="Ingresar" class="btn btn-secondary my-2 my-sm-0">
                        </form>

                        <?php
                            
                        } // cierra el if de sesión de usuario
                        
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="container pb-3">

            <h1 class="text-muted pl-2"><span class="text-danger">SORY GORDO </span>Market</h1>

            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#barra" aria-controls="barra" aria-expanded="false" aria-label="barra de navegación">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="barra">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Autos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>





    <main class="container bg-white">

        <?php 
        
        if( !isset($_GET['p']) ) { // Abre el if del GET de p
            
        ?>

        <!------------------------------------------------------------------ PÁGINA MAESTRO --->
        <section class="row">
            <h2 class="col-12 py-4 text-secondary text-center">Lista de Autos</h2>

            <?php
            $query = "SELECT id_auto, id_marca, nombre, detalles, imagen, precio FROM autos";
            
            $res = mysqli_query($cnx, $query);
            
            while( $column = mysqli_fetch_assoc($res) ){ 
            ?>

            <div class="col-lg-4 text-center">
                <div class="card mb-3">
                    <div class="card-body">
                        <img class="card-img-top mb-3" src="autos/<?php echo $column['imagen']; ?>" alt="<?php echo $column['nombre']; ?>">
                        <h2 class="card-title">
                            <?php echo $column['nombre']; ?>
                        </h2>
                        <p class="card-text">$
                            <?php echo $column['precio']; ?>
                        </p>
                        <a class="btn btn-primary float-right" href="index.php?p=<?php echo $column['id_auto']; ?>" class="btn">más</a>
                    </div>
                </div>
            </div>

            <?php
                
            } // Cierra el while
            
            ?>
        </section>


        <?php
            
        }else{ // else del GET de p
            
        ?>


        <!--------------------------------------------------------------------- DETALLE --->
        <section class="row pb-5 justify-content-md-center">

            <?php
            
            $p = $_GET['p'];
            
            $queryAuto = "SELECT autos.nombre, autos.detalles, autos.precio, autos.imagen, marcas.marca FROM autos INNER JOIN marcas ON autos.id_marca = marcas.id_marca WHERE autos.id_auto = $p";
            
            $res = mysqli_query($cnx, $queryAuto);
            
            $auto = mysqli_fetch_assoc($res);  
            
            if($auto == false){
                header("Location: index.php");
                exit;
            }
            ?>

            <h2 class="col-12 display-4 my-5">
                <?php echo $auto['nombre']; ?>
            </h2>

            <div class="col-md-5 text-center">
                <img src="autos/<?php echo $auto['imagen']; ?>" alt="<?php echo $auto['nombre']; ?>" class="img-fluid">
            </div>

            <div class="col-md-5 py-3 d-flex flex-column justify-content-center align-items-md-start align-items-center">
                <p class="h4">
                    <?php echo $auto['detalles']; ?>
                </p>
                <p>
                    <?php echo $auto['marca']; ?>
                </p>
                <p class="h3 mb-3">$
                    <?php echo $auto['precio']; ?>
                </p>
                <a href="index.php" class="btn btn-primary">Volver</a>
            </div>
            
            
            <div class="col-md-8 mt-5" id="comentarios">
                <?php
                $queryCom = "SELECT * FROM comentarios INNER JOIN autos ON comentarios.id_auto = autos.id_auto INNER JOIN usuarios ON comentarios.id_usuario = usuarios.id_usuario WHERE autos.id_auto = $p ORDER BY comentarios.fecha DESC";
                
                $resCom = mysqli_query($cnx, $queryCom);
            
                while($columnCom = mysqli_fetch_assoc($resCom)){
                    
                    $fecha = explode("-", $columnCom['fecha']);
                    $fecha_nueva = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                ?>
                
                <div class="p-3">
                    <p class="mb-0 h6"><?php echo $columnCom['nombre']. " / " . $fecha_nueva; ?> </p>
                    <p class="mb-0"><?php echo $columnCom["comentario"]; ?></p>
                </div>
                
                <?php
                    
                }
                ?>
                
                
            </div>
            <?php
            if(isset($_SESSION['usuario'])){
            ?>
            <aside class="col-md-8 mt-3">
                <form action="templates/comentar.php" method="post" class="">
                    <div class="form-group">
                        <textarea name="comentario" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                    </div>
                    
                    <input type="hidden" name="id_auto" value="<?php echo $p;?>">
                    
                    <input type="submit" value="Enviar" class="btn btn-success float-right my-sm-0">
                </form>
            </aside>
            
            <?php
                
            }
            
            ?>

        </section>

        <?php
            
        } // Cierra del if del GET de p.
        
        ?>

    </main>


    <!------------------------------------------------------------------------------ FOOTER --->
    <footer class="fondo2">
        <div class="container p-5">
            <p class="text-light text-center m-0">Programación Visual III - Escuela Da Vinci</p>
        </div>
    </footer>


    <!-- MODAL FALLO DE LOGIN -->

    <div class="modal fade" id="errorlogin" tabindex="-1" role="dialog" aria-labelledby="errorlogintitulo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="errorlogintitulo">Ha surgido un inconveniente.</h2>
                </div>
                <div class="modal-body">
                    <p>Email o clave incorrectos.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/bootstrap.bundle.js"></script>


    <?php    
    if( isset($_GET["e"]) && $_GET["e"] == 1 ){
    ?>

    <script>
        $('#errorlogin').modal('toggle');

        $('#errorlogin').on('hidden.bs.modal', function(e) {
            window.location = "index.php";
        });

    </script>

    <?php
    }else if( isset($_GET["e"]) && $_GET["e"] == 2 ){
        
        include "templates/registro.php";
        
    }else if( isset($_GET["e"]) && $_GET["e"] == 3 ){
        
        include "templates/registro.php";
        
    }else if( isset($_GET["e"]) && $_GET["e"] == 4 ){
        
        include "templates/registro.php";
        
    }
    
    mysqli_close($cnx);
    ?>
</body>

</html>
