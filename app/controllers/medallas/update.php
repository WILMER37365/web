<?php
include('../../../app/config.php');

$id_medalla = $_POST["id_medalla"];//ESTE ES EL INPUT QUE ESTAMOS ENVIANDO PERO ESTA EN HIDDEN

$nombre_medalla=$_POST['nombre_medalla'];//AQUI MANDAMOS LE NOMBRE DE LAFORMA FARAMCEUTICA
$nombre_medalla = mb_strtoupper($nombre_medalla, 'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$estado_medalla = $_POST['estado_medalla'];//AQUI MANDAMOS EL ESTADO DE LAFORMA FARAMCEUTICA

if ($nombre_medalla == "" or $estado_medalla == "") {
    session_start();
    $_SESSION['mensaje'] = "LLENE LOS CAMPOS, NO SE ADMITEN VACIOS";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/medallas/edit.php?id=".$id_medalla);
} else {
    $sentencia = $pdo->prepare("UPDATE medallas 
    SET nombre_medalla=:nombre_medalla,
        estado_medalla=:estado_medalla,
        fyh_actualizacion_medalla=:fyh_actualizacion_medalla
    WHERE id_medalla = :id_medalla");

    $sentencia->bindParam('nombre_medalla', $nombre_medalla);
    $sentencia->bindParam('fyh_actualizacion_medalla', $fechaHora);
    $sentencia->bindParam('estado_medalla', $estado_medalla);
    $sentencia->bindParam('id_medalla', $id_medalla);

    try {
        if ($sentencia->execute()) {
            //echo "Se registro los datos de la manera correcta";
            session_start();
            $_SESSION['mensaje'] = "SE ACTUALIZO LA MEDALLA DE LA MANERA CORRECTA";
            $_SESSION['icono'] = "success";
            header("location:" . APP_URL . "/admin/medallas");
        } else {
            //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
            session_start();
            $_SESSION['mensaje'] = "ERROR NO SE PUDO ACTUALIZAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono'] = "error";
            header("location:" . APP_URL . "/admin/medallas/edit.php?id=".$id_medalla);
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['mensaje'] = "LA MEDALLA YA EXISTE EN AL BASE DE DATOS";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/medallas/edit.php?id=".$id_medalla);
    }


}


