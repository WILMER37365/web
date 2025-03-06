<?php
$id_rol=$_GET['id'];

include('../../app/config.php');

include('../../admin/layout/parte1.php');

//INCLUIMOS CONTROLADOR DE DATOS DE ROL PARA VISUALIZAR
include('../../app/controllers/roles/datos_de_rol.php');




?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>ROL: <?php echo $nombre_rol;?></h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos Registrados</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nombre del Rol</label>
                                            <input type="text" value="<?php echo $nombre_rol;?>" name="nombre_rol" class="form-control" disabled>

                                            <label for="">Estado</label>
                                            <select name="estado" class="form-control" disabled>
                                                <option value="1" <?php if (isset($estado_rol) && $estado_rol == '1') echo 'selected'; ?>>ACTIVO</option>
                                                <option value="0" <?php if (isset($estado_rol) && $estado_rol == '0') echo 'selected'; ?>>INACTIVO</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <a href="<?php echo APP_URL;?>/admin/roles" class="btn btn-secondary">Volver</a>
                                        </div>
                                    </div>
                                </div>


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
