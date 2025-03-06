<?php

include ('../../../app/config.php');
$nombre_medalla=$_POST['nombre_medalla'];//RECIBIMOS EL DATO DE NOMBRE MEDALLA
$nombre_medalla=mb_strtoupper($nombre_medalla,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$estado_medalla=$_POST['estado_medalla'];

if ($nombre_medalla=="" OR $estado_medalla=="") {
    session_start();
    $_SESSION['mensaje']="LLENE LOS CAMPOS, NO SE ADMITEN VACIOS";
    $_SESSION['icono']="error";
    header("location:".APP_URL."/admin/medalla/create.php");
}else{
    $sentencia=$pdo->prepare("INSERT INTO medallas 
        (nombre_medalla,fyh_creacion_medalla,estado_medalla) 
VALUES (:nombre_medalla,:fyh_creacion_medalla,:estado_medalla)");

    $sentencia->bindParam('nombre_medalla',$nombre_medalla);
    $sentencia->bindParam('fyh_creacion_medalla',$fechaHora);
    $sentencia->bindParam('estado_medalla',$estado_medalla);

    try {
        if ($sentencia->execute()){
            //echo "Se registro los datos de la manera correcta";
            session_start();
            $_SESSION['mensaje']="SE REGISTRO LA MEDALLA DE LA MANERA CORRECTA";
            $_SESSION['icono']="success";
            header("location:".APP_URL."/admin/medallas");
        }else{
            //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
            session_start();
            $_SESSION['mensaje']="ERROR NO SE PUDO REGISTRAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono']="error";
            header("location:".APP_URL."/admin/medallas/create.php");
        }
    }catch (Exception $exception){
        session_start();
        $_SESSION['mensaje']="LA MEDALLA YA EXISTE EN AL BASE DE DATOS";
        $_SESSION['icono']="error";
        header("location:".APP_URL."/admin/medallas/create.php");
    }

}


