<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PDFController extends Controller
{
    public function generatePDF(){
        $data = [
            'title' => 'Laravel 8 PDF Tutorial',
            'date' => date('m/d/Y'),
            'content' => 'this is sample pdf'
        ];
        $pdf = PDF::loadView('pdf.egg-collection-pdf', $data);
        return $pdf->download('egg-collection-record.pdf');
    }
}
