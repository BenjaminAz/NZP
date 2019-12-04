<?php
if($_GET['e'] == 4){
?>

<div class="modal fade" id="registerSuccess" tabindex="-1" role="dialog" aria-labelledby="registroOkTitulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="registroOkTitulo">Bienvenido</h2>
            </div>
            <div class="modal-body">
                <p>Registro exitoso.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#registerSuccess').modal('toggle');
    $('#registerSuccess').on('hidden.bs.modal', function(e) {
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
                <h3 class="modal-title" id="registroTitulo">Registrarse</h2>
            </div>
            
            <?php
            if($_GET['e'] == 3 ){
            ?>
            
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h3 class="alert-heading">Aviso:</h3>
                <p>Email en uso.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Botón cerrar"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <?php
            }
            ?>
            
            <div class="modal-body row justify-content-center">
                <form action="templates/registrar.php" method="post" class="col-10">
                    <div class="form-group">
                        <label for="em">E-mail</label>
                        <input type="email" name="email" id="us" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="loc">Localidad</label>
                        
                        <select name="localidad" id="loc" class="form-control">

                            <?php
                            $queryLoc = "SELECT * FROM localidades";
                            $resLoc = mysqli_query($cnx, $queryLoc);
                            
                            while( $columnLoc = mysqli_fetch_assoc($resLoc) ){
                            ?>

                            <option value="<?php echo $columnLoc['id_localidad']; ?>">
                                <?php echo $columnLoc['localidad']; ?>
                            </option>

                            <?php
                            }
                            ?>

                        </select>
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
                        <label for="cl">Clave</label>
                        <input type="password" name="clave" id="cl" class="form-control" required>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">Cancelar</button>
                        <input type="submit" value="Registrarse" class="btn btn-success">
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