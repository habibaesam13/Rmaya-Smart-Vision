<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ExcelProviderInterface;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelController extends Controller
{
    protected ExcelProviderInterface $provider;

    public function __construct(ExcelProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function export(Request $request, string $fileName )
    {
        $provider = $this->provider;

        // Create an inline export class using your provider
        $export = new class($provider, $request) implements FromCollection, WithHeadings {
            protected $provider;
            protected $request;

            public function __construct(ExcelProviderInterface $provider, Request $request)
            {
                $this->provider = $provider;
                $this->request = $request;
            }

            public function collection()
            {
                return collect($this->provider->getData($this->request));
            }

            public function headings(): array
            {
                return $this->provider->headings();
            }
        };

        return Excel::download($export, $fileName);
    }
}
