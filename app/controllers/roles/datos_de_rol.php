<?php
$sql_roles="SELECT * FROM roles WHERE (estado_rol= '1' OR estado_rol= '0') AND id_rol='$id_rol' ";
$query_roles=$pdo->prepare($sql_roles);
$query_roles->execute();
$datos_roles=$query_roles->fetchAll(PDO::FETCH_ASSOC);

foreach ($datos_roles as $datos_role) {
    $nombre_rol=$datos_role['nombre_rol'];
    $estado_rol=$datos_role['estado_rol'];
}