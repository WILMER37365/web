<?php

include('../../app/config.php');

include('../../admin/layout/parte1.php');


//AGREGAMOS PARA ENLISTAR LAS FORMAS FARMACEUTICAS
include('../../app/controllers/formasfarmaceuticas/listado_de_formas.php');


//AGREGAMOS PARA ENLISTAR LAS FORMAS FARMACEUTICAS
include('../../app/controllers/medallas/listado_de_medallas.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>CREACIÓN DE UN CERTIFICADO HECHO EN BOLIVIA</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="<?php echo APP_URL; ?>/app/controllers/certificados/create.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <!-- /.NOMBRE DE PRODUCTO -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre de Producto</label>
                                            <input type="text" name="nombre_cert" class="form-control" style="text-transform: uppercase;" required>

                                        </div>
                                    </div>
                                    <!-- /.COMPOSICION DEL PRODUCTO -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Composición de Producto</label>
                                            <input type="text" name="composicion_cert" class="form-control" style="text-transform: uppercase;" required>
                                        </div>
                                    </div>

                                    <!-- /.FORMA FARMACEUTICA -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Forma Farmacéutica</label>
                                            <div class="d-flex align-items-center">
                                                <select name="forma_id" id="" class="form-control" required>
                                                    <?php
                                                    foreach ($formas as $forma) { ?>

                                                        <option value="<?php echo $forma['id_forma']; ?>">
                                                            <?php echo $forma['nombre_forma']; ?>
                                                        </option>

                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <a href="<?php echo APP_URL; ?>/admin/formasfarmaceuticas/create.php"
                                                   style="margin-left: 5px" class="btn btn-info"><i
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
                                                    foreach ($medallas as $medalla) { ?>

                                                        <option value="<?php echo $medalla['id_medalla']; ?>">
                                                            <?php echo $medalla['nombre_medalla']; ?>
                                                        </option>

                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <a href="<?php echo APP_URL; ?>/admin/medallas/create.php"
                                                   style="margin-left: 5px" class="btn btn-info"><i
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
                                                    <input type="date" name="fecha_emision"  class="form-control" required>
                                                </div>
                                            </div>

                                            <!-- Fecha de Vencimiento -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Fecha de Vencimiento</label>
                                                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control"  required>
                                                </div>
                                            </div>

                                            <!-- Vigencia -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Vigencia</label>
                                                    <select name="vigencia" id="vigencia" class="form-control" required>
                                                        <option value="1">Vigente</option>
                                                        <option value="2">Vencido</option>
                                                        <option value="3">Próximo a Vencer</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <!-- Número Registro Sanitario -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Número de Registro Sanitario</label>
                                                    <input type="text" name="numero_registro" class="form-control" style="text-transform: uppercase;" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- /.CODIGO LINAME -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Código Liname</label>
                                                    <input type="text" name="codigo_liname" class="form-control" style="text-transform: uppercase;" required>

                                                </div>
                                            </div>
                                            <!-- /.FICHA TECNICA -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Ficha Técnica</label>
                                                    <select name="ficha_tecnica" class="form-control" required>
                                                        <option value="habilitado">HABILITADO</option>
                                                        <option value="deshabilitado">DESHABILITADO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- /.USUARIO -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text"  value="<?php echo $email_sesion_usuario;?>" class="form-control" disabled>
                                                    <input type="text" name="usuario_cert" value="<?php echo $email_sesion_usuario;?>" class="form-control" hidden>
                                                </div>
                                            </div>

                                            <!-- /.ESTADO CERTIFICADO -->
                                            <div class="col-md-3">
                                                <label for="">Estado Certificado</label>
                                                <select name="estado_cert" class="form-control" required>
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>


                                        </div>
                                    </div>

                                    <!-- Columna Documento (4) -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Documento Certificado (Word o PDF)</label>
                                            <input type="file" name="documento_cert" class="form-control" id="file" accept=".pdf,.doc,.docx" >
                                            <br>
                                            <output id="list" style="display: flex; justify-content: center; align-items: center; flex-direction: column;"></output>

                                        </div>
                                    </div>
                                </div>


                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Registrar</button>
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
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        for (var i = 0, f; f = files[i]; i++) {
            var extension = f.name.split('.').pop().toLowerCase();

            // Determina el ícono según la extensión
            let icon = '';
            if (extension === 'pdf') {
                icon = `
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <img class="thumb thumbnail" src="https://cdn-icons-png.flaticon.com/512/337/337946.png" width="100px" title="PDF">
                        <p>Documento PDF</p>
                    </div>`;
            } else if (['doc', 'docx'].includes(extension)) {
                icon = `
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <img class="thumb thumbnail" src="https://cdn-icons-png.flaticon.com/512/337/337932.png" width="100px" title="Word">
                        <p>Documento Word</p>
                    </div>`;
            } else {
                // Ícono de alerta
                icon = `
                    <div style="display: flex; flex-direction: column; align-items: center; color:red;">
                        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828843.png" width="80px" title="Alerta">
                        <p>Archivo no compatible</p>
                    </div>`;
            }

            // Muestra el ícono centrado
            document.getElementById("list").innerHTML = icon;
        }
    }

    document.getElementById('file').addEventListener('change', archivo, false);
</script>


<script>
    document.getElementById("fecha_vencimiento").addEventListener("change", function() {
        var fechaVencimiento = new Date(this.value);
        var fechaHoy = new Date();
        var diasRestantes = (fechaVencimiento - fechaHoy) / (1000 * 3600 * 24); // Convertir la diferencia a días

        var vigenciaSelect = document.getElementById("vigencia");

        if (diasRestantes > 20) {
            vigenciaSelect.value = "1"; // Vigente
        } else if (diasRestantes <= 20 && diasRestantes > 0) {
            vigenciaSelect.value = "3"; // Próximo a Vencer
        } else {
            vigenciaSelect.value = "2"; // Vencido
        }
    });
</script>

