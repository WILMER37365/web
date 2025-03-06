<?php

include ('../../../app/config.php');
$nombre_cert=$_POST['nombre_cert'];//RECIBIMOS EL INPUT DE NOMBRE CERTIFICADO
$nombre_cert=mb_strtoupper($nombre_cert,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$composicion_cert=$_POST['composicion_cert'];//RECIBIMOS EL INPUT DE COMPOSICION DEL CERTIFICADO
$composicion_cert=mb_strtoupper($composicion_cert,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$id_forma=$_POST['forma_id'];//RECIBIMOS EL INPUT FORMA FARMACEUTICA

$id_medalla=$_POST['medalla_id'];//RECIBIMOS EL INPUT FORMA FARMACEUTICA

$fecha_emision=$_POST['fecha_emision'];//RECIBIMOS EL INPUT FECHA DE EMISION

$fecha_vencimiento=$_POST['fecha_vencimiento'];//RECIBIMOS EL INPUT FECHA VENCIMIENTO

$vigencia=$_POST['vigencia'];//RECIBIMOS EL INPUT VIGENCIA

$numero_registro=$_POST['numero_registro'];//RECIBIMOS EL INPUT NUMERO DE REGISTRO SANITARIO
$numero_registro=mb_strtoupper($numero_registro,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$codigo_liname=$_POST['codigo_liname'];//RECIBIMOS EL INPUT NUMERO DE CODIGO LINAME
$codigo_liname=mb_strtoupper($codigo_liname,'UTF-8');//LO CONVERTIMOS NE MAYUSCULA PARA QUE SE GUARDE NE LA BASE DE DATOS

$ficha_tecnica=$_POST['ficha_tecnica'];//RECIBIMOS EL INPUT NUMERO DE FICHA TECNICA

$usuario_cert=$_POST['usuario_cert'];//RECIBIMOS EL INPUT USUARIO

$estado_cert=$_POST['estado_cert'];//RECIBIMOS EL INPUT ESTADO CERTIFICADO


//PARA LOS DOCUMENTOS PDF
if (($_FILES['documento_cert']['name'] != null)) {
    $nombre_del_certificado=date('Y-m-d-H-i-s').$_FILES["documento_cert"]["name"];
    $location="../../../public/certificados/".$nombre_del_certificado;
    move_uploaded_file($_FILES["documento_cert"]["tmp_name"], $location);
    $certificado=$nombre_del_certificado;
}else{

    $documento_default = "../../../public/certificado_default/vacio.pdf";


    $nombre_del_documento = date('Y-m-d-H-i-s') . "-" . basename($documento_default);
    $location = "../../../public/certificados/" . $nombre_del_documento;
    copy($documento_default, $location);
    $certificado=$nombre_del_documento;
}



if ($nombre_cert=="" OR $composicion_cert=="" OR $id_forma=="" OR $id_medalla=="" OR $fecha_emision=="" OR $fecha_vencimiento==""
    OR $vigencia=="" OR $numero_registro=="" OR $codigo_liname=="" OR $ficha_tecnica=="" OR $usuario_cert=="" OR $estado_cert=="" OR $certificado=="") {
    session_start();
    $_SESSION['mensaje']="LLENE LOS CAMPOS, NO SE ADMITEN VACIOS";
    $_SESSION['icono']="error";
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}else{
    $sentencia=$pdo->prepare("INSERT INTO certificados 
        (producto,composicion,forma_id,medalla_id,fecha_emision,fecha_vencimiento,vigencia,
         documento,numero_registro_sanitario,codigo_liname,ficha_tecnica,usuario_cert,estado_cert,fyh_creacion_certificado) 
VALUES (:producto,:composicion,:forma_id,:medalla_id,:fecha_emision,:fecha_vencimiento,:vigencia,
        :documento,:numero_registro_sanitario,:codigo_liname,:ficha_tecnica,:usuario_cert,:estado_cert,:fyh_creacion_certificado)");

    $sentencia->bindParam('producto',$nombre_cert);
    $sentencia->bindParam('composicion',$composicion_cert);
    $sentencia->bindParam('forma_id',$id_forma);
    $sentencia->bindParam('medalla_id',$id_medalla);
    $sentencia->bindParam('fecha_emision',$fecha_emision);
    $sentencia->bindParam('fecha_vencimiento',$fecha_vencimiento);
    $sentencia->bindParam('vigencia',$vigencia);
    $sentencia->bindParam('documento',$certificado);
    $sentencia->bindParam('numero_registro_sanitario',$numero_registro);
    $sentencia->bindParam('codigo_liname',$codigo_liname);
    $sentencia->bindParam('ficha_tecnica',$ficha_tecnica);
    $sentencia->bindParam('usuario_cert',$usuario_cert);
    $sentencia->bindParam('estado_cert',$estado_cert);
    $sentencia->bindParam('fyh_creacion_certificado',$fechaHora);

    try {
        if ($sentencia->execute()){
            //echo "Se registro los datos de la manera correcta";
            session_start();
            $_SESSION['mensaje']="SE REGISTRO EL CERTIFICADO DE LA MANERA CORRECTA";
            $_SESSION['icono']="success";
            header("location:".APP_URL."/admin/certificados");
        }else{
            //echo "Nose pudo registrar ala base de datos, comuniquese con el adminsitrador";
            session_start();
            $_SESSION['mensaje']="ERROR NO SE PUDO REGISTRAR EN LA BASE DE DATOS, COMUNIQUESE CON EL ADMINISTRADOR";
            $_SESSION['icono']="error";
            //header("location:".APP_URL."/admin/certificados/create.php");
            ?>
            <script>
                window.history.back();
            </script>
            <?php
        }
    }catch (Exception $exception){
        session_start();
        $_SESSION['mensaje']="EL REGISTRO SANITARIO O CODIGO LINAME YA EXISTE EN AL BASE DE DATOS";
        $_SESSION['icono']="error";
        //header("location:".APP_URL."/admin/certificados/create.php");
        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }

}


