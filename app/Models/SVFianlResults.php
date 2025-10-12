<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SVFianlResults extends Model
{
    protected $table='sv_fianl_results';

    protected $fillable = [
        'Rid',
        'date',
        'weapon_id',
        'details',
        'file',
        'confirmed',
    ];

    // One report has many player results
    public function players_results()
    {
        return $this->hasMany(SVFianlResultsPlayer::class, 'Rid');
    }

    // Each report belongs to one weapon
    public function weapon()
    {
        return $this->belongsTo(Sv_weapons::class, 'weapon_id', 'wid');
    }

}
