<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sv_team extends Model
{
    protected $table='sv_teams';
    protected $primaryKey='tid';
    protected $fillable=[
        'name',
        'club_id',
        'weapon_id',
    ];
}
