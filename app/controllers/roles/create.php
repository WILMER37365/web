<?php

include ('../../../app/config.php');
echo $nombre_rol=$_POST['nombre_rol'];
$nombre_rol=mb_strtoupper($nombre_rol,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

echo $estado_rol=$_POST['estado'];

if ($nombre_rol=="" OR $estado_rol=="") {
    session_start();
    $_SESSION['mensaje']="LLENE LOS CAMPOS, NO SE ADMITEN VACIOS";
    $_SESSION['icono']="error";
    header("location:".APP_URL."/admin/roles/create.php");
}else{
    $sentencia=$pdo->prepare("INSERT INTO roles 
        (nombre_rol,fyh_creacion_rol,estado_rol) 
VALUES (:nombre_rol,:fyh_creacion_rol,:estado_rol)");

    $sentencia->bindParam('nombre_rol',$nombre_rol);
    $sentencia->bindParam('fyh_creacion_rol',$fechaHora);
    $sentencia->bindParam('estado_rol',$estado_rol);

    try {
        if ($sentencia->execute()){
            //echo "Se registro los datos de la manera correcta";
            session_start();
            $_SESSION['mensaje']="SE REGISTRO EL ROL DE LA MANERA CORRECTA";
            $_SESSION['icono']="success";
            header("location:".APP_URL."/admin/roles");
        }else{
            //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
            session_start();
            $_SESSION['mensaje']="ERROR NO SE PUDO REGISTRAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono']="error";
            header("location:".APP_URL."/admin/roles/create.php");
        }
    }catch (Exception $exception){
        session_start();
        $_SESSION['mensaje']="EL ROL YA EXISTE EN AL BASE DE DATOS";
        $_SESSION['icono']="error";
        header("location:".APP_URL."/admin/roles/create.php");
    }

}


