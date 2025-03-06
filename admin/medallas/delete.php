<?php
$id_medalla = $_GET['id'];

include('../../app/config.php');

include('../../admin/layout/parte1.php');

//INCLUIMOS CONTROLADOR DE DATOS DE MEDALLA PARA VISUALIZAR
include('../../app/controllers/medallas/datos_de_medalla.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>ELIMINAR MEDALLA: <?php echo $nombre_medalla; ?></h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Datos Registrados</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?php echo APP_URL; ?>/app/controllers/medallas/delete.php" method="post" id="miFormulario91<?php echo $id_medalla; ?>">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nombre Forma Farmacéutica</label>
                                            <input type="text" value="<?php echo $nombre_medalla; ?>"
                                                   name="nombre_medalla" class="form-control" disabled>

                                            <label for="">Estado</label>
                                            <select name="estado_medalla" class="form-control" disabled>
                                                <option value="1" <?php if (isset($estado_medalla) && $estado_medalla == '1') echo 'selected'; ?>>
                                                    Activo
                                                </option>
                                                <option value="0" <?php if (isset($estado_medalla) && $estado_medalla == '0') echo 'selected'; ?>>
                                                    Inactivo
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="id_medalla" value="<?php echo $id_medalla; ?>"
                                                   hidden>
                                            <button type="submit" class="btn btn-danger" onclick="preguntar(<?php echo $id_medalla; ?>)">Eliminar</button>
                                            <a href="<?php echo APP_URL; ?>/admin/medallas" class="btn btn-secondary">Volver</a>
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
<!-- /.SCRIPT PARA PREGUNTAR SI SE DESEA ELIMINAR EL REGISTRO DE ROL -->
<script>
    function preguntar(id_medalla) {
        event.preventDefault(); // Prevenir el envío automático del formulario
        Swal.fire({
            title: 'Eliminar Certificado',
            text: '¿Desea eliminar este certificado?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#a5161d',
            denyButtonColor: '#270a0a',
            denyButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, entonces se envía el formulario
                var form = $('#miFormulario91' + id_medalla);
                form.submit();
            }
        });
    }
</script>