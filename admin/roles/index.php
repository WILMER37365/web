<?php

include('../../app/config.php');

include('../../admin/layout/parte1.php');

//INCLUIMOS PARA OBTENER LOS DATOS DE LA TABLA ROLES EL SIGUIENTE CONTROLADOR
include('../../app/controllers/roles/listado_de_roles.php');

include('../../app/controllers/roles/listado_de_permisos.php');

include('../../app/controllers/roles/listado_de_roles_permisos.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>LISTA DE ROLES</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Roles Registrados</h3>

                            <div class="card-tools">
                                <a href="create.php" class="btn btn-info"><i class="fa-solid fa-user-shield"></i> Crear
                                    Nuevo Rol</a>
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
                                        <center>Nombre del Rol</center>
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
                                $contador_rol = 0;
                                foreach ($roles as $role) {
                                    $id_rol = $role['id_rol'];
                                    $contador_rol = $contador_rol + 1; ?>
                                    <tr>
                                        <td>
                                            <center><?php echo $contador_rol; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $role['nombre_rol']; ?></center>
                                        </td>
                                        <td>

                                            <center>
                                                <?php
                                                if ($role['estado_rol'] == '1') {
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
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#modal_asignacion<?= $id_rol; ?>">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal_asignacion<?= $id_rol; ?>"
                                                         tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        >
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                     style="background-color: #ffa400">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Asignación de Roles</h1>
                                                                    <button type="button" class="btn-close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <input type="text" name="rol_id" id="rol_id<?=$id_rol;?>" value="<?=$id_rol;?>" hidden>
                                                                            <label>Rol: <?= $role['nombre_rol']; ?></label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <select name="permiso_id" id="permiso_id<?=$id_rol;?>" class="form-control">
                                                                                <?php
                                                                                foreach ($permisos as $permiso) {
                                                                                    $id_permiso = $permiso['id_permiso']; ?>

                                                                                    <option value="<?= $id_permiso; ?>"><?= $permiso['nombre_url']; ?></option>
                                                                                <?php }


                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <button type="submit"
                                                                                    class="btn btn-primary mb-2" id="btn_reg<?=$id_rol;?>">Asignar
                                                                            </button>
                                                                        </div>
                                                                        <script>
                                                                            $('#btn_reg<?=$id_rol;?>').click(function (){
                                                                                //alert("preisonaste el boton");
                                                                                var a=$('#rol_id<?=$id_rol;?>').val();
                                                                                var b=$('#permiso_id<?=$id_rol;?>').val();
                                                                                //alert(a+"-"+b);
                                                                                var url="../../app/controllers/roles/create_roles_permisos.php";
                                                                                $.get(url,{rol_id:a, permiso_id:b},function(datos){
                                                                                    $('#respuesta<?=$id_rol;?>').html(datos);
                                                                                    $('#tabla<?=$id_rol;?>').css('display','none');

                                                                                    Swal.fire({
                                                                                        position:"top-end",
                                                                                        icon:"success",
                                                                                        title:"Se asigno el permiso de la manera correcta",
                                                                                        showConfirmButton:false,
                                                                                        timer:5000
                                                                                    })

                                                                                });
                                                                            });
                                                                        </script>

                                                                    </div>
                                                                    <hr>
                                                                    <div id="respuesta<?=$id_rol;?>"></div>
                                                                    <div class="row" id="tabla<?=$id_rol;?>">
                                                                        <table class="table table-bordered table-sm table-striped table-hover"  >
                                                                            <tr>
                                                                                <th style="text-align: center; background-color:#ffa400 ">Nro</th>
                                                                                <th style="text-align: center; background-color:#ffa400 ">Rol</th>
                                                                                <th style="text-align: center; background-color:#ffa400 ">Permiso</th>
                                                                                <th style="text-align: center; background-color:#ffa400 ">Acción</th>
                                                                            </tr>
                                                                            <?php
                                                                            $contador_rol_per=0;
                                                                            foreach ($roles_permisos as $roles_permiso){
                                                                                if ($id_rol==$roles_permiso['rol_id']) {
                                                                                    $id_rol_permiso = $roles_permiso['id_rol_permiso'];
                                                                                    $contador_rol_per=$contador_rol_per+1;
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><center><?=$contador_rol_per?></center></td>
                                                                                        <td><center><?=$roles_permiso['nombre_rol'];?></center></td>
                                                                                        <td><center><?=$roles_permiso['nombre_url'];?></center></td>
                                                                                        <td><center>
                                                                                                <form action="<?php echo APP_URL; ?>/app/controllers/roles/delete_rol_permiso.php"
                                                                                                      onclick="preguntar2(<?php echo $id_rol_permiso; ?>)"
                                                                                                      method="post" id="miFormulario_63<?= $id_rol_permiso; ?>">
                                                                                                    <input type="text" name="id_rol_permiso" value="<?php echo $id_rol_permiso; ?>"
                                                                                                           hidden>
                                                                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                                                            style=""><i
                                                                                                                class="bi bi-trash3"></i></button>
                                                                                                </form>
                                                                                                <script>
                                                                                                    function preguntar2(id_rol_permiso) {
                                                                                                        event.preventDefault(); // Prevenir el envío automático del formulario
                                                                                                        Swal.fire({
                                                                                                            title: 'Eliminar Asignacion de Rol',
                                                                                                            text: '¿Desea eliminar esta Asignacion de Rol?',
                                                                                                            icon: 'question',
                                                                                                            showDenyButton: true,
                                                                                                            confirmButtonText: 'Eliminar',
                                                                                                            confirmButtonColor: '#a5161d',
                                                                                                            denyButtonColor: '#270a0a',
                                                                                                            denyButtonText: 'Cancelar',
                                                                                                        }).then((result) => {
                                                                                                            if (result.isConfirmed) {
                                                                                                                // Si el usuario confirma, entonces se envía el formulario
                                                                                                                var form = $('#miFormulario_63' + id_rol_permiso);
                                                                                                                form.submit();
                                                                                                            }
                                                                                                        });
                                                                                                    }
                                                                                                </script>
                                                                                            </center></td>

                                                                                    </tr>
                                                                                    <?php
                                                                                }






                                                                            }
                                                                            ?>

                                                                        </table>

                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <a href="show.php?id=<?php echo $id_rol; ?>" type="button"
                                                       class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>


                                                    <a href="edit.php?id=<?php echo $id_rol; ?>" type="button"
                                                       class="btn btn-success btn-sm"><i
                                                                class="bi bi-pencil-square"></i></a>
                                                    <form action="<?php echo APP_URL; ?>/app/controllers/roles/delete.php"
                                                          onclick="preguntar(<?php echo $id_rol; ?>)"
                                                          method="post" id="miFormulario_65<?= $id_rol; ?>">
                                                        <input type="text" name="id_rol" value="<?php echo $id_rol; ?>"
                                                               hidden>
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
    function preguntar(id_rol) {
        event.preventDefault(); // Prevenir el envío automático del formulario
        Swal.fire({
            title: 'Eliminar Rol',
            text: '¿Desea eliminar este rol?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#a5161d',
            denyButtonColor: '#270a0a',
            denyButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, entonces se envía el formulario
                var form = $('#miFormulario_65' + id_rol);
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