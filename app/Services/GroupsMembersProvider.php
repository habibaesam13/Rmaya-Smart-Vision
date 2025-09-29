<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Contracts\PDFProviderInterface;

class GroupsMembersProvider implements PDFProviderInterface
{
    /**
     * Create a new class instance.
     */
    protected $groupService;
    public function __construct(GroupService $groupService)
    {
        $this->groupService=$groupService;
    }
    public function getData(Request $request)
    {
        return $this->groupService->membersByGroupSearch($request);
    }
}
