<?php

namespace App\Services;
use App\Models\Sv_clubs;
class ClubService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAllClubs()
    {
        return Sv_clubs::all();
    }
    public function createClub(array $data)
    {
        return Sv_clubs::create($data);
    }
    public function getClubById($id)    
    {
        return Sv_clubs::findOrFail($id);
    }   
    public function updateClub($id, array $data)
    {
        $club = $this->getClubById($id);
        $club->update($data);
        return $club;
    }
    public function toggleActiveStatus($id)
    {
        $club = $this->getClubById($id);
        $club->active = !$club->active;
        $club->save();
        return $club;
    }
    public function deleteClub($id)
    {
        $club = $this->getClubById($id);
        return $club->delete();
    }

}
