<?php

namespace App\Http\Controllers;

use App\Models\SiteSettings;
use Illuminate\Http\Request;
use App\Services\ResultsService;

class ReportController extends Controller
{
    protected ResultsService $resultSevice;
    public function __construct(ResultsService $resultsService)
    {
        $this->resultSevice=$resultsService;
    }
    public function print($rid)
    {
        $report = $this->resultSevice->getReport($rid);
        if (!$report) {
            return redirect()->route('results-registered-members');
        }
        $siteSettings=SiteSettings::first();
        if(!$report->confirmed){
            $members = $this->resultSevice->getReportDetails($rid);
        }
        else{
            $members = $this->resultSevice->getConfirmedReportdetailsWithoutAbsent($rid);
        }
        return view('personalReports.initial_results.print', ['report' => $report, 'members' => $members,'siteSettings'=>$siteSettings]);
    }
}
