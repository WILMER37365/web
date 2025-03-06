<?php

include('../../app/config.php');

include('../../admin/layout/parte1.php');

//INCLUIMOS PARA OBTENER LOS DATOS DE LA TABLA ROLES EL SIGUIENTE CONTROLADOR
include('../../app/controllers/roles/listado_de_permisos.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>LISTA DE PERMISOS</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-10">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Permisos Registrados</h3>

                            <div class="card-tools">
                                <a href="create_permisos.php" class="btn btn-info"><i class="fa-solid fa-user-shield"></i> Crear
                                    Nuevo Permiso</a>
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
                                        <center>Nombre de la URL</center>
                                    </th>
                                    <th>
                                        <center>URL</center>
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
                                $contador_permiso = 0;
                                foreach ($permisos as $permiso) {
                                    $id_permiso = $permiso['id_permiso'];
                                    $contador_permiso = $contador_permiso + 1; ?>
                                    <tr>
                                        <td>
                                            <center><?php echo $contador_permiso; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $permiso['nombre_url']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $permiso['url']; ?></center>
                                        </td>
                                        <td>

                                            <center>
                                                <?php
                                                if ($permiso['estado_permiso'] == '1') {
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

                                                    <a href="edit_permiso.php?id=<?php echo $id_permiso; ?>" type="button"
                                                       class="btn btn-success btn-sm"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <form action="<?php echo APP_URL; ?>/app/controllers/roles/delete_permiso.php"
                                                          method="post"
                                                          id="miFormulario5<?php echo $id_permiso; ?>"
                                                          onsubmit="preguntar(event, <?php echo $id_permiso; ?>)">
                                                        <input type="hidden" name="id_permiso" value="<?php echo $id_permiso; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>


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
    function preguntar(event, id_permiso) {
        event.preventDefault();
        Swal.fire({
            title: 'Eliminar Permiso',
            text: '¿Desea eliminar este permiso?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#a5161d',
            denyButtonColor: '#270a0a',
            denyButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('miFormulario5' + id_permiso).submit();
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Permisos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Permisos",
                "infoFiltered": "(Filtrado de _MAX_ total Permisos)",
                "lengthMenu": "Mostrar _MENU_ Permisos",
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