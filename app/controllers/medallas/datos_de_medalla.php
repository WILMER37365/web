<?php
$sql_medallas="SELECT * FROM medallas WHERE (estado_medalla= '1' OR estado_medalla= '0') AND id_medalla='$id_medalla' ";
$query_medallas=$pdo->prepare($sql_medallas);
$query_medallas->execute();
$datos_medallas=$query_medallas->fetchAll(PDO::FETCH_ASSOC);

foreach ($datos_medallas as $datos_medalla) {
    $nombre_medalla=$datos_medalla['nombre_medalla'];
    $estado_medalla=$datos_medalla['estado_medalla'];
}