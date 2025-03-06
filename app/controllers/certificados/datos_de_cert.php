<?php


$sql_cert = "SELECT c.*, m.*, f.* 
             FROM certificados AS c
             INNER JOIN medallas AS m ON m.id_medalla=c.medalla_id
             INNER JOIN formasfarmaceuticas AS f ON f.id_forma=c.forma_id
             WHERE (c.estado_cert = '1' OR c.estado_cert = '0') AND c.id_certificado='$id_certificado'";


$query_cert=$pdo->prepare($sql_cert);
$query_cert->execute();
$certificados=$query_cert->fetchAll(PDO::FETCH_ASSOC);

foreach ($certificados as $certificado) {
    $producto = $certificado['producto'];
    $composicion = $certificado['composicion'];
    $nombre_forma = $certificado['nombre_forma'];
    $nombre_medalla  = $certificado['nombre_medalla'];
    $fecha_emision = $certificado['fecha_emision'];
    $fecha_vencimiento = $certificado['fecha_vencimiento'];
    $vigencia = $certificado['vigencia'];
    $documento = $certificado['documento'];
    $numero_registro_sanitario  = $certificado['numero_registro_sanitario'];
    $codigo_liname = $certificado['codigo_liname'];
    $ficha_tecnica = $certificado['ficha_tecnica'];
    $usuario_cert = $certificado['usuario_cert'];
    $estado_cert = $certificado['estado_cert'];

}