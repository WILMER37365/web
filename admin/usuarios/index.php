<?php

include('../../app/config.php');

include('../../admin/layout/parte1.php');

//INCLUIMOS PARA OBTENER LOS DATOS DE LA TABLA USUARIOS EL SIGUIENTE CONTROLADOR
include('../../app/controllers/usuarios/listado_de_usuarios.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>LISTA DE USUARIOS</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios Registrados</h3>

                            <div class="card-tools">
                                <a href="create.php" class="btn btn-info"><i class="fa-solid fa-users"></i> Crear
                                    Nuevo Usuario</a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead style="background-color: rgba(17,158,172,0.8); color: #040404;">
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombres del Usuario</center></th>
                                    <th><center>Apellidos del Usuario</center></th>
                                    <th><center>Rol</center></th>
                                    <th><center>Email</center></th>
                                    <th><center>Usuario</center></th>
                                    <th><center>Perfil</center></th>
                                    <th><center>Fecha de Creación</center></th>
                                    <th><center>Estado</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_usuarios = 0;
                                foreach ($usuarios as $usuario) {
                                    $id_usuario= $usuario['id_usuario'];
                                    $contador_usuarios = $contador_usuarios + 1; ?>
                                    <tr>
                                        <td><center><?php echo $contador_usuarios; ?></center></td>
                                        <td><center><?php echo $usuario['nombres']; ?></center></td>
                                        <td><center><?php echo $usuario['apellidos']; ?></center></td>
                                        <td><center><?php echo $usuario['nombre_rol']; ?></center></td>
                                        <td><center><?php echo $usuario['email']; ?></center></td>
                                        <td><center><?php echo $usuario['alias']; ?></center></td>
                                        
                                        <td><center>

                                                <img src="<?php echo APP_URL."/public/images/usuarios/".$usuario['perfil'];?>" width="100px" alt="">
                                            </center>
                                        </td>

                                        <td><center><?php echo $usuario['fyh_creacion']; ?></center></td>
                                        <td><center>
                                                <?php
                                                if ($usuario['estado'] == '1') {
                                                    echo "<span class='text-success'><i class='bi bi-check-circle-fill'></i> Activo</span>";
                                                } else {
                                                    echo "<span class='text-danger'><i class='bi bi-x-circle-fill'></i> Inactivo</span>";
                                                }
                                                ?>
                                            </center></td>


                                        <td>
                                            <center>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="show.php?id=<?php echo $id_usuario; ?>" type="button"
                                                       class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a href="edit.php?id=<?php echo $id_usuario; ?>" type="button"
                                                       class="btn btn-success btn-sm"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <form action="<?php echo APP_URL; ?>/app/controllers/usuarios/delete.php" onclick="preguntar(<?php echo $id_usuario; ?>)"
                                                          method="post" id="miFormulario3<?= $id_usuario; ?>">
                                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario; ?>"
                                                               hidden>
                                                        <input type="text" name="nombre_perfil" value="<?php echo $usuario['perfil'];?>" hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                style="border-radius: 0px 5px 5px 0px"><i
                                                                class="bi bi-trash3"></i></button>
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
    function preguntar(id_usuario) {
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
                var form = $('#miFormulario2' + id_usuario);
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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