<?php

include('../app/config.php');

include('../admin/layout/parte1.php');

//INCLUIMOS EL CONTROLADOR PARA E LCONTADO DE ROLES
include('../app/controllers/roles/listado_de_roles.php');
//INCLUIMOS EL CONTROLADOR PARA E LCONTADO DE USUARIOS
include('../app/controllers/usuarios/listado_de_usuarios.php');
//INCLUIMOS EL CONTROLADOR PARA E LCONTADO DE FORMAS FARAMCEUTICAS
include('../app/controllers/formasfarmaceuticas/listado_de_formas.php');

//INCLUIMOS EL CONTROLADOR PARA E LCONTADO DE MEDALLAS
include('../app/controllers/medallas/listado_de_medallas.php');

//INCLUIMOS EL CONTROLADOR PARA E LCONTADO DE MEDALLAS
include('../app/controllers/certificados/listado_de_cert.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h1><?php echo APP_NAME; ?></h1>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-lg-4 col-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">BIENVENIDO USUARIO: <b><?= $alias ?></b></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-borderless table-sm w-auto">
                                <tr>
                                    <th class="text-left">Nombres:</th>
                                    <td><?= $nombre_sesion_usuario ?></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Apellidos:</th>
                                    <td><?= $apellido_sesion_usuario ?></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Correo:</th>
                                    <td><?= $email_sesion_usuario ?></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Rol:</th>
                                    <td><?= $rol_sesion_usuario ?></td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

            <br>
            <!-- /.COLOCAMOS EL WIDGETS DEL SIDEBAR -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <!-- /.COLOCAMOS EL WIDGET PARA LOS ROLES -->

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            $contador_roles = 0;
                            foreach ($roles as $rol) {
                                $contador_roles = $contador_roles + 1;
                            }

                            ?>
                            <h3><?php echo $contador_roles; ?></h3>

                            <p><br>ROLES REGISTRADOS</p>
                        </div>


                        <a href="<?php echo APP_URL; ?>/admin/roles/create.php">
                            <div class="icon">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                        </a>
                        <a href="<?php echo APP_URL; ?>/admin/roles" class="small-box-footer">
                            MAS DETALLES <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </div>

                </div>

                <!-- /.COLOCAMOS EL WIDGET PARA LOS USUARIOS -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <!-- /.COLOCAMOS EL WIDGET PARA LOS ROLES -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $contador_usuarios = 0;
                            foreach ($usuarios as $usuario) {
                                $contador_usuarios = $contador_usuarios + 1;
                            }

                            ?>
                            <h3><?php echo $contador_usuarios; ?></h3>

                            <p><br>USUARIOS REGISTRADOS </p>
                        </div>


                        <a href="<?php echo APP_URL; ?>/admin/usuarios/create.php">
                            <div class="icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </a>
                        <a href="<?php echo APP_URL; ?>/admin/usuarios" class="small-box-footer">
                            MAS DETALLES <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </div>
                </div>


                <!-- /.COLOCAMOS EL WIDGET PARA LAS FORMAS FARMACEUTICAS -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <!-- /.COLOCAMOS EL WIDGET PARA LOS ROLES -->
                    <div class="small-box" style=" background-color:rgb(53,48,159);">
                        <div class="inner" style="color: #ffffff;">
                            <?php
                            $contador_formas = 0;
                            foreach ($formas as $forma) {
                                $contador_formas = $contador_formas + 1;
                            }

                            ?>
                            <h3><?php echo $contador_formas; ?></h3>

                            <p>FORMAS FARMACÉUTICAS<br> REGISTRADOS</p>
                        </div>


                        <a href="<?php echo APP_URL; ?>/admin/formasfarmaceuticas/create.php">
                            <div class="icon">

                                <i class="fa-solid fa-flask-vial"></i>
                            </div>
                        </a>
                        <a href="<?php echo APP_URL; ?>/admin/formasfarmaceuticas" class="small-box-footer">
                            MAS DETALLES <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </div>
                </div>


                <!-- /.COLOCAMOS EL WIDGET PARA LAS MEDALLAS -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <!-- /.COLOCAMOS EL WIDGET PARA LOS ROLES -->
                    <div class="small-box" style=" background-color:rgb(175,96,6);">
                        <div class="inner" style="color: #ffffff;">
                            <?php
                            $contador_medallas = 0;
                            foreach ($medallas as $medalla) {
                                $contador_medallas = $contador_medallas + 1;
                            }

                            ?>
                            <h3><?php echo $contador_medallas; ?></h3>

                            <p><br> MEDALLAS REGISTRADOS</p>
                        </div>


                        <a href="<?php echo APP_URL; ?>/admin/medallas/create.php">
                            <div class="icon">

                                <i class="fa-solid fa-medal"></i>
                            </div>
                        </a>
                        <a href="<?php echo APP_URL; ?>/admin/medallas" class="small-box-footer">
                            MAS DETALLES <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </div>
                </div>


                <!-- /.COLOCAMOS EL WIDGET PARA LOS CERTIFICADOS -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <!-- /.COLOCAMOS EL WIDGET PARA LOS ROLES -->
                    <div class="small-box" style=" background-color:rgb(5,95,182);">
                        <div class="inner" style="color: #ffffff;">
                            <?php
                            $contador_certificados = 0;
                            foreach ($certificados as $certificado) {
                                $contador_certificados = $contador_certificados + 1;
                            }

                            ?>
                            <h3><?php echo $contador_certificados; ?></h3>

                            <p>CERTIFICADOS HECHO EN BOLIVIA<br>REGISTRADOS</p>
                        </div>


                        <a href="<?php echo APP_URL; ?>/admin/certificados/create.php">
                            <div class="icon">

                                <i class="fa-regular fa-file-pdf"></i>
                            </div>
                        </a>
                        <a href="<?php echo APP_URL; ?>/admin/certificados" class="small-box-footer">
                            MAS DETALLES <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </div>
                </div>


            </div>


            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('../admin/layout/parte2.php');
include('../layout/mensajes.php');
?>
