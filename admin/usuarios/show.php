
<?php
//RECIBIMOS POR LE METODO GET EL ID DEL USUARIO
$id_usuario=$_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');


//AGREGAMOS PARA DATO DEL USUARIO
include ('../../app/controllers/usuarios/datos_de_usuario.php');



?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>USUARIO: <?php echo $nombres." ".$apellidos;?></h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Registrados</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="<?php echo APP_URL;?>/app/controllers/usuarios/create.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <!-- /.COLUMNA DE 3 PARA LOS DATOS DE USUARIOS -->
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Nombres del Usuario</label>
                                                    <input type="text" value="<?php echo $nombres;?>" name="nombre_usuario" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Apellidos del Usuario</label>
                                                    <input type="text" value="<?php echo $apellidos;?>" name="apellido_usuario" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Rol</label>

                                                        <select name="rol_usuario" id="" class="form-control" disabled>
                                                            <option value="<?php echo $nombre_rol; ?>">
                                                                <?php echo $nombre_rol; ?>
                                                            </option>
                                                        </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" value="<?php echo $email;?>" name="email_usuario" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text" value="<?php echo $usuar;?>" name="usuario" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Estado</label>
                                                    <select name="estado" id="estado" class="form-control" disabled>

                                                        <option value="1" <?php if ( $estado == '1') echo 'selected'; ?>>ACTIVO</option>
                                                        <option value="0" <?php if ( $estado == '0') echo 'selected'; ?>>INACTIVO</option>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Fecha y Hora de Creación</label>
                                                    <input type="date-time" value="<?php echo $fyh_creacion;?>" name="fyh_creacion" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Género</label>
                                                    <input type="text" value="<?php echo $genero;?>" name="genero" class="form-control" disabled>
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
                                                    <input type="file" name="image" class="form-control" id="file" hidden>
                                                    <br>
                                                    <center>
                                                        <img src="<?php echo APP_URL."/public/images/usuarios/".$perfil;?>" width="300px" alt="">
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
                                            <a href="<?php echo APP_URL;?>/admin/usuarios" class="btn btn-secondary">Volver</a>
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
