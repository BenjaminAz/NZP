<?php
if($_GET['e'] == 4){
?>

<div class="modal fade" id="registroOk" tabindex="-1" role="dialog" aria-labelledby="registroOkTitulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="registroOkTitulo">Felicitaciones!!!</h2>
            </div>
            <div class="modal-body">
                <p>El registro fue realizado con éxito. Utilizá el usuario y la clave registradas para ingresar al sitio</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#registroOk').modal('toggle');
    $('#registroOk').on('hidden.bs.modal', function(e) {
        window.location = "index.php";
    });

</script>
<?php
}else{
?>
   
<div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="registroTitulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="registroTitulo">Registrate!</h2>
            </div>
            
            <?php
            if($_GET['e'] == 3 ){
            ?>
            
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h3 class="alert-heading">Atención!!!</h3>
                <p>El email ingresado ya existe como usuario en el sitio. Por favor, ingrese otra dirección de email.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Botón cerrar"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <?php
            }
            ?>
            
            <div class="modal-body row justify-content-center">
                <form action="templates/registrar.php" method="post" class="col-10">
                    <div class="form-group">
                        <label for="us">Nombre de usuario</label>
                        <input type="email" name="usuario" id="us" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cl">Clave</label>
                        <input type="password" name="clave" id="cl" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nombre</label>
                        <input type="text" name="nombre" id="nom" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ap">Apellido</label>
                        <input type="text" name="apellido" id="ap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="loc">Localidad</label>
                        <select name="localidad" id="loc" class="form-control">

                            <?php
                            $cons_loc = "SELECT * FROM localidades";
                            $rta_loc = mysqli_query($cnx, $cons_loc);
                            
                            while( $col_loc = mysqli_fetch_assoc($rta_loc) ){
                            ?>

                            <option value="<?php echo $col_loc['id_localidad']; ?>">
                                <?php echo $col_loc['localidad']; ?>
                            </option>

                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">cancelar</button>
                        <input type="submit" value="enviar registro" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#registro').modal('toggle');

    $('#registro').on('hidden.bs.modal', function(e) {
        window.location = "index.php";
    });
    
    

</script>
<?php
}
?>