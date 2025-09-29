<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;

use ArPHP\I18N\Arabic;
use Illuminate\Http\Request;
use App\Contracts\PDFProviderInterface;

class PDFController extends Controller
{
    protected $provider;
    protected $view;

    public function __construct(PDFProviderInterface $provider,string $view)
    {
        $this->provider=$provider;
        $this->view=$view;
    }

    public function generatePDF($data,$filename,$mode='I'){
        $html = view($this->view, compact('data'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans', 
            'directionality' => 'rtl',
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output($filename,$mode);
    }
    public function viewPDF(Request $request){
        $data=$this->provider->getData($request);
        return $this->generatePDF($data,'data-details.pdf','I');
    }
    public function downloadPDF(Request $request){
        $data=$this->provider->getData($request);
        return $this->generatePDF($data,'data-details.pdf','I');
    }
}
