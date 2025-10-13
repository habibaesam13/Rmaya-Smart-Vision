<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SVFianlResultsPlayer extends Model
{
    protected $table = 'sv_fianl_results_players';

    protected $fillable = [
        'Rid',
        'player_id',
        'goal',
        'total',
        'notes',

    ];

    public function player()
    {
        return $this->belongsTo(Sv_member::class, 'player_id', 'mid');
    }

}
