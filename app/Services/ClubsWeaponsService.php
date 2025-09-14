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
     * Get a specific club weapon record by composite keys.
     */
    public function getClubWeapon($cwid)
    {
        return Sv_clubs_weapons::findorfail($cwid);
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
    public function updateClubWeapon($cwid, array $data)
    {
        if(isset($data['age_to']) && $data['age_to'] < $data['age_from']) {
            throw new \InvalidArgumentException('The age_to must be greater than or equal to age_from.');
        }
        else if(isset($data['age_from']) && ( $data['age_from'] < 0 || $data['age_from'] > 100)) {
            throw new \InvalidArgumentException('The age_from must be between 0 and 100.');
        }
        else if(isset($data['age_to']) && ( $data['age_to'] < 0 || $data['age_to'] > 100)) {
            throw new \InvalidArgumentException('The age_to must be between 0 and 100.');
        }
        if($data['success_degree'] < 0 || $data['success_degree'] > 100) {
            throw new \InvalidArgumentException('The success_degree must be between 0 and 100.');
        }
        $clubWeapon = $this->getClubWeapon($cwid);
        $clubWeapon->update($data);

        return $clubWeapon;
    }

    /**
     * Delete a club weapon record by composite keys.
     */
    public function deleteClubWeapon($cwid)
    {
        $clubWeapon = $this->getClubWeapon($cwid);
        return $clubWeapon->delete();
    }

    /**
     * Toggle active status.
     */
    public function toggleClubWeaponStatus($cwid)
    {
        $clubWeapon = $this->getClubWeapon($cwid);
        $clubWeapon->active = !$clubWeapon->active;
        $clubWeapon->save();

        return $clubWeapon;
    }
}
