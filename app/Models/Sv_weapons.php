<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sv_weapons extends Model
{
    protected $table = 'sv_weapons';
    protected $primaryKey = 'wid';
    protected $fillable = ['name'];

    public function clubs()
    {
        return $this->belongsToMany(
            Sv_clubs::class,
            'sv_clubs_weapons',
            'wid', 
            'cid'
        )->withPivot(['gender', 'age_from', 'age_to', 'success_degree', 'active']);
    }
}
