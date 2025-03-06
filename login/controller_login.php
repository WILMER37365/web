<?php

include ('../app/config.php'); //conexion a la base de datos

$email=$_POST["email"];// variables del formulario por le metodo post
$password=$_POST["password"];// variables del formulario por le metodo post

$sql="SELECT * FROM usuarios WHERE email='$email' AND estado='1'";
$query=$pdo->prepare($sql);
$query->execute();

$usuarios=$query->fetchAll(PDO::FETCH_ASSOC);

$contador=0;
foreach($usuarios as $usuario){
    $password_tabla=$usuario['password'];
    $contador=$contador+1;

}
if(($contador>0) && (password_verify($password,$password_tabla))){
    echo "LOS DATOS SON CORRECTOS";
    session_start();
    $_SESSION['mensaje']="BIENVENIDO AL SISTEMA";
    $_SESSION['icono']="success";
    $_SESSION['sesion_email']=$email;
    header("location:".APP_URL."/admin");
}else{
    echo "LOS DATOS SON INCORRECTOS";
    session_start();
    $_SESSION['mensaje']="LOS DATOS INTRODUCIDOS SON INCORRECTOS, VUELVA A INTENTARLO";

    header("location:".APP_URL."/login");
}
