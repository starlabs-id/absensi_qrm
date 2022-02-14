<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'lokasi_datang', 'longitude_datang', 'latitude_datang', 'ttd', 'jam_datang', 'tanggal_datang', 'hari_datang', 'bulan_datang', 'tahun_datang', 'lokasi_pulang',  'longitude_pulang', 'latitude_pulang', 'jam_pulang', 'tanggal_pulang', 'hari_pulang', 'bulan_pulang', 'tahun_pulang', 'keterangan', 'foto', 'validasi', 'jam_validasi', 'validasi_by', 'status', 'projek_id', 'user_id', 'tukang_id', 'edit_by'
    ];
            
    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */

    public function getImageAttribute($image)
    {
        return asset('storage/absen/' . $image);
    }

    public function projek()
    {
        return $this->belongsTo(Projek::class);
    }

    public function tukang()
    {
        return $this->belongsTo(Tukang::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}