<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sv_initial_results_players extends Model
{
    protected $table = 'sv_initial_results_players';
    protected $fillable = [
        'Rid',
        'player_id',
        'goal',
        'total',
        'notes',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Dynamically push R1..R10 into fillable and casts
        for ($i = 1; $i <= 10; $i++) {
            $this->fillable[] = "R{$i}";
            $this->casts["R{$i}"] = 'integer';
        }
        $this->casts["total"] = 'integer';
    }

    // Each player result belongs to ONE report
    public function report()
    {
        return $this->belongsTo(Sv_initial_results::class, 'Rid', 'Rid');
    }

    // Each player result belongs to ONE player
    public function player()
    {
        return $this->belongsTo(Sv_member::class, 'player_id', 'mid');
    }
   
}
