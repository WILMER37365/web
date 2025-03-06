<?php
$nobmre_usuario=$_POST['nombre_usuario'];
$fecha_hora=$_POST['fecha_hora'];
include ('../../app/config.php');
include('../../app/controllers/formasfarmaceuticas/listado_de_formas.php');
require_once('../../public/tcp_pdf/tcpdf.php');

// Crear nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Listado de Formas Farmacéuticas');
$pdf->SetSubject('Listado de Formas Farmacéuticas');
$pdf->SetKeywords('TCPDF, PDF, ejemplo, test, listado, formas farmacéuticas');

// Establecer datos del encabezado
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Listado de Formas Farmacéuticas', 'Generado por: '.$nobmre_usuario.' | Fecha y Hora: '.$fecha_hora);

// Establecer fuentes
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Establecer márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Establecer saltos automáticos
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Escalar imágenes
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Añadir una página
$pdf->AddPage();

// Establecer fuente para el título (más grande)
$pdf->SetFont('helvetica', 'B', 18); // Fuente negrita y tamaño 18

// Agregar espacio antes del título
$pdf->Ln(5); // Salto de línea de 10mm (ajustar según lo necesites)

// Escribir el título
$pdf->Write(0, 'INFORME GENERADO DE FORMAS FARMACÉUTICAS', '', 0, 'C', true, 0, false, false, 0);

// Agregar espacio después del título
$pdf->Ln(5); // Salto de línea de 10mm (ajustar según lo necesites)

// Establecer fuente para la tabla (si deseas cambiarla)
$pdf->SetFont('helvetica', '', 10);

// Encabezados de la tabla
$html = '<table border="1" cellpadding="4">
            <tr>
                <th>Id Forma</th>
                <th>Nombre</th>
                <th>Fecha Creación</th>
                <th>Fecha Actualización</th>
                <th>Estado</th>
            </tr>';

// Iterar sobre las formas farmacéuticas obtenidas de la base de datos
foreach ($formas as $forma) {
    $html .= '<tr>
                <td>' . $forma['id_forma'] . '</td>
                <td>' . $forma['nombre_forma'] . '</td>
                <td>' . $forma['fyh_creacion_forma'] . '</td>
                <td>' . $forma['fyh_actualizacion_forma'] . '</td>
                <td>' . $forma['estado_forma'] . '</td>
              </tr>';
}

$html .= '</table>';

// Escribir el contenido en el PDF
$pdf->writeHTML($html, true, false, false, false, '');

// Cerrar y mostrar el PDF
$pdf->Output('listado_formas_farmaceuticas.pdf', 'D');
?>
