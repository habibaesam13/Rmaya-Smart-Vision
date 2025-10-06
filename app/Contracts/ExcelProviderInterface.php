<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ExcelProviderInterface
{
    public function getData(Request $request);
    public function headings();
}
