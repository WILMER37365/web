<?php

include('../../../app/config.php');

include('../../../admin/layout/parte1.php');

//INCLUIMOS PARA OBTENER LOS DATOS DE LA TABLA ROLES EL SIGUIENTE CONTROLADOR
include('../../../app/controllers/certificados/listado_de_cert.php');


?>
<!-- PARA LA PARTE DE IMPORTACION MASIVA -->
<script src="xlsx.js"></script>
<script src="jquery-1.9.1.js"></script>
<script language="JavaScript">
    var oFileIn;
    //Código JQuery
    $(function () {
        oFileIn = document.getElementById('my_file_input');
        if (oFileIn.addEventListener) {
            oFileIn.addEventListener('change', filePicked, false);
        }
    });

    //Método que hace el proceso de importar excel a html
    function filePicked(oEvent) {
        // Obtener el archivo del input
        $("#my_file_output").html("");
        var oFile = oEvent.target.files[0];
        var sFilename = oFile.name;
        // Crear un Archivo de Lectura HTML5
        var reader = new FileReader();

        // Leyendo los eventos cuando el archivo ha sido seleccionado
        reader.onload = function (e) {
            var data = e.target.result;
            var cfb = XLS.CFB.read(data, {
                type: 'binary'
            });
            var wb = XLS.parse_xlscfb(cfb);
            // Iterando sobre cada sheet
            wb.SheetNames.forEach(function (sheetName) {
                // Obtener la fila actual como CSV
                var sCSV = XLS.utils.make_csv(wb.Sheets[sheetName]);
                var data = XLS.utils.sheet_to_json(wb.Sheets[sheetName], {
                    header: 1
                });
                $.each(data, function (indexR, valueR) {
                    var sRow = "<tr>";
                    $.each(data[indexR], function (indexC, valueC) {
                        sRow = sRow + "<td>" + valueC + "</td>";
                    });
                    sRow = sRow + "</tr>";
                    $("#my_file_output").append(sRow);
                });
            });
            $("#imgImport").css("display", "none");
        };


// Llamar al JS Para empezar a leer el archivo .. Se podría retrasar esto si se desea
        reader.readAsBinaryString(oFile);
    }
</script>
<!-- FIN PARA LA PARTE DE IMPORTACION MASIVA -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <h1>IMPORTAR CERTIFICADOS</h1>

            </div>
            <!-- /.row -->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos de los Certificados</h3>

                            <div class="card-tools">
                                <a href="PLANTILLA_PARA_IMPORTAR_CERTIFICADOS_A.xls" class="btn btn-info "><i class="fa-solid fa-file-arrow-down fa-2x"></i>
                                    Descargar Plantilla</a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <input type="file" id="my_file_input" class="form-control"  accept=".xls, .xlsx"/>

                            <br>
                            <div class="table table-responsive">
                                <table id='my_file_output' border=""
                                       class="table table-bordered table-condensed table-striped"></table>
                            </div>
                            <button id="btn_lectura" class="btn btn-info">Registrar Certificados</button>
                            <a href="<?php echo APP_URL;?>/admin/certificados/" class="btn btn-default ">Volver a la Tabla</a>
                            <a href="<?php echo APP_URL;?>/admin/certificados/importar" class="btn btn-default ">Iniciar Nuevamente</a>

                            <p id="respuesta">

                            </p>
                            <p id="contador">

                            </p>
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
<script>
    var emailSesionUsuario = "<?php echo $email_sesion_usuario; ?>";
    $('#btn_lectura').click(function () {
        valores = [];
        var contador = 0;
        $('#my_file_output tr').each(function () {

            var d1 = $(this).find('td').eq(0).html();
            var d2 = $(this).find('td').eq(1).html();
            var d3 = $(this).find('td').eq(2).html();
            var d4 = $(this).find('td').eq(3).html();
            var d5 = $(this).find('td').eq(4).html();
            var d6 = $(this).find('td').eq(5).html();
            var d7 = $(this).find('td').eq(6).html();
            var d8 = $(this).find('td').eq(7).html();
            var d9 = $(this).find('td').eq(8).html();
            var d10 = $(this).find('td').eq(9).html();
            var d11 = $(this).find('td').eq(10).html();

            if (d1 && d2 && d3 && d4 && d5 && d6 && d7 && d8 && d9 && d10 && d11) {
                valor = new Array(d1, d2, d3, d4, d5, d6, d7, d8, d9, emailSesionUsuario, d11);
                valores.push(valor);
            } else {
                console.log("Datos faltantes en una fila.");
            }
        });

        // Enviar todos los datos juntos en un solo POST
        $.post('insertar.php', { datos: valores }, function (response) {
            $('#respuesta').html(response);
            //contador = valores.length; // Asumiendo que todos los datos fueron procesados
            //$('#contador').html("Se registraron " + contador + " registros correctamente.");
        });
    });

</script>
<?php
include('../../../admin/layout/parte2.php');
include('../../../layout/mensajes.php');
?>
