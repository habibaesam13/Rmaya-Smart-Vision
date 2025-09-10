<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'module_code',
        'permissions',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class , 'role_id');
    }


}
