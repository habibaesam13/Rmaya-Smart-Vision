<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;

use ArPHP\I18N\Arabic;
use Illuminate\Http\Request;
use App\Contracts\PDFProviderInterface;
use App\Models\SiteSettings;

class PDFController extends Controller
{
    protected $provider;
    protected $view;
    protected $fileName;
    public function __construct(PDFProviderInterface $provider,string $view,string $fileName)
    {
        $this->provider=$provider;
        $this->view=$view;
        $this->fileName=$fileName;
    }

    public function generatePDF($data,$mode='I',$siteSettings=null){
        $html = view($this->view, compact('data','siteSettings'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans', 
            'directionality' => 'rtl',
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output($this->fileName,$mode);
    }
    public function viewPDF(Request $request){
        $data=$this->provider->getData($request);
        return $this->generatePDF($data,'I');
    }
    public function downloadPDF(Request $request){
        $data=$this->provider->getData($request);
        $siteSettings=SiteSettings::first();
        return $this->generatePDF($data,'I',$siteSettings);
    }
}
