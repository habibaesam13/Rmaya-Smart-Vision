<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sv_clubs extends Model
{
    protected $table = 'sv_clubs';
    protected $primaryKey = 'cid';
    protected $fillable = ['name', 'active'];
}
