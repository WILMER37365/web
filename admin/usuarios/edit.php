
<?php
//RECIBIMOS POR LE METODO GET EL ID DEL USUARIO
$id_usuario=$_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');


//AGREGAMOS PARA DATO DEL USUARIO
include ('../../app/controllers/usuarios/datos_de_usuario.php');

//AGREGAMOS EL LISTADO DE ROLES
include('../../app/controllers/roles/listado_de_roles.php');

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>MODIFICAR USUARIO: <?php echo $nombres." ".$apellidos;?></h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="<?php echo APP_URL;?>/app/controllers/usuarios/update.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <!-- /.COLUMNA DE 3 PARA LOS DATOS DE USUARIOS -->
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Nombres del Usuario</label>
                                                    <input type="text" name="id_usuario" value="<?php echo $id_usuario;?>" hidden>
                                                    <input type="text" value="<?php echo $nombres;?>" name="nombre_usuario" class="form-control" style="text-transform: uppercase;" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Apellidos del Usuario</label>
                                                    <input type="text" value="<?php echo $apellidos;?>" name="apellido_usuario" class="form-control" style="text-transform: uppercase;" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Rol</label>
                                                    <div class="form-inline ">
                                                        <select name="rol_usuario" id="" class="form-control" required>
                                                            <?php
                                                            foreach ($roles as $role) {
                                                                $nombre_rol_tabla=$role['nombre_rol'];?>

                                                                <option value="<?php echo $role['id_rol'];?>"
                                                                <?php if ($nombre_rol == $nombre_rol_tabla){
                                                                ?>
                                                                    selected="selected"
                                                                    <?php
                                                                }
                                                                ?>
                                                                >
                                                                    <?php echo $role['nombre_rol'];?>
                                                                </option>

                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <a href="<?php echo APP_URL;?>/admin/roles/create.php" style="margin-left: 5px" class="btn btn-success"><i class="bi bi-plus-circle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" value="<?php echo $email;?>" name="email_usuario" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text" value="<?php echo $usuar;?>" name="alias" class="form-control" style="text-transform: uppercase;" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Estado</label>
                                                    <select name="estado" class="form-control">
                                                        <option value="1" <?php if (isset($estado) && $estado == '1') echo 'selected'; ?>>Activo</option>
                                                        <option value="0" <?php if (isset($estado) && $estado == '0') echo 'selected'; ?>>Inactivo</option>
                                                    </select>


                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Contraseña</label>
                                                    <input type="password" name="password" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Repetir Contraseña</label>
                                                    <input type="password" name="repetir_password" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Género</label>

                                                    <select name="genero" class="form-control">
                                                        <option value="masculino" <?php if (isset($genero) && $genero == "masculino") echo 'selected'; ?>>Masculino</option>
                                                        <option value="femenino" <?php if (isset($genero) && $genero == "femenino") echo 'selected'; ?>>Femenino</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- /.COLUMNA DE 1 PARA EL PERFIL DELOS USUARIOS -->
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Perfil de Usuario</label>
                                                    <input type="file" name="perfil" class="form-control" id="file">
                                                    <input type="text" name="perfil_usu" value="<?php echo $perfil;?>" class="form-control" hidden>
                                                    <br>
                                                    <center>
                                                        <output id="list">
                                                            <img src="<?php echo APP_URL."/public/images/usuarios/".$perfil;?>" width="300px" alt="">
                                                        </output>

                                                    </center>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?php echo APP_URL;?>/admin/usuarios" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>



            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');
?>


<script>
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="100%" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('file').addEventListener('change', archivo, false);
</script>
