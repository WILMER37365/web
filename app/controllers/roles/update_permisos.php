<?php

include ('../../../app/config.php');
$id_permiso=$_POST['id_permiso'];
$nombre_url=$_POST['nombre_url'];
$url=$_POST['url'];
$estado_permiso=$_POST['estado_permiso'];


$sentencia=$pdo->prepare("UPDATE  permisos 
      SET  nombre_url=:nombre_url,
           url=:url,
           fyh_actualizacion_permiso=:fyh_actualizacion_permiso,
           estado_permiso=:estado_permiso
WHERE id_permiso=:id_permiso");

$sentencia->bindParam('nombre_url',$nombre_url);
$sentencia->bindParam('url',$url);
$sentencia->bindParam('fyh_actualizacion_permiso',$fechaHora);
$sentencia->bindParam('estado_permiso',$estado_permiso);
$sentencia->bindParam('id_permiso',$id_permiso);



if ($sentencia->execute()){
    //echo "Se registro los datos de la manera correcta";
    session_start();
    $_SESSION['mensaje']="SE ACTUALIZÓ EL PERMISO DE LA MANERA CORRECTA";
    $_SESSION['icono']="success";
    header("location:".APP_URL."/admin/roles/permisos.php");
}else{
    //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
    session_start();
    $_SESSION['mensaje']="ERROR NO SE PUDO REGISTRAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
    $_SESSION['icono']="error";
    header("location:".APP_URL."/admin/roles/create.php");
}


