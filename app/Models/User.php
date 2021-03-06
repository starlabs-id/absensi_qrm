<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'foto', 'ttd', 'no_telp_hp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($foto)
    {
        return asset('storage/user/' . $foto);
    }

    public function absen()
    {
        return $this->belongsTo(Absen::class);
    }

    public function absen_lembur()
    {
        return $this->belongsTo(AbsenLembur::class);
    }

    public function projek()
    {
        return $this->belongsTo(Projek::class);
    }

    public function detail_projek()
    {
        return $this->belongsTo(DetailProjek::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function chat_detail()
    {
        return $this->belongsTo(Chat::class);
    }

    public function tukang()
    {
        return $this->belongsTo(Tukang::class);
    }

    
    public function getAvatarUrlAttribute()
    {
    if($this->foto != null) :
        return asset('storage/user/' . $this->foto);
    else :
        return 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $this->name) . '&background=4e73df&color=ffffff&size=100';
    endif;
    }
}
