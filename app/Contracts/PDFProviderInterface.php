<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface PDFProviderInterface
{
    public function getData(Request $request);
}
