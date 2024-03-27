<?php

namespace App\Http\Controllers;
use TCPDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\estudiante;
use App\Models\docente;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;



class PDFController extends Controller
{
    public function generatePDF($dni_estudiante) {

        // Obtén los datos del estudiante basado en el id

        $estudiante = Estudiante::find($dni_estudiante);

        // Crea una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A6', true, 'UTF-8', false);

        // Añade una página
        $pdf->AddPage();

        //// Configura la fuente y el tamaño del texto
        $pdf->SetFont('helvetica', '', 19);

        // Obtén las dimensiones de la página
        $anchoPagina = $pdf->GetPageWidth();
        $altoPagina = $pdf->GetPageHeight();

        $backgroundImg = 'img/carnetAdelante.jpg'; // Reemplaza con la ruta de tu imagen
        $pdf->Image($backgroundImg, 6, 10, $pdf->getPageWidth(), $pdf->getPageHeight(), '',
            '', '', false, 300, '', false, false, 0, 'C', false, false, false, false);

        // Agrega la imagen del estudiante
        $fotoEstudiante = storage_path('app/' . $estudiante->foto); // Asegúrate de que esta sea la ruta correcta a la imagen
        $pdf->Image($fotoEstudiante, 36, 62, 33, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);


        // Define el texto que quieres escribir
        $texto1 = "{$estudiante->apellidos}";
        $texto2 = "{$estudiante->nombre}";

        // Calcula las coordenadas X e Y para centrar el texto
        $x = ($anchoPagina - $pdf->GetStringWidth($texto1)) / 2;
        $y = 103;

        // Escribe el primer texto centrado
        $pdf->SetXY($x, $y);
        $pdf->Write(0, $texto1);

        // Ajusta la coordenada Y para el segundo texto
        $y += 7;

        // Calcula la nueva coordenada X para el segundo texto
        $x = ($anchoPagina - $pdf->GetStringWidth($texto2)) / 2;

        // Escribe el segundo texto centrado
        $pdf->SetXY($x, $y);
        $pdf->Write(0, $texto2);



        $pdf->AddPage();

        //// Configura la fuente y el tamaño del texto
        $pdf->SetFont('helvetica', '', 10);

        $backgroundImg = 'img/carnetAtras.jpg'; // Reemplaza con la ruta de tu imagen
        $pdf->Image($backgroundImg, 6, 10, $pdf->getPageWidth(), $pdf->getPageHeight(), '',
            '', '', false, 300, '', false, false, 0, 'C', false, false, false, false);

        // Define las coordenadas X e Y
        $x = 30;
        $y = 24;

        // Define el contenido del PDF


        // Mueve la posición Y hacia abajo 10 unidades
        $pdf->SetXY($x, $y);
        $pdf->Write(0, "{$estudiante->dni_estudiante}");

        $y += 8;
        $x +=8;
        $pdf->SetXY($x, $y);
        $pdf->Write(0, "{$estudiante->nombre}");

        $y += 7;
        $pdf->SetXY($x, $y);
        $pdf->Write(0, "{$estudiante->apellidos}");

        $y += 7; // Mueve la posición Y hacia abajo 10 unidades
        $pdf->SetXY($x, $y);
        $pdf->Write(0, "{$estudiante->carrera->nombre_carrera}");

        $y += 7; // Mueve la posición Y hacia abajo 10 unidades
        $pdf->SetXY($x, $y);
        $pdf->Write(0, "{$estudiante -> ciclo -> nombre_ciclo}");

        $y += 8; // Mueve la posición Y hacia abajo 10 unidades
        $x += 25;
        $pdf->SetXY($x, $y);
        $pdf->Write(0, "{$estudiante-> celular_apoderado}");


        // Genera el código QR
        $qrContent = $estudiante->dni_estudiante; // Reemplaza con la URL de tu visor de PDF
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($qrContent)
            ->encoding(new Encoding('UTF-8'))
            ->build();

        // Guarda el código QR como archivo PNG
        $qrCodePath = 'D:\xammp\htdocs\academia_laravel\public\img/qr_estudiante.png';
        $qrCode->saveToFile($qrCodePath);

        // Agrega el código QR al PDF
        $pdf->Image($qrCodePath, 70, 28, 25, 25, 'PNG','');

        // Cierra y genera el PDF
        $pdf->Output('estudiante.pdf', 'I');

    }

}
