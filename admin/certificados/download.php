<?php
//RECIBIMOS POR LE METODO GET EL ID DEL USUARIO
$id_certificado = $_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');


//AGREGAMOS PARA DATO DEL CERTIFICADO
include('../../app/controllers/certificados/datos_de_cert.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>DESCARGAR PRODUCTO: <?php echo $producto; ?></h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Registrados</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <div class="row">
                                <!-- /.NOMBRE DE PRODUCTO -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombre de Producto</label>
                                        <input type="text" name="nombre_cert" value="<?php echo $producto; ?>"
                                               class="form-control" required disabled>

                                    </div>
                                </div>
                                <!-- /.COMPOSICION DEL PRODUCTO -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Composición de Producto</label>
                                        <input type="text" name="composicion_cert" value="<?php echo $composicion; ?>"
                                               class="form-control" required disabled>
                                    </div>
                                </div>

                                <!-- /.FORMA FARMACEUTICA -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Forma Farmacéutica</label>
                                        <div class="d-flex align-items-center">


                                            <select name="forma_id" id="" class="form-control" required disabled>
                                                <option value="<?php echo $nombre_forma; ?>">
                                                    <?php echo $nombre_forma; ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <!-- /.MEDALLA -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Medalla</label>
                                        <div class="d-flex align-items-center">

                                            <select name="medalla_id" id="" class="form-control" required disabled>
                                                <option value="<?php echo $nombre_medalla; ?>">
                                                    <?php echo $nombre_medalla; ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <!-- Columna Principal (8) -->
                                <div class="col-md-8">
                                    <div class="row">
                                        <!-- Fecha de Emisión -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha de Emisión</label>
                                                <input type="date" name="fecha_emision" value="<?php echo $fecha_emision;?>" class="form-control" required disabled>
                                            </div>
                                        </div>

                                        <!-- Fecha de Vencimiento -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha de Vencimiento</label>
                                                <input type="date" name="fecha_vencimiento" value="<?php echo $fecha_vencimiento;?>" class="form-control"
                                                       required disabled>
                                            </div>
                                        </div>

                                        <!-- Vigencia -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Vigencia</label>
                                                <select name="vigencia" class="form-control"  disabled>

                                                    <option value="1" <?php if ( $vigencia == '1') echo 'selected'; ?>>Vigente</option>
                                                    <option value="2" <?php if ( $vigencia == '2') echo 'selected'; ?>>Proximo a Vencer</option>
                                                    <option value="3" <?php if ( $vigencia == '3') echo 'selected'; ?>>Vencido</option>
                                                </select>

                                            </div>
                                        </div>

                                        <!-- Número Registro Sanitario -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Número de Registro Sanitario</label>
                                                <input type="text" name="numero_registro" value="<?php echo $numero_registro_sanitario;?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- /.CODIGO LINAME -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Código Liname</label>
                                                <input type="text" name="codigo_liname" value="<?php echo $codigo_liname;?>" class="form-control" disabled>

                                            </div>
                                        </div>
                                        <!-- /.FICHA TECNICA -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Ficha Técnica</label>

                                                <select name="ficha_tecnica" class="form-control"  disabled>

                                                    <option value="habilitado" <?php if ( $ficha_tecnica == "habilitado") echo 'selected'; ?>>Habilitado</option>
                                                    <option value="deshabilitado" <?php if ( $ficha_tecnica == "deshabilitado") echo 'selected'; ?>>Deshabilitado</option>

                                                </select>
                                            </div>
                                        </div>

                                        <!-- /.USUARIO -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" value="<?php echo $usuario_cert; ?>"
                                                       class="form-control" disabled>
                                            </div>
                                        </div>

                                        <!-- /.ESTADO CERTIFICADO -->
                                        <div class="col-md-3">
                                            <label for="">Estado Certificado</label>


                                            <select name="estado_cert" class="form-control"  disabled>

                                                <option value="1" <?php if ( $estado_cert == '1') echo 'selected'; ?>>Activo</option>
                                                <option value="0" <?php if ( $estado_cert == '0') echo 'selected'; ?>>Inactivo</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>

                                <!-- Columna Documento (4) -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Documento Certificado (Word o PDF)</label>

                                        <input type="text" name="documento_cert" value="<?php echo $documento; ?>" class="form-control" id="file"
                                               accept=".pdf,.doc,.docx" disabled>
                                    </div>
                                    <div id="icon-container"></div>
                                </div>
                            </div>


                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <!-- Botón de Visualizar -->
                                        <?php if (strpos($documento, '.pdf') !== false): ?>
                                            <button type="button" class="btn btn-primary" id="view-btn">Visualizar PDF</button>
                                        <?php endif; ?>


                                        <!-- Botón de Descargar -->
                                        <?php if (strpos($documento, '.pdf') !== false): ?>
                                        <a href="<?php echo APP_URL; ?>/public/certificados/<?php echo $documento; ?>"
                                           class="btn btn-warning" download>Descargar PDF</a>
                                        <?php endif; ?>

                                        <a href="<?php echo APP_URL; ?>/admin/certificados"
                                           class="btn btn-secondary">Volver</a>


                                    </div>


                                </div>
                            </div>







                            <!-- Modal para ver el PDF -->
                            <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pdfModalLabel">Visualizar Documento PDF</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="" id="pdfViewer" width="100%" height="500px" style="border:none;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');
?>

<script>
    // Función para mostrar el icono basado en la extensión del archivo
    function showIcon() {
        var documento = document.getElementById("file").value;
        var iconContainer = document.getElementById("icon-container");

        if (documento) {
            var extension = documento.split('.').pop().toLowerCase(); // Obtiene la extensión del archivo

            let icon = ''; // Variable para almacenar el HTML del icono

            if (extension === 'pdf') {
                icon = `
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="PDF Icon" width="100px">
                        <p>Documento PDF</p>
                    </div>`;
            } else if (['doc', 'docx'].includes(extension)) {
                icon = `
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <img src="https://cdn-icons-png.flaticon.com/512/337/337932.png" alt="Word Icon" width="100px">
                        <p>Documento Word</p>
                    </div>`;
            } else {
                icon = `
                    <div style="display: flex; flex-direction: column; align-items: center; color:red;">
                        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828843.png" width="80px" title="Alerta">
                        <p>Archivo no compatible</p>
                    </div>`;
            }

            // Muestra el ícono centrado
            iconContainer.innerHTML = icon;
        }
    }

    // Llama a la función para mostrar el icono cuando se cargue la página
    window.onload = showIcon;
</script>

<script>
    // Script para visualizar el PDF en el modal
    document.getElementById("view-btn").addEventListener("click", function() {
        var documento = document.getElementById("file").value;

        if (documento) {
            var pdfViewer = document.getElementById("pdfViewer");

            // Cambia el src del iframe al archivo PDF
            pdfViewer.src = "<?php echo APP_URL; ?>/public/certificados/" + documento + "#toolbar=0";


            // Muestra el modal
            $('#pdfModal').modal('show');
        }
    });

</script>