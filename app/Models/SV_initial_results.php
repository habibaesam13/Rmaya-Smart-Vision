<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sv_initial_results extends Model
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
        'date'=>'date',
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
    public function date():Attribute{
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
}
