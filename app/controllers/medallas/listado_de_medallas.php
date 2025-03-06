<?php


$sql_medallas="SELECT * FROM medallas WHERE estado_medalla= '1' OR estado_medalla= '0'  ";
$query_medallas=$pdo->prepare($sql_medallas);
$query_medallas->execute();
$medallas=$query_medallas->fetchAll(PDO::FETCH_ASSOC);
