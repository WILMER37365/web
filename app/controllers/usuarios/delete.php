<?php

include('../../../app/config.php');

$id_usuario = $_POST["id_usuario"];
$nombre_perfil = $_POST["nombre_perfil"];

//LINEAS PARA ELIMINAR LA IMAGEN EN CASO DE DELETE
$imagen= "../../../public/images/usuarios/" . $nombre_perfil;
unlink($imagen);




$sentencia = $pdo->prepare("DELETE FROM usuarios where id_usuario=:id_usuario");


$sentencia->bindParam('id_usuario', $id_usuario);

try {
    if ($sentencia->execute()) {
        //echo "Se registro los datos de la manera correcta";
        session_start();
        $_SESSION['mensaje'] = "SE ELIMINÓ EL USUARIO DE LA MANERA CORRECTA";
        $_SESSION['icono'] = "success";
        header("location:" . APP_URL . "/admin/usuarios");
    } else {
        //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
        session_start();
        $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/usuarios");
    }
}catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/usuarios");
}


