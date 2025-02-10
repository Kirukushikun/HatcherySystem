<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Laravel 11 PDF Example',
            'date' => date('m/d/Y'),
            'content' => 'This is a sample PDF generated using Laravel 11 and domPDF.',
        ];

        $pdf = Pdf::loadView('pdf.egg-temperature-pdf', $data);
        return $pdf->download('egg-temperature-record.pdf'); // Or use stream() to preview in browser
    }
}
