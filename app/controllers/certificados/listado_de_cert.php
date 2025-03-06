<?php


$sql_cert = "SELECT c.*, m.*, f.* 
             FROM certificados AS c
             INNER JOIN medallas AS m ON m.id_medalla=c.medalla_id
             INNER JOIN formasfarmaceuticas AS f ON f.id_forma=c.forma_id
             WHERE c.estado_cert = '1' OR c.estado_cert = '0'
            ORDER BY c.id_certificado ASC";

$query_cert = $pdo->prepare($sql_cert);
$query_cert->execute();
$certificados = $query_cert->fetchAll(PDO::FETCH_ASSOC);
