<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SV_initial_results extends Model
{
    protected $table='sv_initial_results';
    protected $primaryKey='Rid';
    protected $fillable=[
        'date',
        'weapon_id',
        'attached_file',
        'details',
        'confirmed',
    ];
    protected $casts=[
        'confirmed'=>'boolean',
    ];
    // One report has many player results
    public function players_results()
    {
        return $this->hasMany(Sv_initial_results_players::class, 'Rid', 'Rid');
    }

    // Each report belongs to one weapon
    public function weapon()
    {
        return $this->belongsTo(Sv_weapons::class, 'weapon_id', 'wid');
    }
}
