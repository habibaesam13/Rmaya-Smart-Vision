<?php

namespace App\Services;

use App\Models\Sv_weapons;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Sv_member;
use App\Models\Member_group;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Services\WeaponService;
use App\Services\CountriesService;
use Illuminate\Support\Facades\Storage;



class AbsentPersonalService
{
    /**
     * Create a new class instance.
     */
    protected CountriesService $countriesService;
    protected ClubService $clubsService;
    protected WeaponService $weaponsService;
    public function __construct(CountriesService $countriesService, ClubService $clubsService, WeaponService $weaponsService)
    {
        $this->countriesService = $countriesService;
        $this->clubsService = $clubsService;
        $this->weaponsService = $weaponsService;
    }
    public function getMemberByID($mid){
        return Sv_member::findorfail($mid);
    }
    public function get_members_data($arr)
    {
        $arr = isset($arr) ? $arr : [];
        $Membergroups = DB::table('member_groups')->join('sv_members' , 'sv_members.mgid' , '='  , 'member_groups.mgid')->whereIn('sv_members.mid' , $arr)->get();
        $countries = $this->countriesService->getAllCountries();
//        $clubs = DB::table('sv_clubs')->leftJoin('sv_members' , 'sv_members.club_id' , '='  , 'sv_clubs.cid')->select('sv_clubs.name as name' , 'sv_clubs.*')->distinct()->whereIn('sv_members.mid' , $arr)->get();
        $weapons = $this->weaponsService->getAllPersonalWeapons();

//        $countries = $this->countriesService->getAllCountries();
        $clubs = $this->clubsService->getAllClubs();
//        $weapons = $this->weaponsService->getAllPersonalWeapons();
        return [
            'Membergroups' => $Membergroups,
            'countries' => $countries,
            'clubs' => $clubs,
            'weapons' => $weapons
        ];
    }
    public function delete($id)
    {
        $member = $this->getMemberByID($id);
        return $member->delete();
    }
    public function toggleActivation($id)
    {
        $member = $this->getMemberByID($id);
        $member->active = !$member->active;
        $member->save();
        return $member;
    }
    public function updatePersonalData($data, $mid, Request $request)
    {
        Log::info('Update started', ['mid' => $mid, 'data' => $data]);

        $member = $this->getMemberByID($mid);

        if ($request->hasFile('front_id_pic')) {
            Log::info('Updating front_id_pic');
            if ($member->front_id_pic && Storage::disk('public')->exists($member->front_id_pic)) {
                Storage::disk('public')->delete($member->front_id_pic);
            }

            $data['front_id_pic'] = $request->file('front_id_pic')->store('national_ids', 'public');
        }

        if ($request->hasFile('back_id_pic')) {
            Log::info('Updating back_id_pic');
            if ($member->back_id_pic && Storage::disk('public')->exists($member->back_id_pic)) {
                Storage::disk('public')->delete($member->back_id_pic);
            }

            $data['back_id_pic'] = $request->file('back_id_pic')->store('national_ids', 'public');
        }

        $member->update($data);

        Log::info('Update finished', ['member' => $member->id]);

        return $member;
    }
    public function RegisterNewMember($data,$request){

        if ($request->hasFile('front_id_pic')) {
            $data['front_id_pic'] = $request->file('front_id_pic')->store('national_ids', 'public');
        }

        if ($request->hasFile('back_id_pic')) {
            Log::info('Updating back_id_pic');
            $data['back_id_pic'] = $request->file('back_id_pic')->store('national_ids', 'public');
        }

        return Sv_member::create($data);

    }
}
