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

    public function calculateTotal()
    {
        $sum = 0;
        for ($i = 1; $i <= 10; $i++) {
            $sum +=  $this->{"R{$i}"} ?? 0;
        }
        return $sum;
    }

    // Boot method to auto-update total before save
    protected static function booted()
    {
        static::saving(function ($member) {
            $member->total = $member->calculateTotal();
        });
    }

    // Accessor for displaying
    public function getTotalAttribute($value)
    {
        return $value ?? $this->calculateTotal();
    }
}
