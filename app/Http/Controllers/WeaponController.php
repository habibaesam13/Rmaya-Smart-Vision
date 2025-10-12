<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeaponRequest;
use App\Services\WeaponService;


class WeaponController extends Controller
{
    protected $weaponService;

    public function __construct(WeaponService $weaponService)
    {
        $this->weaponService = $weaponService;
    }

    public function index()
    {
        $weapons = $this->weaponService->getAllPersonalWeapons();
        return view('weapon.index', compact('weapons'));
    }

    public function store(StoreWeaponRequest $request)
    {
        $this->weaponService->createWeapon($request->validated());
        return redirect()->route('weapons.index')->with('success', 'Weapon created successfully');
    }

    public function edit($id)
    {
        $weapon = $this->weaponService->getWeaponById($id);
        if (!$weapon) {
            return redirect()->route('weapons.index')->with('error', 'Weapon not found');
        }
        return view('weapon.edit', compact('weapon'));
    }
    public function update(StoreWeaponRequest $request, $id)
    {
        $weapon = $this->weaponService->getWeaponById($id);
        if (!$weapon) {
            return redirect()->route('weapons.index')->with('error', 'Weapon not found');
        }

        $weapon->update($request->validated());
        return redirect()->route('weapons.index')->with('success', 'Weapon updated successfully');
    }
    public function destroy($id)
    {
        $weapon = $this->weaponService->getWeaponById($id);
        if (!$weapon) {
            return redirect()->route('weapons.index')->with('error', 'Weapon not found');
        }

        $weapon->delete();
        return redirect()->route('weapons.index')->with('success', 'Weapon deleted successfully');
    }
}
