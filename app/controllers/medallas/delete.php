<?php

include('../../../app/config.php');

$id_medalla = $_POST["id_medalla"];


$sentencia=$pdo->prepare("DELETE FROM medallas WHERE id_medalla = :id_medalla");
$sentencia->bindParam(':id_medalla',$id_medalla);

try {
    if ($sentencia->execute()) {
        //echo "Se registro los datos de la manera correcta";
        session_start();
        $_SESSION['mensaje'] = "SE ELIMINÓ LA MEDALLA DE LA MANERA CORRECTA";
        $_SESSION['icono'] = "success";
        header("location:" . APP_URL . "/admin/medallas");
    } else {
        //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
        session_start();
        $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/medallas");
    }

}catch (exception $e){
    session_start();
    $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, PORQUE EXISTE EN OTRAS TABLAS";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/medallas");
}

