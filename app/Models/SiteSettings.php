<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'secondary_logo',
        'company_name','company_name_ar',
        'company_department_name',
        'phone',
        'whatsapp',
        'address',
        'email',
        'google_play_icon',
        'appstore_icon',
        'appstore_link',
        'google_play_link'
    ];
}
