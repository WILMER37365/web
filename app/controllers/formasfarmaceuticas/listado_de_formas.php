<?php


$sql_forma="SELECT * FROM formasfarmaceuticas WHERE estado_forma= '1' OR estado_forma= '0'  ";
$query_formas=$pdo->prepare($sql_forma);
$query_formas->execute();
$formas=$query_formas->fetchAll(PDO::FETCH_ASSOC);
