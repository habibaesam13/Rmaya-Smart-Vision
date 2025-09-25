<?php

namespace App\Services;

use App\Contracts\MembersProviderInterface;
use App\Services\GroupService;
use Illuminate\Http\Request;

class GroupsMembersProvider implements MembersProviderInterface
{
    /**
     * Create a new class instance.
     */
    protected $groupService;
    public function __construct(GroupService $groupService)
    {
        $this->groupService=$groupService;
    }
    public function getMembers(Request $request)
    {
        return $this->groupService->membersByGroupSearch($request);
    }
}
