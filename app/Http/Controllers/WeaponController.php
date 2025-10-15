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
        if(!checkModulePermission('weapons', 'view')) {   return redirect()->route('access_denied');  }
        $weapons = $this->weaponService->getAllPersonalWeapons();
        return view('weapon.index', compact('weapons'));
    }

    public function store(StoreWeaponRequest $request)
    {
         if(!checkModulePermission('weapons', 'add')) {   return redirect()->route('access_denied');  }
        $this->weaponService->createWeapon($request->validated());
        return redirect()->route('weapons.index')->with('success', 'Weapon created successfully');
    }

    public function edit($id)
    {
         if(!checkModulePermission('weapons', 'edit')) {   return redirect()->route('access_denied');  }
        $weapon = $this->weaponService->getWeaponById($id);
        if (!$weapon) {
            return redirect()->route('weapons.index')->with('error', 'Weapon not found');
        }
        return view('weapon.edit', compact('weapon'));
    }
    public function update(StoreWeaponRequest $request, $id)
    {
         if(!checkModulePermission('weapons', 'edit')) {   return redirect()->route('access_denied');  }
        $weapon = $this->weaponService->getWeaponById($id);
        if (!$weapon) {
            return redirect()->route('weapons.index')->with('error', 'Weapon not found');
        }

        $weapon->update($request->validated());
        return redirect()->route('weapons.index')->with('success', 'Weapon updated successfully');
    }
    public function destroy($id)
    {
         if(!checkModulePermission('weapons', 'delete')) {   return redirect()->route('access_denied');  }
        $weapon = $this->weaponService->getWeaponById($id);
        if (!$weapon) {
            return redirect()->route('weapons.index')->with('error', 'Weapon not found');
        }

        $weapon->delete();
        return redirect()->route('weapons.index')->with('success', 'Weapon deleted successfully');
    }
}
