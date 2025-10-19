<?php

namespace App\Models;

use App\Models\Sv_team;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // <-- import Carbon

class Sv_member extends Model
{
    protected $table = 'sv_members';
    protected $primaryKey = 'mid';
    public $timestamps = true;

    protected $fillable = [
        'reg_type',
        'team_id',
        'name',
        'ID',
        'Id_expire_date',
        'dob',
        'nat',
        'gender',
        'club_id',
        'weapon_id',
        'phone1',
        'phone2',
        'front_id_pic',
        'back_id_pic',
        'active',
        'mgid',
        'reg_club',
        'registration_date',
    ];

    public function team()
    {
        return $this->belongsTo(Sv_team::class, 'team_id', 'tid');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nat', 'id');
    }

    public function club()
    {
        return $this->belongsTo(Sv_clubs::class, 'club_id', 'cid');
    }

    public function registrationClub()
    {
        return $this->belongsTo(Sv_clubs::class, 'reg_club', 'cid');
    }

    public function weapon()
    {
        return $this->belongsTo(Sv_weapons::class, 'weapon_id', 'wid');
    }
    public function member_group()
    {
        return $this->belongsTo(Member_group::class, 'mgid', 'mgid');
    }

    public function scopeFilter($query, $request)
    {
        return $query
            ->where('reg_type', 'personal')
            ->when($request->mgid, fn($q) => $q->where('mgid', $request->mgid))
            ->when($request->nat, fn($q) => $q->where('nat', $request->nat))
            ->when($request->club_id, fn($q) => $q->where('club_id', $request->club_id))
            ->when($request->weapon_id, fn($q) => $q->where('weapon_id', $request->weapon_id))
            ->when($request->q, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('name', 'like', "%{$request->q}%")
                        ->orWhere('ID', 'like', "%{$request->q}%")
                        ->orWhere('phone1', 'like', "%{$request->q}%")
                        ->orWhere('phone2', 'like', "%{$request->q}%");
                });
            })
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->when($request->active && $request->active !== 'all', fn($q) => $q->where('active', $request->active === 'true'))
            ->when($request->date_from, fn($q) => $q->whereDate('registration_date', '>=', $request->date_from))
            ->when($request->date_to, fn($q) => $q->whereDate('registration_date', '<=', $request->date_to))
            ->when($request->reg_club, fn($q) => $q->where('reg_club', $request->reg_club));
    }

    public function age_calculation()
    {
        return $this->dob ? Carbon::parse($this->dob)->age : null;
    }


    public function sv_initial_results()
    {
        return $this->hasMany(Sv_initial_results_players::class , 'player_id' , 'mid' );
    }

//    public function sv_final_results()
//    {
//        return $this->hasOne(SVFianlResultsPlayer::class , 'player_id' , 'mid' );
//    }
    public function sv_final_results()
    {
        return $this->hasMany(SVFianlResultsPlayer::class , 'player_id' , 'mid' );
    }

}
