<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $data = $request->input('data');
        $title = $request->input('title');
        $logoUrl = env('ASSET_URL') . 'img/logoPRETO-criaatvaPRETOWHITE.png';
        $headers = $request->input('headers'); // Receba os cabeçalhos como um array
        $totals = $request->input('totals'); // Receba os totais
        $isGroupingEnabled = $request->input('isGroupingEnabled');
        $groupByColumn = $request->input('groupByColumn');

        // Define a orientação como paisagem
        $pdf = PDF::loadView('pdf_template', compact('data', 'title', 'logoUrl', 'headers', 'totals', 'isGroupingEnabled', 'groupByColumn'))->setPaper('a4', 'landscape');

        return $pdf->download($title . '.pdf');
    }
}
