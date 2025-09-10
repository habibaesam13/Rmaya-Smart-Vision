<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sv_weapons extends Model
{
    protected $table = 'sv_weapons';
    protected $primaryKey = 'wid';
    protected $fillable = ['name'];
}
