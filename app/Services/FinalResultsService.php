<?php

namespace App\Services;


use App\Models\SVFianlResultsPlayer;
use Mpdf\Image\Svg;
use App\Models\Sv_report;
use Illuminate\Http\Request;
use App\Models\SVFianlResults;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\sv_initial_results_players;
use App\Models\Sv_member;

class FinalResultsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createReport($data)
    {

        return DB::transaction(function () use ($data) {

            $report = SVFianlResults::create($data);


            foreach ($data['checkedMembers'] as $mid) {
                $report->players_results()->create([
                    'player_id' => $mid,
                    'goal' => 0,
                    'total' => 0,
                    'notes' => null,
                ]);
            }

            return $report;
        });
    }

    public function getReportDetails($reportId)
    {
        $Players = SVFianlResultsPlayer::where('Rid', $reportId)->get();
        return $Players;
    }

    public function getReport($rid)
    {
        return SVFianlResults::findOrfail($rid);
    }

    public function confirmReport($rid)
    {
        $report = $this->getReport($rid);
        $report->confirmed = !$report->confirmed;
        return $report->save();
    }

    public function deletePlayerFromReport($player_id)
    {
        $player = sv_initial_results_players::findOrfail($player_id);
        return $player->delete();
    }

    public function saveReport(Request $request, $playersData, $rid)
    {
        $report = $this->getReport($rid);


        if ($request->hasFile('attached_file')) {
            $validated = $request->validate([
                'attached_file' => 'mimes:pdf,doc,docx,xlsx,xls|max:2048',
            ]);

            // Get the validated file
            $file = $validated['attached_file'];

            // Delete the old file if exists
            if ($report->attached_file && Storage::disk('public')->exists($report->attached_file)) {
                Storage::disk('public')->delete($report->attached_file);
            }

            // Store new file
            $path = $file->store('reports_attachments', 'public');

            $report->file = $path;
            $report->save();

        }


        // Update player results
        foreach ($playersData as $playerId => $values) {
            $cleanedValues = collect($values)->map(function ($v, $k) {
                if ($k === 'notes') {
                    return $v === '' ? null : $v;
                }
                return ($v === '' || is_null($v)) ? 0 : $v;
            })->toArray();

            $report->players_results()
                ->where('id', $playerId)
                ->update([
                    'goal' => $cleanedValues['goal'] ?? 0,
                    'R1' => $cleanedValues['R1'] ?? 0,
                    'R2' => $cleanedValues['R2'] ?? 0,
                    'R3' => $cleanedValues['R3'] ?? 0,
                    'R4' => $cleanedValues['R4'] ?? 0,
                    'R5' => $cleanedValues['R5'] ?? 0,
                    'R6' => $cleanedValues['R6'] ?? 0,
                    'R7' => $cleanedValues['R7'] ?? 0,
                    'R8' => $cleanedValues['R8'] ?? 0,
                    'R9' => $cleanedValues['R9'] ?? 0,
                    'R10' => $cleanedValues['R10'] ?? 0,
                    'total' => $cleanedValues['total'] ?? 0,
                    'notes' => $cleanedValues['notes'] ?? null,
                ]);
        }

        return $report;
    }


    public function getAvailablePlayers($report)
    {

        $addedPlayers = SVFianlResultsPlayer::pluck('player_id')->toArray();
        return

//            Sv_member::where('reg_type', 'personal')->where('weapon_id', $report->weapon_id)->whereNotIn('mid', $addedPlayers)
//            ->orderBy('mid')
//            ->get();
            DB::table('sv_members')->join('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
                ->join('sv_clubs', 'sv_clubs.cid', '=', 'sv_members.club_id')
                ->select('sv_initial_results_players.*',
                    'sv_members.name',
                    'sv_members.phone1',
                    'sv_members.phone2',
                    'sv_members.mid',

                    'sv_weapons.name as weapon_name',
                    'sv_members.registration_date',
                    'sv_clubs.name as club_name'

                )
                ->whereNotIn('mid', $addedPlayers)
                ->orderBy('sv_initial_results_players.total', 'desc')->get();

    }

    public function GetAllAvailablePlayers(Request $request)
    {
        $addedPlayers = sv_initial_results_players::pluck('player_id')->toArray();
        return Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])
            ->where('reg_type', 'personal')
            ->whereNotIn('mid', $addedPlayers)
            ->when(
                $request->hasAny([
                    'mgid',
                    'reg',
                    'nat',
                    'club_id',
                    'weapon_id',
                    'q',
                    'gender',
                    'active',
                    'date_from',
                    'date_to',
                    'reg_club'
                ]),
                fn ($q) => $q->filter($request)
            )
            ->orderBy('mid')
            ->cursorPaginate(config('app.admin_pagination_number'));
    }


    /**Preliminary results reports - clubs - details */


    public function getReportsDetails(Request $request)
    {
        return SVFianlResults::query()->where('confirmed', true)
            ->when($request->weapon_id, fn ($q, $weapon) => $q->where('weapon_id', $weapon))
            ->when($request->details, fn ($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn ($q, $from) => $q->whereDate('date', '>=', $from))
            ->when($request->date_to, fn ($q, $to) => $q->whereDate('date', '<=', $to))
            ->orderBy('id')
            ->cursorPaginate(config('app.admin_pagination_number'));

    }


    public function getReportsPlayersDetails(Request $request)
    {

        $query = SVFianlResults::query();

        $query
            ->
            join('sv_fianl_results_players', 'sv_fianl_results_players.Rid', '=', 'sv_fianl_results.id')
            ->join('sv_members', 'sv_members.mid', '=', 'sv_fianl_results_players.player_id')
            ->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
            ->select('sv_fianl_results_players.id as result_player_id', 'sv_fianl_results_players.second_total', 'sv_fianl_results_players.total', 'sv_fianl_results.*', 'sv_members.name as player_name', 'sv_members.mid as player_id',  'sv_members.ID as ID', 'sv_weapons.name as weapon_name')
            ->where('sv_fianl_results.confirmed', true);

        if (!empty($request->weapon_id)) {
            $query = $query->where('sv_fianl_results.weapon_id', $request->weapon_id);
        }
        if (!empty($request->details)) {
            $query = $query->where('sv_fianl_results.details', $request->details);
        }
        if (!empty($request->to_date)) {
            $query = $query->whereDate('sv_fianl_results.date', '=<', $request->to_date);
        }
        if (!empty($request->from_date)) {
            $query = $query->whereDate('sv_fianl_results.date', '=>', $request->from_date);
        }
        $query->orderBy('sv_fianl_results_players.total', 'desc')->orderBy('sv_fianl_results_players.second_total', 'desc');
        $data = $query->cursorPaginate(config('app.admin_pagination_number'));
        return $data;

    }

//    public function getConfirmedPlayers(Request $request)
//    {
////        return SVFianlResults::query()->where('confirmed',true)
////            ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
////            ->when($request->details, fn($q, $details) => $q->where('details', $details))
////            ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
////            ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
////            ->with ('players_results')->orderBy('Rid')
////            ->cursorPaginate(config('app.admin_pagination_number'));
//        return
//
//            Sv_member::query()
//                ->whereHas('SVFianlResults' , function ($query){
//                    $query->where('total' , '>' , 0);
//                })
//                ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
//                ->when($request->details, fn($q, $details) => $q->where('details', $details))
//                ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
//                ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
//                ->orderBy('mid')
//                ->cursorPaginate(config('app.admin_pagination_number'));
//
//    }


    public function getConfirmedAvailablePlayers($report)
    {

        $addedPlayers = sv_initial_results_players::pluck('player_id')->toArray();
        return Sv_member::where('reg_type', 'personal')->where('weapon_id', $report->weapon_id)->whereNotIn('mid', $addedPlayers)
            ->orderBy('mid')
            ->get();
    }


    /**********************/
    public function getConfirmedPlayers(Request $request)
    {
//        return SV_initial_results::query()->where('confirmed',true)
//            ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
//            ->when($request->details, fn($q, $details) => $q->where('details', $details))
//            ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
//            ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
//            ->with ('players_results')->orderBy('Rid')
//            ->cursorPaginate(config('app.admin_pagination_number'));

//            Sv_member::query()
//                ->whereHas('sv_initial_results' , function ($query){
//                    $query->where('total' , '>' , 0);
//                })
//                ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
//                ->when($request->details, fn($q, $details) => $q->where('details', $details))
//                ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
//                ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
//                ->orderBy('mid')
//            ->cursorPaginate(config('app.admin_pagination_number'));

        return

            DB::table('sv_members')->join('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
                ->join('sv_clubs', 'sv_clubs.cid', '=', 'sv_members.club_id')
                ->select('sv_initial_results_players.*',
                    'sv_members.name',
                    'sv_members.phone1',
                    'sv_members.phone2',
                    'sv_members.mid',
                    'sv_weapons.name as weapon_name',
                    'sv_members.registration_date',
                    'sv_clubs.name as club_name'

                )
                ->orderBy('sv_initial_results_players.total', 'desc')->get();


    }


    public function getSortedRatings()
    {
        $arr = [0 => 'الاول',
            1 => 'الثاني',
            2 => 'الثالت',
            3 => 'الرابع',
            4 => 'الخامس',
            5 => 'السادس',
            6 => 'السابع',
            7 => 'الثامن',
            8 => 'التاسع',
            9 => 'العاشر',
            10 => 'الاحدي عشر',
            11 => 'الثاني عشر',
            12 => 'الثالت عشر',
            13 => 'الرابع عشر',
            14 => 'الخامس عشر',
            15 => 'السادس عشر',
        ];

        return $arr;
    }


    public function updateSecondTotalOfResultPlayer($id, $val)
    {
        return SVFianlResultsPlayer::where('id', $id)->update(['second_total' => $val]);

    }


    public function getOrdersArray($arr1, $arr2)
    {
        $final = [];

        // Extract keys and values to allow same foreach structure
        $keys = array_keys($arr1);
        $values1 = array_values($arr1);
        $values2 = array_values($arr2);

        $count = count($values1);
        $previ = -1;
        $next = -1;

        foreach ($values1 as $i => $item1) {
            $key1 = $keys[$i];

            if ($i != 0) {
                $previ = $values1[$i - 1];
            }

            if ($i < $count - 1) {
                $next = $values1[$i + 1];
            }

            if ($previ === $item1) {
                $final[$item1][] = $values2[$i];
            } elseif ($i === 0 && $next === $item1) {
                $final[$item1][] = $values2[$i];
            } elseif ($i == $count - 1 && $previ === $item1) {
                $final[$item1][] = $values2[$i];
            } elseif ($previ !== $item1 && $item1 === $next && $i !== $count - 1) {
                $final[$item1][] = $values2[$i];
            } else {
                $final[$item1][] = $item1;
            }
        }

        // Sort the outer array by key descending (e.g., 60 > 20)
        krsort($final);

        // Sort each inner array descending
        foreach ($final as &$arr) {
            rsort($arr);
        }
        unset($arr);

        // ✅ Flatten while keeping same order and mapping back to arr1 keys
        $flattened = [];
        $index = 0;
        foreach ($arr1 as $key => $val) {
            $flattened[$key] = null; // initialize to preserve order
        }

        // Fill the flattened array sequentially (values in order)
        $allValues = [];
        foreach ($final as $group) {
            foreach ($group as $value) {
                $allValues[] = $value;
            }
        }

        // Map flattened values to original keys in order
        $i = 0;
        foreach (array_keys($flattened) as $key) {
            if (isset($allValues[$i])) {
                $flattened[$key] = $allValues[$i];
            }
            $i++;
        }

        return $flattened;

    }


    public function getArraysOfOrdersArray(Request $request)
    {


        $query = SVFianlResults::query();

        $query
            ->
            join('sv_fianl_results_players', 'sv_fianl_results_players.Rid', '=', 'sv_fianl_results.id')
            ->join('sv_members', 'sv_members.mid', '=', 'sv_fianl_results_players.player_id')
            ->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
            ->select('sv_fianl_results_players.id as result_player_id', 'sv_fianl_results_players.second_total', 'sv_fianl_results_players.total', 'sv_fianl_results.*', 'sv_members.name as player_name', 'sv_members.mid as player_id', 'sv_weapons.name as weapon_name')
            ->where('sv_fianl_results.confirmed', true);

        if (!empty($request->weapon_id)) {
            $query = $query->where('sv_fianl_results.weapon_id', $request->weapon_id);
        }
        if (!empty($request->details)) {
            $query = $query->where('sv_fianl_results.details', $request->details);
        }
        if (!empty($request->to_date)) {
//            $query =  $query ->  whereDate('date', '<=', $request->to_date) ;
            $query = $query->whereDate('sv_fianl_results.date', '=<', $request->to_date);

        }
        if (!empty($request->from_date)) {
//            $query =  $query ->  whereDate('date',  '>=', $request->from_date) ;
            $query = $query->whereDate('sv_fianl_results.date', '=>', $request->from_date);

        }
//                        ->when($request->weapon_id, fn ($q, $weapon) => $q->where('weapon_id', $weapon))
//        ->when($request->details, fn ($q, $details) => $q->where('details', $details))
//        ->when($request->from_date, fn ($q, $from) => $q->whereDate('date', '>=', $from))
//        ->when($request->to_date, fn ($q, $to) => $q->whereDate('date', '<=', $to))

        $arr1 = $query->orderBy('sv_fianl_results_players.total', 'desc')->pluck('total', 'result_player_id')->toArray();
        $arr2 = $query->orderBy('sv_fianl_results_players.total', 'desc')->pluck('second_total', 'result_player_id')->toArray();
//        $data = $query->cursorPaginate(config('app.admin_pagination_number'));
        return [$arr1 , $arr2];

    }
}
