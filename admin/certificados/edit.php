<?php
//RECIBIMOS POR LE METODO GET EL ID DEL USUARIO
$id_certificado=$_GET['id'];
include('../../app/config.php');

include('../../admin/layout/parte1.php');

//AGREGAMOS PARA ENLISTAR LOS CERTIFICADOS
include('../../app/controllers/certificados/datos_de_cert.php');

//AGREGAMOS PARA ENLISTAR LAS FORMAS FARMACEUTICAS
include('../../app/controllers/formasfarmaceuticas/listado_de_formas.php');


//AGREGAMOS PARA ENLISTAR LAS MEDALLAS
include('../../app/controllers/medallas/listado_de_medallas.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>MODIFICAR CERTIFICADO: <?php echo $producto;?></h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="<?php echo APP_URL; ?>/app/controllers/certificados/update.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <!-- /.NOMBRE DE PRODUCTO -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre de Producto</label>
                                            <input type="text" name="id_certificado" value="<?php echo $id_certificado;?>" hidden>
                                            <input type="text" name="nombre_cert" value="<?php echo $producto;?>" class="form-control" style="text-transform: uppercase;" required>

                                        </div>
                                    </div>
                                    <!-- /.COMPOSICION DEL PRODUCTO -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Composición de Producto</label>
                                            <input type="text" name="composicion_cert" value="<?php echo $composicion;?>" class="form-control" style="text-transform: uppercase;" required>
                                        </div>
                                    </div>

                                    <!-- /.FORMA FARMACEUTICA -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Forma Farmacéutica</label>
                                            <div class="d-flex align-items-center">

                                                <select name="forma_id" id="" class="form-control" required>
                                                    <?php
                                                    foreach ($formas as $forma) {
                                                        $nombre_forma_tabla=$forma['nombre_forma'];?>

                                                        <option value="<?php echo $forma['id_forma'];?>"
                                                            <?php if ($nombre_forma== $nombre_forma_tabla){
                                                                ?>
                                                                selected="selected"
                                                                <?php
                                                            }
                                                            ?>
                                                        >
                                                            <?php echo $forma['nombre_forma'];?>
                                                        </option>

                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <a href="<?php echo APP_URL; ?>/admin/formasfarmaceuticas/create.php"
                                                   style="margin-left: 5px" class="btn btn-success"><i
                                                        class="fa-sharp fa-solid fa-flask-vial"></i></a>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- /.MEDALLA -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Medalla</label>
                                            <div class="d-flex align-items-center">


                                                <select name="medalla_id" id="" class="form-control" required>
                                                    <?php
                                                    foreach ($medallas as $medalla) {
                                                        $nombre_medalla_tabla=$medalla['nombre_medalla'];?>

                                                        <option value="<?php echo $medalla['id_medalla'];?>"
                                                            <?php if ($nombre_medalla== $nombre_medalla_tabla){
                                                                ?>
                                                                selected="selected"
                                                                <?php
                                                            }
                                                            ?>
                                                        >
                                                            <?php echo $medalla['nombre_medalla'];?>
                                                        </option>

                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                                <a href="<?php echo APP_URL; ?>/admin/medallas/create.php"
                                                   style="margin-left: 5px" class="btn btn-success"><i
                                                        class="fa-solid fa-medal"></i></a>
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
                                                    <input type="date" name="fecha_emision" value="<?php echo $fecha_emision?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <!-- Fecha de Vencimiento -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Fecha de Vencimiento</label>
                                                    <input type="date" name="fecha_vencimiento" value="<?php echo $fecha_vencimiento?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <!-- Vigencia -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Vigencia</label>

                                                    <select name="vigencia" class="form-control" required>
                                                        <option value="1" <?php if (isset($vigencia) && $vigencia == '1') echo 'selected'; ?>>Vigente</option>
                                                        <option value="2" <?php if (isset($vigencia) && $vigencia == '2') echo 'selected'; ?>>Vencido</option>
                                                        <option value="3" <?php if (isset($vigencia) && $vigencia == '3') echo 'selected'; ?>>Próximo a Vencer</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <!-- Número Registro Sanitario -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Número de Registro Sanitario</label>
                                                    <input type="text" name="numero_registro" value="<?php echo $numero_registro_sanitario?>" class="form-control" style="text-transform: uppercase;" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- /.CODIGO LINAME -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Código Liname</label>
                                                    <input type="text" name="codigo_liname" value="<?php echo $codigo_liname?>" class="form-control" style="text-transform: uppercase;" required>

                                                </div>
                                            </div>
                                            <!-- /.FICHA TECNICA -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Ficha Técnica</label>

                                                    <select name="ficha_tecnica" class="form-control" required>
                                                        <option value="habilitado" <?php if (isset($ficha_tecnica) && $ficha_tecnica == "habilitado") echo 'selected'; ?>>Habilitado</option>
                                                        <option value="deshabilitado" <?php if (isset($ficha_tecnica) && $ficha_tecnica == "deshabilitado") echo 'selected'; ?>>Deshabilitado</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <!-- /.USUARIO -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text"  value="<?php echo $usuario_cert;?>" class="form-control" disabled>
                                                    <input type="text" name="usuario_cert" value="<?php echo $email_sesion_usuario;?>" class="form-control" hidden>
                                                </div>
                                            </div>

                                            <!-- /.ESTADO CERTIFICADO -->
                                            <div class="col-md-3">
                                                <label for="">Estado Certificado</label>


                                                <select name="estado_cert" class="form-control" required>
                                                    <option value="1" <?php if (isset($estado_cert) && $estado_cert == "1") echo 'selected'; ?>>Activo</option>
                                                    <option value="0" <?php if (isset($estado_cert) && $estado_cert == "0") echo 'selected'; ?>>Inactivo</option>

                                                </select>
                                            </div>


                                        </div>
                                    </div>

                                    <!-- Columna Documento (4) -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Documento Certificado (Word o PDF)</label>
                                            <input type="file" name="documento_cert" class="form-control" accept=".pdf,.doc,.docx" >
                                            <br>


                                            <input type="text" name="documento_cert_usu" value="<?php echo $documento;?>" class="form-control" id="file" hidden>
                                            <br>
                                            <center>

                                                <output id="list" style="display: flex; justify-content: center; align-items: center; flex-direction: column;"></output>

                                            </center>


                                        </div>
                                        <div id="icon-container"></div>
                                    </div>



                                </div>


                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?php echo APP_URL; ?>/admin/certificados"
                                               class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
<!-- /.ARCHIVOS PDF Y WORD -->

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
                        <p>Documento PDF Existe</p>
                    </div>`;
            } else if (['doc', 'docx'].includes(extension)) {
                icon = `
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <img src="https://cdn-icons-png.flaticon.com/512/337/337932.png" alt="Word Icon" width="100px">
                        <p>Documento Word Existe</p>
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