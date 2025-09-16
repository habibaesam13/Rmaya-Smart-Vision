<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Services\WeaponService;
use Illuminate\Support\Facades\DB;
use App\Services\ClubsWeaponsService;
use App\Http\Requests\StoreClubWeaponRequest;

class ClubsWeaponsController extends Controller
{
    protected $clubsWeaponsService, $clubsService, $weaponsService;

    public function __construct(
        ClubsWeaponsService $clubsWeaponsService,
        ClubService $clubsService,
        WeaponService $weaponsService
    ) {
        $this->clubsWeaponsService = $clubsWeaponsService;
        $this->clubsService = $clubsService;
        $this->weaponsService = $weaponsService;
    }

    public function getClubWeapons($cid)
    {
        try {

            $clubWeapons = DB::table('sv_clubs_weapons')
                ->where('cid', $cid)
                ->where('active', 1)
                ->get();
            if ($clubWeapons->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'weapons' => [],
                    'message' => 'No active weapons found for this club'
                ]);
            }
            $weapons = DB::table('sv_clubs_weapons')
                ->join('sv_weapons', 'sv_clubs_weapons.wid', '=', 'sv_weapons.wid')
                ->where('sv_clubs_weapons.cid', $cid)
                ->where('sv_clubs_weapons.active', 1)
                ->select('sv_weapons.wid', 'sv_weapons.name')
                ->distinct()
                ->orderBy('sv_weapons.name')
                ->get();

            return response()->json([
                'success' => true,
                'weapons' => $weapons
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index($club_id)
    {
        $clubsWeapons = $this->clubsWeaponsService->getClubsWeaponsByClubId($club_id);
        $club = $this->clubsService->getClubById($club_id);
        $weapons = $this->weaponsService->getAllWeapons(); //for add form

        return view('sv_clubs_weapons.index', compact('clubsWeapons', 'club', 'weapons'));
    }

    /**
     * Store a new club weapon.
     */
    public function store(StoreClubWeaponRequest $request)
    {
        $validated = $request->validated();
        $this->clubsWeaponsService->createClubWeapon($validated);
        return redirect()->route('clubs-weapons.index', $validated['cid'])
            ->with('success', 'تم إضافة السلاح للنادي بنجاح');
    }

    /**
     * Show the form for editing a specific club weapon.
     */
    public function edit(Request $request, $cwid)
    {
        // $validated=$request->validate([
        //     'cid' => 'required|exists:clubs,id',
        //     'wid' => 'required|exists:weapons,id',
        //     'gender' => 'required|in:male,female',
        //     'age_from' => 'required|integer|min:1|max:100',
        //     'age_to' => 'nullable|integer|gte:age_from|min:1|max:100',
        //     'success_degree' => 'required|integer|between:0,100',
        // ]);
        $clubWeapon = $this->clubsWeaponsService->getClubWeapon($cwid);
        if (!$clubWeapon) {
            return redirect()->back()->withErrors(['error' => 'السلاح غير موجود']);
        }
        $club = $this->clubsService->getClubById($clubWeapon->cid);
        $weapons = $this->weaponsService->getAllWeapons();

        return view('sv_clubs_weapons.edit', compact('clubWeapon', 'club', 'weapons'));
    }

    /**
     * Update a specific club weapon.
     */
    public function update(Request $request, $cwid)
    {
        try {
            $this->clubsWeaponsService->updateClubWeapon($cwid, $request->all());
        } catch (\InvalidArgumentException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
        $club_id = $request->input('cid');
        return redirect()->route('clubs-weapons.index', $club_id)
            ->with('success', 'تم تحديث بيانات السلاح بنجاح');
    }

    /**
     * Delete a specific club weapon.
     */
    public function destroy(Request $request, $cwid)
    {
        $this->clubsWeaponsService->deleteClubWeapon($cwid);
        $club_id = $request->input('cid');
        return redirect()->route('clubs-weapons.index', $club_id)
            ->with('success', 'تم حذف السلاح من النادي');
    }

    /**
     * Toggle active status.
     */
    public function toggleStatus(Request $request, $cwid)
    {
        $this->clubsWeaponsService->toggleClubWeaponStatus($cwid);
        $club_id = $request->input('cid'); // Get club_id from hidden input

        return redirect()->route('clubs-weapons.index', $club_id)
            ->with('success', 'تم تحديث حالة السلاح');
    }
}
