<?php

include('../../../app/config.php');

$id_permiso = $_POST["id_permiso"];




    $sentencia = $pdo->prepare("DELETE FROM permisos where id_permiso=:id_permiso");

    $sentencia->bindParam('id_permiso', $id_permiso);

try {
    if ($sentencia->execute()) {
        //echo "Se registro los datos de la manera correcta";
        session_start();
        $_SESSION['mensaje'] = "SE ELIMINÓ EL PERMISO DE LA MANERA CORRECTA";
        $_SESSION['icono'] = "success";
        header("location:" . APP_URL . "/admin/roles/permisos.php");
    } else {
        //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
        session_start();
        $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/roles/permisos.php");
    }

}catch (PDOException $e){
    session_start();
    $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, PORQUE EXISTE EN OTRAAS TABLAS";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/roles/permisos.php");
}



