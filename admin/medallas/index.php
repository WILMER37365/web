<?php

include('../../app/config.php');

include('../../admin/layout/parte1.php');

//INCLUIMOS PARA OBTENER LOS DATOS DE LA TABLA ROLES EL SIGUIENTE CONTROLADOR
include('../../app/controllers/medallas/listado_de_medallas.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>LISTA DE MEDALLAS</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Medallas Registrados</h3>

                            <div class="card-tools d-flex">
                                <a href="create.php" class="btn btn-info me-3"><i class="fa-solid fa-medal"></i> Crear Nueva Medalla</a>
                                <form action="reporte_medallas.php" method="POST" class="d-inline"  target="_blank">
                                    <input type="hidden" name="nombre_usuario" value="<?php echo $email_sesion_usuario;?>" >
                                    <input type="hidden" name="fecha_hora" value="<?php echo $fechaHora;?>" >
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fa-regular fa-clipboard"></i> Exportar Reporte
                                    </button>
                                </form>
                            </div>


                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead style="background-color: rgba(17,158,172,0.8); color: #040404;">
                                <tr>
                                    <th>
                                        <center>Nro</center>
                                    </th>
                                    <th>
                                        <center>Nombre de Medalla</center>
                                    </th>
                                    <th>
                                        <center>Estado</center>
                                    </th>
                                    <th>
                                        <center>Acciones</center>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_medalla = 0;
                                foreach ($medallas as $medalla) {
                                    $id_medalla = $medalla['id_medalla'];
                                    $contador_medalla = $contador_medalla + 1; ?>
                                    <tr>
                                        <td>
                                            <center><?php echo $contador_medalla; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $medalla['nombre_medalla']; ?></center>
                                        </td>
                                        <td>

                                            <center>
                                                <?php
                                                if ($medalla['estado_medalla'] == '1') {
                                                    echo "<span class='text-success'><i class='bi bi-check-circle-fill'></i> Activo</span>";
                                                } else {
                                                    echo "<span class='text-danger'><i class='bi bi-x-circle-fill'></i> Inactivo</span>";
                                                }
                                                ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="show.php?id=<?php echo $id_medalla; ?>" type="button"
                                                       class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a href="edit.php?id=<?php echo $id_medalla; ?>" type="button"
                                                       class="btn btn-success btn-sm"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <a href="delete.php?id=<?php echo $id_medalla; ?>" type="button"
                                                       class="btn btn-danger btn-sm"><i
                                                                class="bi bi-trash3"></i></a>
                                                    <!-- /.card-body
                                                    <form action="<?php echo APP_URL; ?>/app/controllers/medallas/delete.php" onclick="preguntar<?= $id_medalla; ?>(event)"
                                                          method="post" id="miFormulario<?= $id_medalla; ?>">
                                                        <input type="text" name="id_medalla" value="<?php echo $id_medalla; ?>"
                                                               hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                style="border-radius: 0px 5px 5px 0px"><i
                                                                class="bi bi-trash3"></i></button>
                                                    </form>-->

                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
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
    function preguntar<?= $id_medalla; ?>(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Eliminar Registro',
            text: 'Desea eliminar este registro?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#a5161d',
            denyButtonColor: '#270a0a',
            denyButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $('#miFormulario<?=$id_medalla;?>');
                form.submit();

            }
        });
    }
</script>

<!-- /.SCRIPT PARA COLOCAR DATATABLE AL FORMULARIO -->
<script>
    $(function () {
        $("#example1").DataTable({
            "pageLenght": 5,
            "language": {
                "emptyTable": "No hay Informacion",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
                "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
                "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                "lengthMenu": "Mostrar _MENU_ Roles",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"

                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [
                {text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-default'},
                {text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger'},
                {text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info'},
                {text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success'},
                {text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning'}
            ]

        }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
    });
</script>