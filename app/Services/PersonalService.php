<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Sv_member;
use App\Models\Member_group;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Services\WeaponService;
use App\Services\CountriesService;
use Illuminate\Support\Facades\Storage;



class PersonalService
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
    public function get_members_data()
    {
        $Membergroups = Member_group::all();
        $countries = $this->countriesService->getAllCountries();
        $clubs = $this->clubsService->getAllClubs();
        $weapons = $this->weaponsService->getAllPersonalWeapons();
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
    public function getMembers(Request $request,$pag,$club_id){
        $results= Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])->where('reg_type', 'personal')
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn($q) => $q->filter($request)
            )
            ->orderByDesc('mid');
        if($club_id !=null){
            $results= Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])->where('reg_type', 'personal')
            ->where('club_id',$club_id)
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn($q) => $q->filter($request)
            )
            ->orderByDesc('mid');
        }
        
        return $pag?$results->cursorPaginate(config('app.admin_pagination_number')):$results->get();
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
