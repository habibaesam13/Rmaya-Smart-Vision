<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroupService;
use Mpdf\Mpdf;
use ArPHP\I18N\Arabic;

class MembersGroupsPDF extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function viewPDF(Request $request)
    {
        // استدعاء السيرفس
        $members = $this->groupService->membersByGroupSearch($request);

        $html = view('pdf.groups_members', compact('members'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans', 
            'directionality' => 'rtl',
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('members-groups-details.pdf', 'I');
    }

    public function downloadPDF(Request $request)
    {
        $members = $this->groupService->membersByGroupSearch($request);

        $Arabic = new Arabic('Glyphs');
        $html = view('pdf.groups_members', compact('members'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
            'directionality' => 'rtl',
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('members-groups-details.pdf', 'D'); 
    }
}
