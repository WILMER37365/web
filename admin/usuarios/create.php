
<?php

include('../../app/config.php');

include('../../admin/layout/parte1.php');


//AGREGAMOS PARA ENLISTAR LOS ROLES
include ('../../app/controllers/roles/listado_de_roles.php');



?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>CREACIÓN DE UN NUEVO USUARIO</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>


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
                                                    <input type="text" name="nombre_usuario" class="form-control" style="text-transform: uppercase;" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Apellidos del Usuario</label>
                                                    <input type="text" name="apellido_usuario" class="form-control" style="text-transform: uppercase;" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Rol</label>
                                                    <div class="form-inline ">
                                                        <select name="rol_usuario" id="" class="form-control">
                                                            <?php
                                                            foreach ($roles as $role) {?>

                                                                <option value="<?php echo $role['id_rol'];?>">
                                                                    <?php echo $role['nombre_rol'];?>
                                                                </option>

                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <a href="<?php echo APP_URL;?>/admin/roles/create.php" style="margin-left: 5px" class="btn btn-info"><i class="bi bi-plus-circle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email_usuario" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text" name="alias" class="form-control" style="text-transform: uppercase;" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Estado</label>
                                                    <select name="estado" class="form-control" required>
                                                        <option value="1">ACTIVO</option>
                                                        <option value="0">INACTIVO</option>
                                                    </select>


                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Contraseña</label>
                                                    <input type="password" name="password" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Repetir Contraseña</label>
                                                    <input type="password" name="repetir_password" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Género</label>
                                                    <select name="genero" class="form-control" required>
                                                        <option value="masculino">MASCULINO</option>
                                                        <option value="femenino">FEMENINO</option>
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
                                                    <input type="file" name="image" class="form-control" id="file">
                                                    <br>
                                                    <output id="list"></output>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <!-- Agregamos los inputs para la ubicación -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="latitud">Latitud</label>
                                                <input type="text" id="latitud" name="latitud" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="longitud">Longitud</label>
                                                <input type="text" id="longitud" name="longitud" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="ubicacion"></label>
                                                <button type="button" class="btn btn-primary mt-4" onclick="obtenerUbicacion()">Obtener Ubicación</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Registrar</button>
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


<script>
    function obtenerUbicacion() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById("latitud").value = position.coords.latitude;
                document.getElementById("longitud").value = position.coords.longitude;
            }, function(error) {
                alert("Error al obtener la ubicación: " + error.message);
            });
        } else {
            alert("Geolocalización no soportada en este navegador.");
        }
    }
</script>