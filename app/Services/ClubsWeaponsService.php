<?php

namespace App\Services;

use App\Models\Sv_clubs_weapons;

class ClubsWeaponsService
{
    public function __construct()
    {
    }

    /**
     * Get all weapons for a specific club.
     */
    public function getClubsWeaponsByClubId($clubId)
    {
        return Sv_clubs_weapons::where('cid', $clubId)->get();
    }

    /**
     * Get a specific club weapon by club + weapon IDs.
     */
    public function getClubWeapon($clubId, $weaponId)
    {
        return Sv_clubs_weapons::where('cid', $clubId)
            ->where('wid', $weaponId)
            ->firstOrFail();
    }

    /**
     * Create a new club weapon record.
     */
    public function createClubWeapon(array $data)
    {
        return Sv_clubs_weapons::create($data);
    }

    /**
     * Update a club weapon record by composite keys.
     */
    public function updateClubWeapon($clubId, $weaponId, array $data)
    {
        $clubWeapon = $this->getClubWeapon($clubId, $weaponId);
        $clubWeapon->update($data);

        return $clubWeapon;
    }

    /**
     * Delete a club weapon record by composite keys.
     */
    public function deleteClubWeapon($clubId, $weaponId)
    {
        $clubWeapon = $this->getClubWeapon($clubId, $weaponId);
        return $clubWeapon->delete();
    }

    /**
     * Toggle active status.
     */
    public function toggleClubWeaponStatus($clubId, $weaponId)
    {
        $clubWeapon = $this->getClubWeapon($clubId, $weaponId);
        $clubWeapon->active = !$clubWeapon->active;
        $clubWeapon->save();

        return $clubWeapon;
    }
}
