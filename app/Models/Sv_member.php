<?php

namespace App\Models;

use App\Models\Sv_team;

use Illuminate\Database\Eloquent\Model;

class Sv_member extends Model 
{
    protected $table = 'sv_members';
    protected $primaryKey = 'mid';
    public $timestamps = true;

    protected $fillable = [
        'reg_type',
        'team_id',
        'name',
        'ID',
        'Id_expire_date',
        'dob',
        'nat',
        'gender',
        'club_id',
        'weapon_id',
        'phone1',
        'phone2',
        'front_id_pic',
        'back_id_pic',
        'active',
        'mgid',
        'reg_club',
    ];

    
    public function team()
    {
        return $this->belongsTo(Sv_team::class, 'team_id', 'tid');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nat', 'id');
    }

    public function club()
    {
        return $this->belongsTo(Sv_clubs::class, 'club_id', 'cid');
    }

    public function weapon()
    {
        return $this->belongsTo(Sv_weapons::class, 'weapon_id', 'wid');
    }
}
