<?php

include('../../../app/config.php');

$nombres = $_POST['nombre_usuario'];
$nombres=mb_strtoupper($nombres,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS
$apellidos = $_POST['apellido_usuario'];
$apellidos=mb_strtoupper($apellidos,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS
$rol_id = $_POST['rol_usuario'];
$email = $_POST['email_usuario'];
$alias = $_POST['alias'];
$alias=mb_strtoupper($alias,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS
//$perfil = $_POST['image'];
$estado_usuario= $_POST['estado'];

$password = $_POST['password'];
$repetir_password = $_POST['repetir_password'];
$genero = $_POST['genero'];

//PARA LAS IMAGENES LO HACMEOS DE LA SIGUIENTE MANERA
if ($_FILES['image']['name'] != null) {
    $nombre_del_archivo=date('Y-m-d-H-i-s').$_FILES["image"]["name"];
    $location="../../../public/images/usuarios/".$nombre_del_archivo;
    move_uploaded_file($_FILES["image"]["tmp_name"], $location);
    $perfil=$nombre_del_archivo;
    //echo "EXISTE UNA IMAGEN";
}else{
    //echo "NO EXISTE UNA IMAGEN";

    if ($genero == 'femenino') {
        $imagen_predeterminada = "../../../public/images/usuarios_default/mujer.png";

    } else {
        $imagen_predeterminada = "../../../public/images/usuarios_default/hombre.png";
    }
    $nombre_del_archivo = date('Y-m-d-H-i-s') . "-" . basename($imagen_predeterminada);
    $location = "../../../public/images/usuarios/" . $nombre_del_archivo;
    copy($imagen_predeterminada, $location);
    $perfil=$nombre_del_archivo;
}




if ($password == $repetir_password) {

    $password = password_hash("$password", PASSWORD_DEFAULT);

    $sentencia = $pdo->prepare("INSERT INTO usuarios
(nombres,apellidos,rol_id ,email,alias,password,perfil,fyh_creacion,estado,genero)
VALUES (:nombres,:apellidos,:rol_id,:email,:alias,:password,:perfil,:fyh_creacion,:estado,:genero)");

    $sentencia->bindParam('nombres', $nombres);
    $sentencia->bindParam('apellidos', $apellidos);
    $sentencia->bindParam('rol_id', $rol_id);
    $sentencia->bindParam('email', $email);
    $sentencia->bindParam('alias', $alias);
    $sentencia->bindParam('password', $password);
    $sentencia->bindParam('perfil', $perfil);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_usuario);
    $sentencia->bindParam('genero', $genero);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "EL USUARIO SE CREO DE FORMA SATISFACTORIA EN LA BASE DE DATOS";
            $_SESSION['icono'] = "success";
            header("location:".APP_URL."/admin/usuarios");
        } else {
            session_start();
            $_SESSION['mensaje'] = "EROR NO SE PUDO REGISTRAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono'] = "error";
            ?>
            <script>
                window.history.back();
            </script>
            <?php
        }

    }catch (Exception $exception) {
        session_start();
        $_SESSION['mensaje'] = "EL EMAIL YA EXISTE EN LA BASE DE DATOS";
        $_SESSION['icono'] = "error";
        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "LAS CONTRASEÑAS NO SON IGUALES, REVISELOS";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}


