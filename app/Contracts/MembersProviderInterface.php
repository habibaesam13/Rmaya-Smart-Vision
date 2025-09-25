<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface MembersProviderInterface
{
    public function getMembers(Request $request);
}
