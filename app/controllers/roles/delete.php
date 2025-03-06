<?php

include('../../../app/config.php');

$id_rol = $_POST["id_rol"];


$sentencia = $pdo->prepare("DELETE FROM roles where id_rol=:id_rol");


$sentencia->bindParam('id_rol', $id_rol);


try {
    if ($sentencia->execute()) {
        //echo "Se registro los datos de la manera correcta";
        session_start();
        $_SESSION['mensaje'] = "SE ELIMINÓ EL ROL DE LA MANERA CORRECTA";
        $_SESSION['icono'] = "success";
        header("location:" . APP_URL . "/admin/roles");
    } else {
        //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
        session_start();
        $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/roles");
    }
}catch (PDOException $e){
    session_start();
    $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, PORQUE EXISTE EN OTRAS TABLAS";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/roles");
}





