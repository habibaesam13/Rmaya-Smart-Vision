<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClubWeaponRequest;
use App\Services\ClubsWeaponsService;
use App\Services\ClubService;
use App\Services\WeaponService;

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

    
    /**
     * Display a listing of the resource.
     */
    public function index($club_id)
    {
        $clubsWeapons = $this->clubsWeaponsService->getClubsWeaponsByClubId($club_id);
        $club = $this->clubsService->getClubById($club_id);
        $weapons = $this->weaponsService->getAllWeapons();//for add form

        return view('clubs_weapons.index', compact('clubsWeapons', 'club', 'weapons'));
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
        $clubWeapon = $this->clubsWeaponsService->getClubWeapon($cwid);
        if (!$clubWeapon) {
            return redirect()->back()->withErrors(['error' => 'السلاح غير موجود']);
        }
        $club = $this->clubsService->getClubById($clubWeapon->cid);
        $weapons = $this->weaponsService->getAllWeapons();

        return view('clubs_weapons.edit', compact('clubWeapon', 'club', 'weapons'));
    }

    /**
     * Update a specific club weapon.
     */
    public function update(Request $request, $cwid)
    {
        try{
            $this->clubsWeaponsService->updateClubWeapon($cwid, $request->all());
        }
        catch(\InvalidArgumentException $e) {
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