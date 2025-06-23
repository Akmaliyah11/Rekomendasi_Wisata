<?php

namespace App\Helpers;

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF
{
    public static function generate($view, $data = [], $filename = 'document.pdf', $paper = 'a4', $orientation = 'portrait', $stream = true)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('isPhpEnabled', true);
        
        $dompdf = new Dompdf($options);
        $html = view($view, $data)->render();
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        
        if ($stream) {
            return $dompdf->stream($filename);
        } else {
            return $dompdf->output();
        }
    }
}
