<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sv_clubs;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Models\Sv_clubs_weapons;
use App\Http\Requests\StoreClubRequest;


class ClubsController extends Controller
{
    protected $clubService;

    public function __construct(ClubService $clubService)
    {
        $this->clubService = $clubService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(!checkModulePermission('clubs', 'view')) {   return redirect()->route('access_denied');  }
        return view('clubs.index', [
            'clubs' => $this->clubService->getAllClubs()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClubRequest $request)
    {
        if(!checkModulePermission('clubs', 'add')) {   return redirect()->route('access_denied');  }
        $this->clubService->createClub($request->validated());
        return redirect()->route('clubs.index')->with('success', 'تم إضافة النادي بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(!checkModulePermission('clubs', 'view')) {   return redirect()->route('access_denied');  }
        $club = $this->clubService->getClubById($id);
        return view('clubs.show', compact('club'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(!checkModulePermission('clubs', 'edit')) {   return redirect()->route('access_denied');  }
        $club = $this->clubService->getClubById($id);
        return view('clubs.edit', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(!checkModulePermission('clubs', 'edit')) {   return redirect()->route('access_denied');  }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $this->clubService->updateClub($id, $validated);
        return redirect()->route('clubs.index')->with('success', 'تم تحديث النادي بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(!checkModulePermission('clubs', 'delete')) {   return redirect()->route('access_denied');  }
        $this->clubService->deleteClub($id);
        return redirect()->route('clubs.index')->with('success', 'تم حذف النادي بنجاح.');
    }

    public function toggleStatus($id)
    {
        $this->clubService->toggleActiveStatus($id);
        return redirect()->route('clubs.index')->with('success', 'تم تحديث حالة النادي بنجاح.');
    }

    public function getWeaponsByAge($clubId, Request $request)
    {
        $dob = $request->dob;
        $gender = $request->gender;

        if (!$dob || !$gender) {
            return response()->json(['weapons' => []]);
        }

        $age = Carbon::parse($dob)->age;
        $weapons = Sv_clubs_weapons::where('cid', $clubId)
            ->where('gender', $gender)
            ->where('active', 1)
            ->where('age_from', '<=', $age)
            ->where(function ($q) use ($age) {
                $q->whereNull('age_to')
                    ->orWhere('age_to', '>=', $age);
            })
            ->with('weapon')
            ->get();


        return response()->json([
            'weapons' => $weapons->map(function ($cw) {
                return [
                    'wid' => $cw->wid,
                    'name' => $cw->weapon->name ?? '---'
                ];
            })
        ]);
    }
}
