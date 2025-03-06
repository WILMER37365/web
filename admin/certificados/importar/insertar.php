<?php
include('../../../app/config.php');

// Función para convertir el número de serie de Excel a una fecha en formato yyyy-mm-dd
function convertirFechaExcelPHP($numeroserie) {
    $fechaOrigen = new DateTime("1899-12-30");
    $fechaOrigen->modify("+{$numeroserie} days");
    return $fechaOrigen->format('Y-m-d');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se recibieron datos
    if (isset($_POST['datos']) && is_array($_POST['datos'])) {
        $datos = $_POST['datos'];
        try {
            $pdo->beginTransaction();
            $insert_success = true; // Control de inserción

            foreach ($datos as $dato) {
                $nombre_cert = $dato[0];
                $composicion_cert = $dato[1];
                $id_forma = $dato[2];
                $id_medalla = $dato[3];
                $fecha_emision = convertirFechaExcelPHP($dato[4]); // Convertir la fecha
                $fecha_vencimiento = convertirFechaExcelPHP($dato[5]); // Convertir la fecha
                $numero_registro = $dato[6];
                $codigo_liname = $dato[7];
                $ficha_tecnica = $dato[8];
                $usuario_cert = $dato[9];
                $estado_cert = $dato[10];

                $fecha_vencimiento_obj = new DateTime($fecha_vencimiento);
                $fecha_hoy = new DateTime();
                $dias_restantes = $fecha_vencimiento_obj->diff($fecha_hoy)->days;

                if ($fecha_vencimiento_obj > $fecha_hoy) {
                    if ($dias_restantes > 20) {
                        $vigencia = 1; // Vigente
                    } elseif ($dias_restantes <= 20 && $dias_restantes > 0) {
                        $vigencia = 3; // Próximo a Vencer
                    }
                } else {
                    $vigencia = 2; // Vencido
                }

                // Insertar los datos
                $sentencia = $pdo->prepare("INSERT INTO certificados 
                    (producto, composicion, forma_id, medalla_id, fecha_emision, fecha_vencimiento, vigencia, 
                    numero_registro_sanitario, codigo_liname, ficha_tecnica, usuario_cert, estado_cert, fyh_creacion_certificado) 
                    VALUES (:producto, :composicion, :forma_id, :medalla_id, :fecha_emision, :fecha_vencimiento, :vigencia, 
                    :numero_registro_sanitario, :codigo_liname, :ficha_tecnica, :usuario_cert, :estado_cert, :fyh_creacion_certificado)");

                $sentencia->bindParam('producto', $nombre_cert);
                $sentencia->bindParam('composicion', $composicion_cert);
                $sentencia->bindParam('forma_id', $id_forma);
                $sentencia->bindParam('medalla_id', $id_medalla);
                $sentencia->bindParam('fecha_emision', $fecha_emision);
                $sentencia->bindParam('fecha_vencimiento', $fecha_vencimiento);
                $sentencia->bindParam('vigencia', $vigencia);
                $sentencia->bindParam('numero_registro_sanitario', $numero_registro);
                $sentencia->bindParam('codigo_liname', $codigo_liname);
                $sentencia->bindParam('ficha_tecnica', $ficha_tecnica);
                $sentencia->bindParam('usuario_cert', $usuario_cert);
                $sentencia->bindParam('estado_cert', $estado_cert);
                $sentencia->bindParam('fyh_creacion_certificado', $fechaHora);

                if (!$sentencia->execute()) {
                    $insert_success = false;
                    $errorInfo = $sentencia->errorInfo();
                    if ($errorInfo[1] == 1062) { // Error de clave duplicada
                        echo "Error inesperado: Registro duplicado encontrado para el número de registro sanitario: " . $numero_registro . ". Continuando con el siguiente registro.\n";
                        continue; // Continuar con el siguiente registro
                    }
                    break; // Detener el proceso si ocurre otro tipo de error
                }
            }

            if ($insert_success) {
                $pdo->commit();
                ?>
                <br>
                <?php
                echo "<span style='color: green;'><i class='fa-solid fa-circle-check ' style='font-size: 30px'></i>Todos los registros fueron insertados correctamente, Presiona en -Volver a la Tabla-</span><br>";
            } else {
                $pdo->rollBack();
                ?>
                <br>
                <?php
                echo "<span style='color: red;'><i class='fa-solid fa-circle-exclamation' style='font-size: 30px'></i>Hubo un error al insertar los datos.</span><br>";
            }

        } catch (Exception $e) {
            // En caso de que ocurra algún error inesperado, se hace rollback
            $pdo->rollBack();
            ?>
            <br>
            <?php
            echo "<span style='color: red;'><i class='fa-solid fa-circle-exclamation' style='font-size: 30px'></i>Error inesperado: COMUNICARSE CON EL AREA DE SISTEMAS</span><br>";
        }
    } else {
        ?>
        <br>
        <?php
        echo "<span style='color: red;'><i class='fa-solid fa-circle-xmark' style='font-size: 30px'></i> No se recibieron datos válidos.</span><br>";
    }
}
?>
