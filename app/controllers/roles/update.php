<?php
include('../../../app/config.php');

$id_rol = $_POST["id_rol"];
$nombre_rol=$_POST['nombre_rol'];
$nombre_rol = mb_strtoupper($nombre_rol, 'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$estado_rol = $_POST['estado'];

if ($nombre_rol == "" or $estado_rol == "") {
    session_start();
    $_SESSION['mensaje'] = "LLENE LOS CAMPOS, NO SE ADMITEN VACIOS";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/roles/edit.php?id=".$id_rol);
} else {
    $sentencia = $pdo->prepare("UPDATE roles 
    SET nombre_rol=:nombre_rol,
        estado_rol=:estado_rol,
        fyh_actualizacion_rol=:fyh_actualizacion_rol
    WHERE id_rol = :id_rol");

    $sentencia->bindParam('nombre_rol', $nombre_rol);
    $sentencia->bindParam('fyh_actualizacion_rol', $fechaHora);
    $sentencia->bindParam('estado_rol', $estado_rol);
    $sentencia->bindParam('id_rol', $id_rol);

    try {
        if ($sentencia->execute()) {
            //echo "Se registro los datos de la manera correcta";
            session_start();
            $_SESSION['mensaje'] = "SE ACTUALIZO EL ROL DE LA MANERA CORRECTA";
            $_SESSION['icono'] = "success";
            header("location:" . APP_URL . "/admin/roles");
        } else {
            //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
            session_start();
            $_SESSION['mensaje'] = "ERROR NO SE PUDO ACTUALIZAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono'] = "error";
            header("location:" . APP_URL . "/admin/roles/edit.php?id=".$id_rol);
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['mensaje'] = "EL ROL YA EXISTE EN AL BASE DE DATOS";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/roles/edit.php?id=".$id_rol);
    }


}


