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
        $weapons = $this->weaponsService->getAllWeapons();

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
    public function edit($club_id, $weapon_id)
    {
        $clubWeapon = $this->clubsWeaponsService->getClubWeapon($club_id, $weapon_id);
        $club = $this->clubsService->getClubById($club_id);
        $weapons = $this->weaponsService->getAllWeapons();

        return view('clubs_weapons.edit', compact('clubWeapon', 'club', 'weapons'));
    }

    /**
     * Update a specific club weapon.
     */
    public function update(Request $request, $club_id, $weapon_id)
    {
        $this->clubsWeaponsService->updateClubWeapon($club_id, $weapon_id, $request->all());

        return redirect()->route('clubs-weapons.index', $club_id)
            ->with('success', 'تم تحديث بيانات السلاح بنجاح');
    }

    /**
     * Delete a specific club weapon.
     */
    public function destroy($club_id, $weapon_id)
    {
        $this->clubsWeaponsService->deleteClubWeapon($club_id, $weapon_id);

        return redirect()->route('clubs-weapons.index', $club_id)
            ->with('success', 'تم حذف السلاح من النادي');
    }

    /**
     * Toggle active status.
     */
    public function toggleStatus($club_id, $weapon_id)
    {
        $this->clubsWeaponsService->toggleClubWeaponStatus($club_id, $weapon_id);

        return redirect()->route('clubs-weapons.index', $club_id)
            ->with('success', 'تم تحديث حالة السلاح');
    }
}
