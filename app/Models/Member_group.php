<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member_group extends Model
{
    protected $table='member_groups';
    protected $primaryKey='mgid';
    protected $fillable=['name'];
}
