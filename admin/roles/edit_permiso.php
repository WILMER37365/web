<?php
$id_permiso=$_GET["id"];
include('../../app/config.php');

include('../../admin/layout/parte1.php');


include('../../app/controllers/roles/datos_permiso.php');

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>MODIFICACIÓ DE UN NUEVO PERMISO</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="<?php echo APP_URL;?>/app/controllers/roles/update_permisos.php" method="post">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nombre de la URL</label>
                                            <input type="text" value="<?= $id_permiso;?>" name="id_permiso" hidden="">
                                            <input type="text" value="<?= $nombre_url;?>" name="nombre_url" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">URL</label>
                                            <input type="text" value="<?= $url;?>" name="url" class="form-control">
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Estado Permiso</label>
                                            <select name="estado_permiso" class="form-control">
                                                <option value="1" <?php if (isset($estado_permiso) && $estado_permiso == '1') echo 'selected'; ?>>Activo</option>
                                                <option value="0" <?php if (isset($estado_permiso) && $estado_permiso == '0') echo 'selected'; ?>>Inactivo</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?php echo APP_URL;?>/admin/roles/permisos.php" class="btn btn-secondary">Cancelar</a>
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
