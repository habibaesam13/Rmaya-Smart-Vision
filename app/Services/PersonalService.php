<?php

namespace App\Services;

use App\Models\Member_group;

class PersonalService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function get_members_data(){
        $Membergroups=Member_group::all();
        return $Membergroups;

    }
}
