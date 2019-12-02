<?php
session_start();

require "templates/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sitio ejemplo</title>
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
                            <img src="imagenes/user.png" alt="avatar de usuario">
                            <p class="d-inline-block ml-2">Bienvenido
                                <?php echo $_SESSION['nombre']; ?>
                                <?php echo $_SESSION['apellido']; ?> <a href="templates/cerrar.php" class="ml-3 text-info">cerrar sesión</a></p>
                        </div>


                        <?php
                        }else{
                        ?>

                        <a href="index.php?e=2" class="text-secondary mr-3">registrate</a>

                        <form action="templates/login.php" method="post" enctype="application/x-www-form-urlencoded" class="form-inline my-2 mr-3 d-inline-flex justify-content-end">
                            <input class="form-control mr-sm-2" type="text" placeholder="Usuario" aria-label="Usuario" name="usuario">
                            <input class="form-control mr-sm-2" type="password" placeholder="Clave" aria-label="Clave" name="clave">
                            <input type="submit" value="entrar" class="btn btn-secondary my-2 my-sm-0">
                        </form>

                        <?php
                        } // cierra el if de sesión de usuario
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="container pb-3">

            <h1 class="text-muted pl-2"><span class="text-danger">DV</span>Market</h1>

            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#barra" aria-controls="barra" aria-expanded="false" aria-label="barra de navegación">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="barra">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Productos</a>
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
            <h2 class="col-12 py-4 text-secondary text-center">Lista de Productos</h2>

            <?php
            $consulta = "SELECT id_producto, nombre, precio, foto FROM productos";
            
            $respuesta = mysqli_query($cnx, $consulta);
            
            while( $columnas = mysqli_fetch_assoc($respuesta) ){ 
            ?>

            <div class="col-lg-4 text-center">
                <div class="card mb-3">
                    <div class="card-body">
                        <img class="card-img-top mb-3" src="productos/<?php echo $columnas['foto']; ?>" alt="<?php echo $columnas['nombre']; ?>">
                        <h2 class="card-title">
                            <?php echo $columnas['nombre']; ?>
                        </h2>
                        <p class="card-text">$
                            <?php echo $columnas['precio']; ?>
                        </p>
                        <a class="btn btn-primary float-right" href="index.php?p=<?php echo $columnas['id_producto']; ?>" class="btn">VER +</a>
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
            
            $consulta_un_producto = "SELECT productos.nombre, productos.presentacion, productos.precio, productos.foto, marcas.marca FROM productos INNER JOIN marcas ON productos.id_marca = marcas.id_marca WHERE productos.id_producto = $p";
            
            $resultado = mysqli_query($cnx, $consulta_un_producto);
            
            $producto = mysqli_fetch_assoc($resultado);  
            
            if($producto == false){
                header("Location: index.php");
                exit;
            }
            ?>

            <h2 class="col-12 display-4 my-5">
                <?php echo $producto['nombre']; ?>
            </h2>

            <div class="col-md-5 text-center">
                <img src="productos/<?php echo $producto['foto']; ?>" alt="<?php echo $producto['nombre']; ?>" class="img-fluid">
            </div>

            <div class="col-md-5 py-3 d-flex flex-column justify-content-center align-items-md-start align-items-center">
                <p class="h4">
                    <?php echo $producto['presentacion']; ?>
                </p>
                <p>
                    <?php echo $producto['marca']; ?>
                </p>
                <p class="h3 mb-3">$
                    <?php echo $producto['precio']; ?>
                </p>
                <a href="index.php" class="btn btn-primary">volver</a>
            </div>
            
            
            <div class="col-md-8 mt-5" id="comentarios">
                <?php
                $cons_com = "SELECT * FROM comentarios INNER JOIN productos ON comentarios.id_producto = productos.id_producto INNER JOIN usuarios ON comentarios.id_usuario = usuarios.id_usuario WHERE productos.id_producto = $p ORDER BY comentarios.fecha DESC";
                
                $rta_com = mysqli_query($cnx, $cons_com);
            
                while($col_com = mysqli_fetch_assoc($rta_com) ){
                    
                    $fecha = explode("-", $col_com['fecha']);
                    $fecha_nueva = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                ?>
                
                <div class="p-3">
                    <p class="mb-0 h6"><?php echo $col_com['nombre']. " / " . $fecha_nueva; ?> </p>
                    <p class="mb-0"><?php echo $col_com["comentario"]; ?></p>
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
                    
                    <input type="hidden" name="id_producto" value="<?php echo $p;?>">
                    
                    <input type="submit" value="enviar" class="btn btn-success float-right my-sm-0">
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
                    <h2 class="modal-title" id="errorlogintitulo">OUCHHH!!!</h2>
                </div>
                <div class="modal-body">
                    <p>Usuario o clave inexistente.</p>
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
