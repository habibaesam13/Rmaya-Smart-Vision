<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sv_team;
use App\Services\GroupService;
use Mpdf\Mpdf;
use ArPHP\I18N\Arabic;
class GroupsPDFController extends Controller
{
    protected GroupService $groupService;
    public function __construct(GroupService $groupService)
    {
        $this->groupService=$groupService;
        
    }
    public function viewPDF(Request $request)
    {
        $groups = $this->groupService->searchQuery($request)->get();
        $html = view('pdf.groups', compact('groups'))->render();

        // 🔹 create mPDF
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans', 
            'directionality' => 'rtl',
        ]);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('groups-details.pdf', 'I');
    }

    public function downloadPDF(Request $request)
    {
        $groups = $this->groupService->searchQuery($request);

        $Arabic = new Arabic('Glyphs');
        $html = view('pdf.groups', compact('groups'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
            'directionality' => 'rtl',
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('groups-details.pdf', 'D'); 
    }
}
