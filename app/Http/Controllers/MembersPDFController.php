<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sv_member;
use Mpdf\Mpdf;
use ArPHP\I18N\Arabic;

class MembersPDFController extends Controller
{
    public function viewPDF(Request $request)
    {
        $members = Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality', 'member_group'])
            ->where('reg_type', 'personal')
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn($q) => $q->filter($request)
            )
            ->get();
        $html = view('pdf.members', compact('members'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans', 
            'directionality' => 'rtl',
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('members-details.pdf', 'I');
    }

    public function downloadPDF(Request $request)
    {
        $members = Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality', 'member_group'])
            ->where('reg_type', 'personal')
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn($q) => $q->filter($request)
            )
            ->get();
        $Arabic = new Arabic('Glyphs');
        $html = view('pdf.members', compact('members'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
            'directionality' => 'rtl',
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('members-details.pdf', 'D'); 
    }
}
