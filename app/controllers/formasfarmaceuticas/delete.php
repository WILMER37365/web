<?php

include('../../../app/config.php');

$id_forma = $_POST["id_forma"];



$sentencia = $pdo->prepare("DELETE FROM formasfarmaceuticas where id_forma=:id_forma");


$sentencia->bindParam('id_forma', $id_forma);

try {
    if ($sentencia->execute()) {
        //echo "Se registro los datos de la manera correcta";
        session_start();
        $_SESSION['mensaje'] = "SE ELIMINÓ LA FORMA FARMACÉUTICA DE LA MANERA CORRECTA";
        $_SESSION['icono'] = "success";
        header("location:" . APP_URL . "/admin/formasfarmaceuticas");
    } else {
        //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
        session_start();
        $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/formasfarmaceuticas");
    }


}catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, PORQUE EXISTE EN OTRAS TABLAS";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/formasfarmaceuticas");
}




