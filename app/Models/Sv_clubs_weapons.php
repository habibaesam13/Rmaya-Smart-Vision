<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sv_clubs_weapons extends Model
{
    protected $table = "sv_clubs_weapons";
    protected $primaryKey = "cwid";
    protected $fillable = [
        "cid",
        "wid",
        "gender",
        "age_from",
        "age_to",
        "success_degree",
        "active"
    ];

    protected $casts = [
        "age_to" => "integer",
        "age_from" => "integer",
        "success_degree" => "integer",
        "active" => "boolean"
    ];
    public function weapon()
{
    return $this->belongsTo(Sv_weapons::class, 'wid', 'wid');
}

}
