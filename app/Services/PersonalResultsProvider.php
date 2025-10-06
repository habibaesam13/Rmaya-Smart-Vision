<?php

namespace App\Services;
use App\Models\Sv_member;
use Illuminate\Http\Request;
use App\Contracts\PDFProviderInterface;
use App\Models\Sv_initial_results_players;

class PersonalResultsProvider implements PDFProviderInterface
{
    /**
     * Create a new class instance.
     */
    
    public function getData(Request $request)
    {
        $addedPlayers = Sv_initial_results_players::pluck('player_id')->toArray();

        return Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])
            ->where('reg_type', 'personal')
            ->whereNotIn('mid', $addedPlayers)
            ->when(
                $request->hasAny([
                    'mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q',
                    'gender', 'active', 'date_from', 'date_to', 'reg_club'
                ]),
                fn($q) => $q->filter($request)
            )
            ->orderBy('mid')
            ->get();
    }
}
