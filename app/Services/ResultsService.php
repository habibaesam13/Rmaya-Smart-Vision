<?php

namespace App\Services;

use App\Models\SV_initial_results;
use App\Models\Sv_member;
use Mpdf\Image\Svg;

class ResultsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function ValidateMemberSameWeapon($membersIds):bool{
        $weaponsCount=Sv_member::whereIn('id', $membersIds)
    ->distinct('weapon_id')
    ->count('weapon_id');
    return $weaponsCount===1;

    }
    public function createReport($data){

        $validatMembersWeapons=$this->ValidateMemberSameWeapon($data['checkedMembers']);
        if($validatMembersWeapons){
          return  SV_initial_results::create($data);
        }
        return false;
    }
}
