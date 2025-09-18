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
    public function get_members_data()
    {
        $Membergroups = Member_group::all();
        $countries = $this->countriesService->get_all_countries();
        $clubs = $this->clubsService->getAllClubs();
        $weapons = $this->weaponsService->getAllWeapons();
        return [
            'Membergroups' => $Membergroups,
            'countries' => $countries,
            'clubs' => $clubs,
            'weapons' => $weapons
        ];
    }
    public function delete($id)
    {
        $member = Sv_member::findorfail($id);
        return $member->delete();
    }
    public function toggleActivation($id)
    {
        $member = Sv_member::findorfail($id);
        $member->active = !$member->active;
        $member->save();
        return $member;
    }
    public function updatePersonalData($data, $mid, Request $request)
    {
        Log::info('Update started', ['mid' => $mid, 'data' => $data]);

        $member = Sv_member::findOrFail($mid);

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
}
