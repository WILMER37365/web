<?php

include('../../../app/config.php');

//NECESITAMOS EL ID USUARIO
$id_certificado = $_POST['id_certificado'];
//NECESITAMOS EL PERFIL SI ESTAMOS MANDANDO IMAGEN
$documento_usuario = $_POST['documento_cert_usu'];

$producto = $_POST['nombre_cert'];
$producto=mb_strtoupper($producto,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS
$composicion = $_POST['composicion_cert'];
$composicion=mb_strtoupper($composicion,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS
$forma_id = $_POST['forma_id'];
$medalla_id = $_POST['medalla_id'];
$fecha_emision = $_POST['fecha_emision'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$vigencia = $_POST['vigencia'];
$numero_registro_sanitario = $_POST['numero_registro'];
$numero_registro_sanitario=mb_strtoupper($numero_registro_sanitario,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS
$codigo_liname = $_POST['codigo_liname'];
$codigo_liname=mb_strtoupper($codigo_liname,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS
$ficha_tecnica = $_POST['ficha_tecnica'];
$usuario_cert = $_POST['usuario_cert'];
$estado_cert = $_POST['estado_cert'];



//PARA LAS IMAGENES LO HACMEOS DE LA SIGUIENTE MANERA
if ($_FILES['documento_cert']['name'] != null) {

    //AQUI EN ESTAS DOS LINEAS DE CODIGO ELIMINAMOS LA IMAGEN ANTERIOR PARA QUE NOSE VAYA ALMACENANDO INDEFINIDAMENTE
    $documento_anterior = "../../../public/certificados/" . $documento_usuario;
    unlink($documento_anterior);

    $nombre_del_archivo = date('Y-m-d-H-i-s') . $_FILES["documento_cert"]["name"];
    $location = "../../../public/certificados/" . $nombre_del_archivo;
    move_uploaded_file($_FILES["documento_cert"]["tmp_name"], $location);
    $documento = $nombre_del_archivo;
    //echo "EXISTE UNA IMAGEN";
} else {
    //echo "NO EXISTE UNA IMAGEN";
    if ($documento_usuario==""){

        $documento_default = "../../../public/certificado_default/vacio.pdf";

        $nombre_del_archivo = date('Y-m-d-H-i-s') . "-" . basename($documento_default);
        $location = "../../../public/certificados/" . $nombre_del_archivo;
        copy($documento_default, $location);
        $documento = $nombre_del_archivo;
    }else{
        $documento=$_POST['documento_cert_usu'];
    }


}


if ($producto=="" OR $composicion=="" OR $forma_id=="" OR $medalla_id=="" OR $fecha_emision=="" OR $fecha_vencimiento==""
    OR $vigencia=="" OR $numero_registro_sanitario=="" OR $codigo_liname=="" OR $ficha_tecnica=="" OR $usuario_cert=="" OR $estado_cert=="" OR $documento==""  ) {
    session_start();
    $_SESSION['mensaje']="LLENE LOS CAMPOS, NO SE ADMITEN VACIOS";
    $_SESSION['icono']="error";
    ?>
    <script>
        window.history.back();
    </script>
    <?php


}

else{

        $sentencia = $pdo->prepare("UPDATE  certificados
        SET producto=:producto,
            composicion=:composicion,
            forma_id=:forma_id,
            medalla_id=:medalla_id,
            fecha_emision=:fecha_emision,
            fecha_vencimiento=:fecha_vencimiento,
            vigencia=:vigencia,
            documento=:documento,
            numero_registro_sanitario=:numero_registro_sanitario,
            codigo_liname=:codigo_liname,
            ficha_tecnica=:ficha_tecnica,
            usuario_cert=:usuario_cert,
            estado_cert=:estado_cert,
            fyh_actualizacion_certificado=:fyh_actualizacion_certificado
        WHERE id_certificado=:id_certificado");

        $sentencia->bindParam('producto', $producto);
        $sentencia->bindParam('composicion', $composicion);
        $sentencia->bindParam('forma_id', $forma_id);
        $sentencia->bindParam('medalla_id', $medalla_id);
        $sentencia->bindParam('fecha_emision', $fecha_emision);
        $sentencia->bindParam('fecha_vencimiento', $fecha_vencimiento);
        $sentencia->bindParam('vigencia', $vigencia);
        $sentencia->bindParam('documento', $documento);
        $sentencia->bindParam('numero_registro_sanitario', $numero_registro_sanitario);
        $sentencia->bindParam('codigo_liname', $codigo_liname);
        $sentencia->bindParam('ficha_tecnica', $ficha_tecnica);
        $sentencia->bindParam('usuario_cert', $usuario_cert);
        $sentencia->bindParam('estado_cert', $estado_cert);
        $sentencia->bindParam('fyh_actualizacion_certificado', $fechaHora);
        $sentencia->bindParam('id_certificado', $id_certificado);

        try {
            if ($sentencia->execute()) {
                session_start();
                $_SESSION['mensaje'] = "EL CERTIFICADO SE ACTUALIZO DE FORMA SATISFACTORIA EN LA BASE DE DATOS";
                $_SESSION['icono'] = "success";
                header("location:" . APP_URL . "/admin/certificados");
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
            $_SESSION['mensaje']="EL REGISTRO SANITARIO O CODIGO LINAME YA EXISTE EN AL BASE DE DATOS";
            $_SESSION['icono'] = "error";
            ?>
            <script>
                window.history.back();
            </script>
            <?php
        }

}



