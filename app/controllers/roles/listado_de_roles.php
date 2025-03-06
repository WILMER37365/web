<?php


$sql_roles="SELECT * FROM roles WHERE estado_rol= '1' OR estado_rol= '0'  ";
$query_roles=$pdo->prepare($sql_roles);
$query_roles->execute();
$roles=$query_roles->fetchAll(PDO::FETCH_ASSOC);
