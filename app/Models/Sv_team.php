<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sv_team extends Model
{
    protected $table = 'sv_teams';
    protected $primaryKey = 'tid';
    protected $fillable = [
        'name',
        'club_id',
        'weapon_id',
    ];
    public function club()
    {
        return $this->belongsTo(Sv_clubs::class, 'club_id', 'cid');
    }

    public function weapon()
    {
        return $this->belongsTo(Sv_weapons::class, 'weapon_id', 'wid');
    }
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
}
