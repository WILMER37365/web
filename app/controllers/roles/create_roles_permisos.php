<?php

include('../../../app/config.php');


$id_rol = $_GET["rol_id"];
$permiso_id = $_GET["permiso_id"];


$sentencia = $pdo->prepare("INSERT INTO roles_permisos 
        (rol_id,permiso_id,fyh_creacion_roles_permiso,estado_roles_permiso) 
VALUES (:rol_id,:permiso_id,:fyh_creacion_roles_permiso,:estado_roles_permiso)");

$sentencia->bindParam('rol_id', $id_rol);
$sentencia->bindParam('permiso_id', $permiso_id);
$sentencia->bindParam('fyh_creacion_roles_permiso', $fechaHora);
$sentencia->bindParam('estado_roles_permiso', $estado_de_registro);
$sentencia->execute();
?>
    <div class="row">
        <table class="table table-bordered table-sm table-striped table-hover" id="tablares<?=$id_rol; ?>">
            <tr>
                <th style="text-align: center; background-color:#ffa400 ">Nro</th>
                <th style="text-align: center; background-color:#ffa400 ">Rol</th>
                <th style="text-align: center; background-color:#ffa400 ">Permiso</th>
                <th style="text-align: center; background-color:#ffa400 ">Acción</th>
            </tr>
            <?php
            $sql_roles_permisos = "SELECT * FROM roles_permisos as rolper
         INNER JOIN permisos as per ON per.id_permiso = rolper.permiso_id
         INNER JOIN roles as rol ON rol.id_rol = rolper.rol_id
        WHERE rolper.estado_roles_permiso= '1'  ORDER BY per.id_permiso ASC ";

            $query_roles_permisos = $pdo->prepare($sql_roles_permisos);
            $query_roles_permisos->execute();
            $roles_permisos = $query_roles_permisos->fetchAll(PDO::FETCH_ASSOC);

            $contador_rol_per = 0;
            foreach ($roles_permisos as $roles_permiso) {
                if ($id_rol == $roles_permiso['rol_id']) {
                    $id_rol_permiso = $roles_permiso['id_rol_permiso'];
                    $contador_rol_per = $contador_rol_per + 1;
                    ?>
                    <tr>
                        <td>
                            <center><?= $contador_rol_per ?></center>
                        </td>
                        <td>
                            <center><?= $roles_permiso['nombre_rol']; ?></center>
                        </td>
                        <td>
                            <center><?= $roles_permiso['nombre_url']; ?></center>
                        </td>
                        <td><center>
                                <form action="<?php echo APP_URL; ?>/app/controllers/roles/delete_rol_permiso.php"
                                      onclick="preguntar(<?php echo $id_rol_permiso; ?>)"
                                      method="post" id="miFormulario64<?= $id_rol_permiso; ?>">
                                    <input type="text" name="id_rol_permiso" value="<?php echo $id_rol_permiso; ?>"
                                           hidden>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            style=""><i
                                                class="bi bi-trash3"></i></button>
                                </form>
                                <script>
                                    function preguntar(id_rol_permiso) {
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
                                                var form = $('#miFormulario64' + id_rol_permiso);
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
<?php
/*
if ($sentencia->execute()) {
    //echo "Se registro los datos de la manera correcta";
    session_start();
    $_SESSION['mensaje'] = "SE REGISTRO EL PERMISO DE LA MANERA CORRECTA";
    $_SESSION['icono'] = "success";
    header("location:" . APP_URL . "/admin/roles/permisos.php");
} else {
    //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
    session_start();
    $_SESSION['mensaje'] = "ERROR NO SE PUDO REGISTRAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/roles/create.php");
}
*/

