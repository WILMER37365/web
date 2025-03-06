<?php

include ('../../../app/config.php');

$nombre_url=$_POST['nombre_url'];
$url=$_POST['url'];
$estado_permiso=$_POST['estado_permiso'];


    $sentencia=$pdo->prepare("INSERT INTO permisos 
        (nombre_url,url,fyh_creacion_permiso,estado_permiso) 
VALUES (:nombre_url,:url,:fyh_creacion_permiso,:estado_permiso)");

    $sentencia->bindParam('nombre_url',$nombre_url);
    $sentencia->bindParam('url',$url);
    $sentencia->bindParam('fyh_creacion_permiso',$fechaHora);
    $sentencia->bindParam('estado_permiso',$estado_permiso);


        if ($sentencia->execute()){
            //echo "Se registro los datos de la manera correcta";
            session_start();
            $_SESSION['mensaje']="SE REGISTRO EL PERMISO DE LA MANERA CORRECTA";
            $_SESSION['icono']="success";
            header("location:".APP_URL."/admin/roles/permisos.php");
        }else{
            //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
            session_start();
            $_SESSION['mensaje']="ERROR NO SE PUDO REGISTRAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono']="error";
            header("location:".APP_URL."/admin/roles/create.php");
        }


