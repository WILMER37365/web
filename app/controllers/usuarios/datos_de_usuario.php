<?php
$sql_usuarios="SELECT * FROM usuarios as usu INNER JOIN roles as rol
         ON rol.id_rol=usu.rol_id WHERE (usu.estado= '1' OR usu.estado= '0') AND usu.id_usuario='$id_usuario' ";
$query_usuarios=$pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios=$query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $nombres = $usuario['nombres'];
    $apellidos = $usuario['apellidos'];
    $nombre_rol = $usuario['nombre_rol'];
    $email = $usuario['email'];
    $usuar = $usuario['alias'];
    $estado = $usuario['estado'];
    $perfil = $usuario['perfil'];
    $fyh_creacion=$usuario['fyh_creacion'];
    $genero=$usuario['genero'];

}
