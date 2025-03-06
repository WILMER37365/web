<?php
include('../../../app/config.php');

$id_forma = $_POST["id_forma"];//ESTE ES EL INPUT QUE ESTAMOS ENVIANDO PERO ESTA EN HIDDEN

$nombre_forma=$_POST['nombre_forma'];//AQUI MANDAMOS LE NOMBRE DE LAFORMA FARAMCEUTICA
$nombre_forma = mb_strtoupper($nombre_forma, 'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$estado_forma = $_POST['estado_forma'];//AQUI MANDAMOS EL ESTADO DE LAFORMA FARAMCEUTICA

if ($nombre_forma == "" or $estado_forma == "") {
    session_start();
    $_SESSION['mensaje'] = "LLENE LOS CAMPOS, NO SE ADMITEN VACIOS";
    $_SESSION['icono'] = "error";
    header("location:" . APP_URL . "/admin/formasfarmaceuticas/edit.php?id=".$id_forma);
} else {
    $sentencia = $pdo->prepare("UPDATE formasfarmaceuticas 
    SET nombre_forma=:nombre_forma,
        estado_forma=:estado_forma,
        fyh_actualizacion_forma=:fyh_actualizacion_forma
    WHERE id_forma = :id_forma");

    $sentencia->bindParam('nombre_forma', $nombre_forma);
    $sentencia->bindParam('fyh_actualizacion_forma', $fechaHora);
    $sentencia->bindParam('estado_forma', $estado_forma);
    $sentencia->bindParam('id_forma', $id_forma);

    try {
        if ($sentencia->execute()) {
            //echo "Se registro los datos de la manera correcta";
            session_start();
            $_SESSION['mensaje'] = "SE ACTUALIZO LA FORMA FARMACÉUTICA DE LA MANERA CORRECTA";
            $_SESSION['icono'] = "success";
            header("location:" . APP_URL . "/admin/formasfarmaceuticas");
        } else {
            //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
            session_start();
            $_SESSION['mensaje'] = "ERROR NO SE PUDO ACTUALIZAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono'] = "error";
            header("location:" . APP_URL . "/admin/formasfarmaceuticas/edit.php?id=".$id_forma);
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['mensaje'] = "LA FORMA FARMACÉUTICA YA EXISTE EN AL BASE DE DATOS";
        $_SESSION['icono'] = "error";
        header("location:" . APP_URL . "/admin/formasfarmaceuticas/edit.php?id=".$id_forma);
    }


}


