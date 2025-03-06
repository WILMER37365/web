<?php

include('../../app/config.php');

include('../../admin/layout/parte1.php');

//INCLUIMOS PARA OBTENER LOS DATOS DE LA TABLA ROLES EL SIGUIENTE CONTROLADOR
include('../../app/controllers/certificados/listado_de_cert.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>LISTA DE CERTIFICADOS HECHO EN BOLIVIA</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Certificados Hecho en Bolivia Registrados</h3>

                            <div class="card-tools d-flex">
                                <a href="create.php" class="btn btn-info me-3"><i class="fa-solid fa-medal"></i> Crear Nuevo Certificado</a>
                                <form action="reporte_cert.php" method="POST" class="d-inline"  target="_blank">
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
                                        <center>Nombre de Producto</center>
                                    </th>
                                    <th>
                                        <center>Composición</center>
                                    </th>
                                    <th>
                                        <center>Forma Farmacéutica</center>
                                    </th>
                                    <th>
                                        <center>Medalla</center>
                                    </th>
                                    <th>
                                        <center>Fecha de Emisión</center>
                                    </th>
                                    <th>
                                        <center>Fecha de Vencimiento</center>
                                    </th>
                                    <th>
                                        <center>Vigencia</center>
                                    </th>

                                    <th>
                                        <center>Nº Registro Sanitario</center>
                                    </th>
                                    <th>
                                        <center>Código Liname</center>
                                    </th>
                                    <th>
                                        <center>Ficha Técnica</center>
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
                                $contador_certificados = 0;
                                foreach ($certificados as $certificado) {
                                    $id_certificado = $certificado['id_certificado'];
                                    $contador_certificados = $contador_certificados + 1; ?>
                                    <tr>
                                        <td>
                                            <center><?php echo $contador_certificados; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $certificado['producto']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $certificado['composicion']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $certificado['nombre_forma']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $certificado['nombre_medalla']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $certificado['fecha_emision']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $certificado['fecha_vencimiento']; ?></center>
                                        </td>
                                        <td>

                                            <center>
                                                <?php
                                                $fechaVencimiento = new DateTime($certificado['fecha_vencimiento']);
                                                $fechaHoy = new DateTime();
                                                $diferencia = $fechaHoy->diff($fechaVencimiento)->days;

                                                if ($fechaHoy > $fechaVencimiento) {
                                                    // Si la fecha actual supera la de vencimiento
                                                    echo "<span class='text-danger'><i class='fa-solid fa-circle-xmark fa-2x'></i> <br>Vencido</span>";

                                                } elseif ($diferencia <= 20) {
                                                    // Si faltan 20 días o menos para la fecha de vencimiento
                                                    echo "<span class='text-warning'><i class='fas fa-circle-exclamation fa-2x'></i> <br> Próximo a Vencer</span>";
                                                } else {
                                                    // Si faltan más de 20 días
                                                    echo "<span class='text-success'> <i class='fa-solid fa-circle-check fa-2x'></i> <br>Vigente</span>";
                                                }
                                                ?>
                                            </center>
                                        </td>

                                        <td>
                                            <center><?php echo $certificado['numero_registro_sanitario']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $certificado['codigo_liname']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $certificado['ficha_tecnica']; ?></center>
                                        </td>

                                        <td>

                                            <center>
                                                <?php
                                                if ($certificado['estado_cert'] == '1') {
                                                    echo "<span class='text-success small'><i class='bi bi-check-circle-fill '></i> Activo</span>";
                                                } else {
                                                    echo "<span class='text-danger small'><i class='bi bi-x-circle-fill'></i> Inactivo</span>";
                                                }
                                                ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="show.php?id=<?php echo $id_certificado; ?>" type="button"
                                                       class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a href="edit.php?id=<?php echo $id_certificado; ?>" type="button"
                                                       class="btn btn-success btn-sm"><i
                                                                class="bi bi-pencil-square"></i></a>
                                                    <a href="delete.php?id=<?php echo $id_certificado; ?>" type="button"
                                                       class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                                                    <a href="download.php?id=<?php echo $id_certificado; ?>" type="button"
                                                       class="btn btn-warning btn-sm"><i class="fa-regular fa-circle-down"></i></a>
                                                    <!-- /.card-tools
                                                    <form action="<?php echo APP_URL; ?>/app/controllers/certificados/delete.php"
                                                          method="post"
                                                          id="miFormulario2<?php echo $id_certificado; ?>">
                                                        <input type="text" name="id_certificado"
                                                               value="<?php echo $id_certificado; ?>" hidden>
                                                        <input type="text" name="nombre_documento"
                                                               value="<?php echo $certificado['documento']; ?>" hidden>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                style="border-radius: 0px 5px 5px 0px"
                                                                onclick="preguntar(<?php echo $id_certificado; ?>)">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
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
<!-- /.SCRIPT PARA PREGUNTAR SI SE DESEA ELIMINAR EL CERTIFICADO -->
<script>
    function preguntar(id_certificado) {
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
                var form = $('#miFormulario2' + id_certificado);
                form.submit();
            }
        });
    }
</script>


<!-- /.SCRIPT PARA COLOCAR DATATABLE AL FORMULARIO -->
<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay Informacion",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Certificados",
                "infoEmpty": "Mostrando 0 a 0 de 0 Certificados",
                "infoFiltered": "(Filtrado de _MAX_ total Certificados)",
                "lengthMenu": "Mostrar _MENU_ Certificados",
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
                {
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    orientation: 'landscape' // Aquí se cambia la orientación a horizontal
                },
                {text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info'},
                {text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success'},
                {text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning'}
            ]

        }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
    });
</script>
