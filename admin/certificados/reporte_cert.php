<?php
$nobmre_usuario = $_POST['nombre_usuario'];
$fecha_hora = $_POST['fecha_hora'];
include ('../../app/config.php');

include('../../app/controllers/certificados/listado_de_cert.php');
require_once('../../public/tcp_pdf/tcpdf.php');

// Crear nuevo documento PDF con tamaño de página A3 (doble A4)
$pdf = new TCPDF('L', PDF_UNIT, 'A3', true, 'UTF-8', false); // A3 es doble A4

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
$pdf->Ln(5); // Salto de línea de 5mm (ajustar según lo necesites)

// Escribir el título
$pdf->Write(0, 'INFORME GENERADO DE FORMAS FARMACÉUTICAS', '', 0, 'C', true, 0, false, false, 0);

// Agregar espacio después del título
$pdf->Ln(5); // Salto de línea de 5mm (ajustar según lo necesites)

// Establecer fuente para la tabla (si deseas cambiarla)
$pdf->SetFont('helvetica', '', 10);

// Estilos de celdas para ajustar el texto y evitar corte
$html = '<table border="1" cellpadding="4" style="width: 100%;">'; // Esto hace que las columnas se ajusten al 100% del ancho
$html .= '<tr>
                <th align="C">Id Certificado</th>
                <th align="C">Producto</th>
                <th align="C">Composición</th>
                <th align="C">Forma</th>
                <th align="C">Medalla</th>
                <th align="C">Fecha Emisión</th>
                <th align="C">Fecha Vencimiento</th>
                <th align="C">Vigencia</th>
                <th align="C">Documento</th>
                <th align="C">N° Registro Sanitario</th>
                <th align="C">Codigo Liname</th>
                <th align="C">Ficha Técnica</th>
                <th align="C">Usuario Responsable</th>
                <th align="C">Estado Certificado</th>
                <th align="C">Fecha Hora de Creación</th>
                <th align="C">Fecha Hora de Actualización</th>
            </tr>';

// Iterar sobre las formas farmacéuticas obtenidas de la base de datos
foreach ($certificados as $certificado) {
    $html .= '<tr>';
    $html .= '<td align="C">' . $certificado['id_certificado'] . '</td>';
    $html .= '<td align="L">' . $certificado['producto'] . '</td>';
    $html .= '<td align="L">' . $certificado['composicion'] . '</td>';
    $html .= '<td align="C">' . $certificado['forma_id'] . '</td>';
    $html .= '<td align="C">' . $certificado['medalla_id'] . '</td>';
    $html .= '<td align="C">' . $certificado['fecha_emision'] . '</td>';
    $html .= '<td align="C">' . $certificado['fecha_vencimiento'] . '</td>';
    $html .= '<td align="C">' . $certificado['vigencia'] . '</td>';
    $html .= '<td align="L">' . $certificado['documento'] . '</td>';
    $html .= '<td align="C">' . $certificado['numero_registro_sanitario'] . '</td>';
    $html .= '<td align="C">' . $certificado['codigo_liname'] . '</td>';
    $html .= '<td align="L">' . $certificado['ficha_tecnica'] . '</td>';
    $html .= '<td align="L">' . $certificado['usuario_cert'] . '</td>';
    $html .= '<td align="C">' . $certificado['estado_cert'] . '</td>';
    $html .= '<td align="C">' . $certificado['fyh_creacion_certificado'] . '</td>';
    $html .= '<td align="C">' . $certificado['fyh_actualizacion_certificado'] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

// Escribir el contenido en el PDF
$pdf->writeHTML($html, true, false, false, false, '');

// Cerrar y mostrar el PDF
$pdf->Output('listado_formas_farmaceuticas.pdf', 'D');
?>
