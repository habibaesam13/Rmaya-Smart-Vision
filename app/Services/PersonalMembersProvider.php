<?php

namespace App\Services;

use App\Contracts\PDFProviderInterface;
use Illuminate\Http\Request;
use App\Models\Sv_member;
class PersonalMembersProvider implements PDFProviderInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getData(Request $request)
    {
        return Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality', 'member_group'])
            ->where('reg_type', 'personal')
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn($q) => $q->filter($request)
            )
            ->get();
    }
}
