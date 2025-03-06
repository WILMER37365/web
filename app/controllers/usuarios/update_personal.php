<?php

include('../../../app/config.php');

//NECESITAMOS EL ID USUARIO
$id_usuario = $_POST['id_usuario'];
//NECESITAMOS EL PERFIL SI ESTAMOS MANDANDO IMAGEN
$perfil_usuario = $_POST['perfil_usu'];

$nombres = $_POST['nombre_usuario'];
$apellidos = $_POST['apellido_usuario'];

$password = $_POST['password'];
$repetir_password = $_POST['repetir_password'];
$genero = $_POST['genero'];

//PARA LAS IMAGENES LO HACMEOS DE LA SIGUIENTE MANERA
if ($_FILES['perfil']['name'] != null) {

    //AQUI EN ESTAS DOS LINEAS DE CODIO ELIMINAMOS LA IMAGEN ANTERIOR PARA QUE NOSE VAYA ALMACENANDO INDEFINIDAMENTE
    $imagen_anterior = "../../../public/images/usuarios/" . $perfil_usuario;
    unlink($imagen_anterior);

    $nombre_del_archivo = date('Y-m-d-H-i-s') . $_FILES["perfil"]["name"];
    $location = "../../../public/images/usuarios/" . $nombre_del_archivo;
    move_uploaded_file($_FILES["perfil"]["tmp_name"], $location);
    $perfil = $nombre_del_archivo;
    //echo "EXISTE UNA IMAGEN";
} else {
    //echo "NO EXISTE UNA IMAGEN";
    if ($perfil_usuario==""){
        if ($genero == 'femenino') {
            $imagen_predeterminada = "../../../public/images/usuarios_default/mujer.png";

        } else {
            $imagen_predeterminada = "../../../public/images/usuarios_default/hombre.png";
        }
        $nombre_del_archivo = date('Y-m-d-H-i-s') . "-" . basename($imagen_predeterminada);
        $location = "../../../public/images/usuarios/" . $nombre_del_archivo;
        copy($imagen_predeterminada, $location);
        $perfil = $nombre_del_archivo;
    }else{
        $perfil=$_POST['perfil_usu'];
    }


}


if ($password == "") {

    $sentencia = $pdo->prepare("UPDATE  usuarios
        SET nombres=:nombres,
            apellidos=:apellidos,
            genero=:genero,
            perfil=:perfil,
             estado=:estado,
            fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario");

    $sentencia->bindParam('nombres', $nombres);
    $sentencia->bindParam('apellidos', $apellidos);
    $sentencia->bindParam('genero', $genero);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('perfil', $perfil);
    $sentencia->bindParam('estado', $estado_de_registro);
    $sentencia->bindParam('id_usuario', $id_usuario);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "EL USUARIO SE ACTUALIZO DE FORMA SATISFACTORIA EN LA BASE DE DATOS";
            $_SESSION['icono'] = "success";
            header("location:" . APP_URL . "/admin/usuarios");
        } else {
            session_start();
            $_SESSION['mensaje'] = "EROR NO SE PUDO ACTUALIZO EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono'] = "error";
            ?>
            <script>
                window.history.back();
            </script>
            <?php
        }

    } catch (Exception $exception) {
        session_start();
        $_SESSION['mensaje'] = "EL EMAIL YA EXISTE EN LA BASE DE DATOS";
        $_SESSION['icono'] = "error";
        ?>
        <script>
            window.history.back();
        </script>
        <?php

    }

}

else{
    if ($password == $repetir_password) {

        $password = password_hash("$password", PASSWORD_DEFAULT);

        $sentencia = $pdo->prepare("UPDATE  usuarios
        SET nombres=:nombres,
            apellidos=:apellidos,
            genero=:genero,
            password=:password,
            estado=:estado,
            fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario");

        $sentencia->bindParam('nombres', $nombres);
        $sentencia->bindParam('apellidos', $apellidos);
        $sentencia->bindParam('genero', $genero);
        $sentencia->bindParam('password', $password);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);

        $sentencia->bindParam('estado', $estado_de_registro);
        $sentencia->bindParam('id_usuario', $id_usuario);

        try {
            if ($sentencia->execute()) {
                session_start();
                $_SESSION['mensaje'] = "EL USUARIO SE ACTUALIZO DE FORMA SATISFACTORIA EN LA BASE DE DATOS";
                $_SESSION['icono'] = "success";
                header("location:" . APP_URL . "/admin/usuarios");
            } else {
                session_start();
                $_SESSION['mensaje'] = "EROR NO SE PUDO ACTUALIZAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
                $_SESSION['icono'] = "error";
                ?>
                <script>
                    window.history.back();
                </script>
                <?php
            }

        } catch (Exception $exception) {
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
}



