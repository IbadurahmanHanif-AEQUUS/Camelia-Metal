<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Smelting;
use App\Models\Workorder;
use App\Models\Production;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function printToPdf(Production $production)
    {
        $smeltings = Smelting::where('workorder_id',$production->workorder_id)->get();
        $data = [
            'title'     => 'PT. CAMELLIA METAL INDONESIA',
            'data'      => $production->workorder,
            'smeltings' => $smeltings,
            'production'   => $production
        ];
           
        $pdf = PDF::loadView('user.pdf.index', $data);
        $pdf->setPaper('A4','potrait');
        $pdf->render();
     
        return $pdf->stream('camellia_metal_label.pdf', array("Attachment" => false));
    }
}
