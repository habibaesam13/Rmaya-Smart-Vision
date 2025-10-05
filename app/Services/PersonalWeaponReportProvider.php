<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\ResultsService;
use App\Contracts\PDFProviderInterface;

class PersonalWeaponReportProvider implements PDFProviderInterface
{
    protected ResultsService $results_service;
    /**
     * Create a new class instance.
     */
    public function __construct(ResultsService $results_service)
    {
        $this->results_service=$results_service;
        
    }

    public function getData(Request $request){
        $reportId=$request->rid;
        $report=$this->results_service->getReport($reportId);
        $reportMembers=$this->results_service->getReportDetails($reportId);
        return [$report,$reportMembers];

    }
}
