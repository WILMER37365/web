<?php

include ('../../../app/config.php');
$nombre_forma=$_POST['nombre_forma'];//RECIBIMOS EL INPUT DE NOMBRE FORMA
$nombre_forma=mb_strtoupper($nombre_forma,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$estado_forma=$_POST['estado_forma'];

if ($nombre_forma=="" OR $estado_forma=="") {
    session_start();
    $_SESSION['mensaje']="LLENE LOS CAMPOS, NO SE ADMITEN VACIOS";
    $_SESSION['icono']="error";
    header("location:".APP_URL."/admin/formasfarmaceuticas/create.php");
}else{
    $sentencia=$pdo->prepare("INSERT INTO formasfarmaceuticas 
        (nombre_forma,fyh_creacion_forma,estado_forma) 
VALUES (:nombre_forma,:fyh_creacion_forma,:estado_forma)");

    $sentencia->bindParam('nombre_forma',$nombre_forma);
    $sentencia->bindParam('fyh_creacion_forma',$fechaHora);
    $sentencia->bindParam('estado_forma',$estado_forma);

    try {
        if ($sentencia->execute()){
            //echo "Se registro los datos de la manera correcta";
            session_start();
            $_SESSION['mensaje']="SE REGISTRO LA FORMA FARMACÉUTICA DE LA MANERA CORRECTA";
            $_SESSION['icono']="success";
            header("location:".APP_URL."/admin/formasfarmaceuticas");
        }else{
            //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
            session_start();
            $_SESSION['mensaje']="ERROR NO SE PUDO REGISTRAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono']="error";
            header("location:".APP_URL."/admin/formasfarmaceuticas/create.php");
        }
    }catch (Exception $exception){
        session_start();
        $_SESSION['mensaje']="LA FORMA FARMACÉUTICA YA EXISTE EN AL BASE DE DATOS";
        $_SESSION['icono']="error";
        header("location:".APP_URL."/admin/formasfarmaceuticas/create.php");
    }

}


