<?php

include('../../../app/config.php');

$id_certificado = $_POST["id_certificado"];
$nombre_documento = $_POST["nombre_documento"];

//LINEAS PARA ELIMINAR LA IMAGEN EN CASO DE DELETE
$documento= "../../../public/certificados/" . $nombre_documento;
unlink($documento);




$sentencia = $pdo->prepare("DELETE FROM certificados where id_certificado=:id_certificado");


$sentencia->bindParam('id_certificado', $id_certificado);

try {
    if ($sentencia->execute()) {
        //echo "Se registro los datos de la manera correcta";
        session_start();
        $_SESSION['mensaje'] = "SE ELIMINÓ EL CERTIFICADO DE LA MANERA CORRECTA";
        $_SESSION['icono'] = "success";
        header("location:" . APP_URL . "/admin/certificados");
    } else {
        //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
        session_start();
        $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/certificados");
    }

}catch (PDOException $e){
    session_start();
    $_SESSION['mensaje'] = "ERROR NO SE PUDO ELIMINAR EN LA BASE DE DATOS, PORQUE EXISTE EN OTRAS TABLAS";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/certificados");
}
