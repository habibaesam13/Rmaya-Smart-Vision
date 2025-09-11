<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sv_clubs extends Model
{
    protected $table = 'sv_clubs';
    protected $primaryKey = 'cid';
    protected $fillable = ['name', 'active'];

     public function weapons()
    {
        return $this->belongsToMany(
            Sv_weapons::class,
            'sv_clubs_weapons',   
            'cid',                
            'wid'                 
        )->withPivot(['gender', 'age_from', 'age_to', 'success_degree', 'active']); 
    }
}
