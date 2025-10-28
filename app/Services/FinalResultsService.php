<?php

namespace App\Services;


use App\Http\Traits\ImageTrait;
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
    use ImageTrait;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createReport($data)
    {

        //    dd(session('absent'));
        return DB::transaction(function () use ($data) {

            $report = SVFianlResults::create($data);


            foreach ($data['checkedMembers'] as $mid) {
                $report->players_results()->create([
                    'player_id' => $mid,
                    'goal' => 0,
                    'total' => null,
                    'notes' => null,
                ]);
            }

            return $report;
        });
    }

    public function getReportDetails($reportId)
    {
        $Players = SVFianlResultsPlayer::where('Rid', $reportId)->orderBy('id', 'desc')->get();
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
        /*****************************new image part**********/
        if ($request->hasFile('attached_file')) {
            $validated = $request->validate([
                'attached_file' => 'mimes:pdf,doc,docx,xlsx,xls|max:2048',
            ]);
            $file = $validated['attached_file'];
            $path = $this->storeImage($request, '/final_reports/reports_attachments', $file, 'attached_file');
            $report->file = $path;
            $report->save();
        }
        /******************************end new image part ***************/


        // Update player results
        foreach ($playersData as $playerId => $values) {
            $cleanedValues = collect($values)->map(function ($v, $k) {
//                if ($k === 'notes' || $k === 'total') {
                if ($k === 'goal') {
                    return ($v === '' || is_null($v)) ? 0 : $v;
                }
                return $v === '' ? null : $v;
            })->toArray();

            if (is_numeric($cleanedValues['total'])) {
                $report->players_results()
                    ->where('id', $playerId)
                    ->update([
                        'goal' => $cleanedValues['goal'] ?? 0,
                        'R1' => $cleanedValues['R1'] ?? null,
                        'R2' => $cleanedValues['R2'] ?? null,
                        'R3' => $cleanedValues['R3'] ?? null,
                        'R4' => $cleanedValues['R4'] ?? null,
                        'R5' => $cleanedValues['R5'] ?? null,
                        'R6' => $cleanedValues['R6'] ?? null,
                        'R7' => $cleanedValues['R7'] ?? null,
                        'R8' => $cleanedValues['R8'] ?? null,
                        'R9' => $cleanedValues['R9'] ?? null,
                        'R10' => $cleanedValues['R10'] ?? null,
                        'total' => $cleanedValues['total'],
                        'notes' => $cleanedValues['notes'] ?? null,
                    ]);
            } else {
                $report->players_results()
                    ->where('id', $playerId)
                    ->update([
                        'goal' => $cleanedValues['goal'] ?? 0,
                        'R1' => $cleanedValues['R1'] ?? null,
                        'R2' => $cleanedValues['R2'] ?? null,
                        'R3' => $cleanedValues['R3'] ?? null,
                        'R4' => $cleanedValues['R4'] ?? null,
                        'R5' => $cleanedValues['R5'] ?? null,
                        'R6' => $cleanedValues['R6'] ?? null,
                        'R7' => $cleanedValues['R7'] ?? null,
                        'R8' => $cleanedValues['R8'] ?? null,
                        'R9' => $cleanedValues['R9'] ?? null,
                        'R10' => $cleanedValues['R10'] ?? null,
                        'total' => null,
                        'notes' => $cleanedValues['notes'] ?? null,
                    ]);
            }
        }

        return $report;
    }


    public function getAvailablePlayers($report, $request)
    {

        $addedPlayers = SVFianlResultsPlayer::pluck('player_id')->toArray();


//            Sv_member::where('reg_type', 'personal')->where('weapon_id', $report->weapon_id)->whereNotIn('mid', $addedPlayers)
//            ->orderBy('mid')
//            ->get();
        $query = DB::table('sv_members')
            ->join('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
            ->join('sv_initial_results', 'sv_initial_results.Rid', '=', 'sv_initial_results_players.Rid')
            ->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
            ->join('sv_clubs', 'sv_clubs.cid', '=', 'sv_members.club_id')
            ->select('sv_initial_results_players.*',
                'sv_members.name',
                'sv_members.phone1',
                'sv_members.phone2',
                'sv_members.mid',
                'sv_members.ID',
                'sv_weapons.name as weapon_name',
                'sv_members.registration_date',
                'sv_clubs.name as club_name',
                'sv_initial_results.attached_file'
            )
            ->where('sv_members.weapon_id', $report->weapon_id)
            ->whereNotIn('mid', $addedPlayers)
            ->where([['sv_initial_results.confirmed', '=', 1], ['sv_initial_results_players.total', '>', -1]])
            /********search part ******/
            ->when($request->club_id, fn ($q, $club) => $q->where('cid', $club))
            ->when($request->nat, fn ($q, $nat) => $q->where('nat', $nat))


            //                ->when($request->details, fn($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn ($q, $from) => $q->whereDate('date', '>=', $from))
            ->when($request->date_to, fn ($q, $to) => $q->whereDate('date', '<=', $to))
            ->orderBy('sv_initial_results_players.total', 'desc');

        if (!empty($request->q)) {
            $qvalue = trim($request->q);
            $query->where(function ($sub) use ($qvalue) {
                $sub->where('sv_members.name', 'like', "%" . $qvalue . "%")
                    ->orWhere('sv_members.ID', 'like', "%" . $qvalue . "%")
                    ->orWhere('sv_members.phone1', $qvalue)
                    ->orWhere('sv_members.phone2', $qvalue);
            });
        }
//        if (!empty($request->q)) {
//            $qValue = trim($request->q);
//
//            $query->where(function ($sub) use ($qValue) {
//                $sub->where('sv_members.name', 'like', "%{$qValue}%")
//                    ->orWhere('sv_members.ID', 'like', "%{$qValue}%")
//                    ->orWhere('sv_members.phone1',  $qValue )
//                    ->orWhere('sv_members.phone2',  $qValue );
//            });
//        }

        /*********ens search part****/

        $data = $query->orderBy('sv_initial_results_players.total', 'desc')->get();
        return $data;

//        ->when($request->weapon_id, fn ($q, $weapon) => $q->where('sv_members.weapon_id', $weapon))
//        ->when($request->reg_club, fn ($q, $club) => $q->where('cid', $club))
//        ->when($request->nat, fn ($q, $nat) => $q->where('nat', $nat))
//        ->when($request->mgid, fn ($q, $mg) => $q->where('sv_members.mgid', $mg))
//        //                ->when($request->details, fn($q, $details) => $q->where('details', $details))
//        ->when($request->date_from, fn ($q, $from) => $q->whereDate('registration_date', '>=', $from))
//        ->when($request->date_to, fn ($q, $to) => $q->whereDate('registration_date', '<=', $to))
//        ->when($request->gender, fn ($q, $gender) => $q->where('sv_members.gender', $gender));
//        if (!empty($request->q)) {
//            $query = $query->where('sv_members.name', 'like', "%" . $request->q . "%")
//                ->orWhere('sv_members.ID', 'like', "%" . $request->q . "%")
//                ->orWhere('sv_members.phone1', $request->q)
//                ->orWhere('sv_members.phone2', $request->q);
//        }
//        $query = $query->where([['sv_initial_results.confirmed', '=', 1], ['sv_initial_results_players.total', '>', -1]])->whereNotIn('mid', $occupied_players)
//            ->orderBy('sv_initial_results_players.total', 'desc');

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
            ->orderBy('mid', 'desc')
            ->cursorPaginate(config('app.admin_pagination_number'));
    }


    /**Preliminary results reports - clubs - details */


    public function getReportsDetails(Request $request, $paginationCheck = 'yes')
    {
        $query = SVFianlResults::query()
//            ->where('confirmed', true)
            ->when($request->weapon_id, fn ($q, $weapon) => $q->where('weapon_id', $weapon))
            ->when($request->details, fn ($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn ($q, $from) => $q->whereDate('date', '>=', $from))
            ->when($request->date_to, fn ($q, $to) => $q->whereDate('date', '<=', $to))
            ->orderBy('id', 'desc');
        if ($paginationCheck === 'yes') {
            $data = $query->cursorPaginate(config('app.admin_pagination_number'));
        } else {
            $data = $query->get();
        }
        return $data;

    }

    public function getReportsDetailsWithWeapons(Request $request, $withPaging = 'yes')
    {
        $query = SVFianlResults::query()->with('weapon')
//            ->where('confirmed', 1)
            ->when($request->weapon_id, fn ($q, $weapon) => $q->where('weapon_id', $weapon))
            ->when($request->details, fn ($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn ($q, $from) => $q->whereDate('date', '>=', $from))
            ->when($request->date_to, fn ($q, $to) => $q->whereDate('date', '<=', $to))
            ->orderBy('id', 'desc');
        if ($withPaging == 'yes') {
            return $query->cursorPaginate(config('app.admin_pagination_number'));
        }
        return $query->get();
    }


    public function getReportsPlayersDetails(Request $request, $pagination = 'yes')
    {

        $query = SVFianlResults::query();

        $query
            ->
            join('sv_fianl_results_players', 'sv_fianl_results_players.Rid', '=', 'sv_fianl_results.id')
            ->join('sv_members', 'sv_members.mid', '=', 'sv_fianl_results_players.player_id')
            ->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
            ->select('sv_fianl_results_players.id as result_player_id', 'sv_fianl_results_players.second_total', 'sv_fianl_results_players.total', 'sv_fianl_results.*', 'sv_members.name as player_name', 'sv_members.mid as player_id', 'sv_members.club_id', 'sv_members.ID as ID', 'sv_weapons.name as weapon_name')
            ->where('sv_fianl_results.confirmed', 1)
            ->where('sv_fianl_results_players.total', '<>', null);
        if (!empty($request->club_id)) {
            $query = $query->where('sv_members.club_id', $request->club_id);
        }

        if (!empty($request->weapon_id)) {
            $query = $query->where('sv_fianl_results.weapon_id', $request->weapon_id);
        }
        if (!empty($request->details_date)) {
            $query = $query->whereDate('sv_fianl_results.date', $request->details_date);
        }
//        if (!empty($request->to_date)) {
//            $query = $query->whereDate('sv_fianl_results.date', '=<', $request->to_date);
//        }

//        if (!empty($request->search)) {  //here here
//            $query = $query->where('sv_members.name', 'like', "%" . $request->search . "%")
//                ->orWhere('sv_members.ID', 'like', "%" . $request->search . "%")
//                ->orWhere('sv_members.phone1', $request->search)
//                ->orWhere('sv_members.phone2', $request->search);
//        }
        if (!empty($request->search)) {
            $qValue = trim($request->search);

            $query->where(function ($sub) use ($qValue) {
                $sub->where('sv_members.name', 'like', "%{$qValue}%")
                    ->orWhere('sv_members.ID', 'like', "%{$qValue}%")
                    ->orWhere('sv_members.phone1', $qValue)
                    ->orWhere('sv_members.phone2', $qValue);
            });
        }

        if (!empty($request->total)) {
            $query = $query->where('sv_fianl_results_players.total', '>=', $request->total);
        }
        $query->orderBy('sv_fianl_results_players.total', 'desc')->orderBy('sv_fianl_results_players.second_total', 'desc');

        if ($pagination === 'yes') {
            if (!empty($request->rate_limiting)) {
                $data = $query->limit($request->rate_limiting)->cursorPaginate($request->rate_limiting);
            } else {
                $data = $query->cursorPaginate(config('app.admin_pagination_number'));
            }
        } else {
            if (!empty($request->rate_limiting)) {
                $data = $query->limit($request->rate_limiting)->get();
            } else {
                $data = $query->get();
            }
        }
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
    public function getConfirmedPlayers(Request $request, $with_pagination = 'yes')
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
        $occupied_players = Sv_member::has('sv_final_results')->pluck('mid')->toArray();
        $query = DB::table('sv_members')
            ->join('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
            ->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
            ->join('sv_clubs', 'sv_clubs.cid', '=', 'sv_members.club_id')
            ->join('sv_initial_results', 'sv_initial_results.Rid', '=', 'sv_initial_results_players.Rid')
            ->select('sv_initial_results_players.*',
                'sv_members.name',
                'sv_members.phone1',
                'sv_members.phone2',
                'sv_members.mid',
                'sv_members.ID',
                'sv_weapons.name as weapon_name',
                'sv_members.registration_date',
                'sv_clubs.name as club_name'
            )->where('sv_members.weapon_id', $request->weapon_id);


        //here
        $query = $query->when($request->reg_club, fn ($q, $club) => $q->where('cid', $club))
            ->when($request->nat, fn ($q, $nat) => $q->where('nat', $nat))
            ->when($request->mgid, fn ($q, $mg) => $q->where('sv_members.mgid', $mg))
            //                ->when($request->details, fn($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn ($q, $from) => $q->whereDate('registration_date', '>=', $from))
            ->when($request->date_to, fn ($q, $to) => $q->whereDate('registration_date', '<=', $to))
            ->when($request->gender, fn ($q, $gender) => $q->where('sv_members.gender', $gender));


//        if (!empty($request->q)) {
//            $query = $query->where('sv_members.name', 'like', "%" . $request->q . "%")
//                ->orWhere('sv_members.ID', 'like', "%" . $request->q . "%")
//                ->orWhere('sv_members.phone1', $request->q)
//                ->orWhere('sv_members.phone2', $request->q);
//        }
        if (!empty($request->q)) {
            $qValue = trim($request->q);

            $query->where(function ($sub) use ($qValue) {
                $sub->where('sv_members.name', 'like', "%{$qValue}%")
                    ->orWhere('sv_members.ID', 'like', "%{$qValue}%")
                    ->orWhere('sv_members.phone1', $qValue)
                    ->orWhere('sv_members.phone2', $qValue);
            });
        }
        $query = $query->where([['sv_initial_results.confirmed', '=', 1], ['sv_initial_results_players.total', '>', -1]])
            ->whereNotIn('mid', $occupied_players)
            ->orderBy('sv_initial_results_players.total', 'desc');

        //dd($query->get());
        if ($with_pagination = 'yes') {
            $data = $query->cursorPaginate(config('app.admin_pagination_number'));
        } else {
            $data = $query->get();
//            allavailable_players
        }
        return $data;

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
        return [$arr1, $arr2];

    }


    public function deleteReport($id)
    {
        $report = SVFianlResults::with('finalPlayers')->find($id);
        if ($report) {
            if (count($report->finalPlayers))
                $report->finalPlayers()->delete();
            $this->deleteImage($report, 'file');
            $report->delete();
            return true;
        }
        return false;
    }


    public function deletePlayer($rid, $player_id)
    {
        $player = SVFianlResultsPlayer::where('Rid', $rid)->find($player_id);
        if ($player) {
            $player->delete();
            return true;
        }
        return false;
    }

}
