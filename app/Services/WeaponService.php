<?php

namespace App\Services;
use App\Models\Sv_weapons;

class WeaponService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

 public function createWeapon(array $data)
    {
        return Sv_weapons::create([
            'name' => $data['name'],
        ]);
    }

    public function getAllWeapons()
    {
        return Sv_weapons::all();
    }
    public function getWeaponById($id)
    {
        return Sv_weapons::findOrFail($id);
    }
    public function updateWeapon($id, array $data)
    {
        $weapon = Sv_weapons::findOrFail($id);
        $weapon->update($data);
        return $weapon;
    }
    function deleteWeapon($id)
    {
        $weapon = Sv_weapons::findOrFail($id);
        return $weapon->delete();
    }



}
