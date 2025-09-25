<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\MembersProviderInterface;
use Mpdf\Mpdf;
use ArPHP\I18N\Arabic;

class PDFController extends Controller
{
    protected $provider;
    protected $view;

    public function __construct(MembersProviderInterface $provider,string $view)
    {
        $this->provider=$provider;
        $this->view=$view;
    }

    public function generatePDF($members,$filename,$mode='I'){
        $html = view($this->view, compact('members'))->render();
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
        $members=$this->provider->getMembers($request);
        return $this->generatePDF($members,'members-details.pdf','I');
    }
    public function downloadPDF(Request $request){
        $members=$this->provider->getMembers($request);
        return $this->generatePDF($members,'members-details.pdf','I');
    }
}
