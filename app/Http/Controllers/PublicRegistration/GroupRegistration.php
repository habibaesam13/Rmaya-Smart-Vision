<?php

namespace App\Http\Controllers\PublicRegistration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\GroupRegistrationRequest;
use App\Services\GroupService;
use App\Services\WeaponService;
use Illuminate\Http\Request;

class GroupRegistration extends Controller
{
    protected WeaponService $weaponService;
    protected GroupService $groupService;
    public function __construct(WeaponService $weaponService,GroupService $groupService)
    {
        $this->weaponService=$weaponService;
        $this->groupService=$groupService;
        
    }
    public function index(){
        $groupsWeapons=$this->weaponService->getAllGroupWeapons();
        return view('PublicRegistration.GroupRegForm',['weapons'=>$groupsWeapons,'oldTempFiles' => session('temp_files', [])]);
    }
    public function store(GroupRegistrationRequest $request){
        $data = $request->validated();
        $team= $this->groupService->createNewGroup($request,$data);
        //dd($team);
        if($team){
            return redirect()->back()->with('success','تم تسجيل الفريق بنجاح');
            
        }
        return redirect()->back()->with('error','حدث خطأ أتناء التسجيل');
    }
}
