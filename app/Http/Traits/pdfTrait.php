<?php

namespace App\Http\Traits;

use Mpdf\Mpdf;
trait pdfTrait
{



    public function printPdf($html , $fileName)
    {
        $mpdf = new Mpdf([
            'default_font' => 'amiri',
        ]);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
         if (app()->getLocale() === 'ar') {
            $mpdf->SetDirectionality('rtl');
        } else {
            $mpdf->SetDirectionality('ltr');
        }
        $mpdf->WriteHTML($html);
        return $mpdf->Output($fileName, 'D');

    }

}
