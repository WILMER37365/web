<?php

$sql_permisos="SELECT * FROM permisos WHERE estado_permiso= '1' OR estado_permiso= '0' ORDER BY nombre_url ASC ";

$query_permisos=$pdo->prepare($sql_permisos);
$query_permisos->execute();
$permisos=$query_permisos->fetchAll(PDO::FETCH_ASSOC);
