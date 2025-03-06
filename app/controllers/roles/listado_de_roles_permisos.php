<?php
$sql_roles_permisos="SELECT * FROM roles_permisos as rolper
         INNER JOIN permisos as per ON per.id_permiso = rolper.permiso_id
         INNER JOIN roles as rol ON rol.id_rol = rolper.rol_id
        WHERE rolper.estado_roles_permiso= '1'  ORDER BY per.id_permiso ASC ";

$query_roles_permisos=$pdo->prepare($sql_roles_permisos);
$query_roles_permisos->execute();
$roles_permisos=$query_roles_permisos->fetchAll(PDO::FETCH_ASSOC);