<?php
$sql_formas="SELECT * FROM formasfarmaceuticas WHERE (estado_forma= '1' OR estado_forma= '0') AND id_forma='$id_forma' ";
$query_formas=$pdo->prepare($sql_formas);
$query_formas->execute();
$datos_formas=$query_formas->fetchAll(PDO::FETCH_ASSOC);

foreach ($datos_formas as $datos_forma) {
    $nombre_forma=$datos_forma['nombre_forma'];
    $estado_forma=$datos_forma['estado_forma'];
}