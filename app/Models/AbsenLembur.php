<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenLembur extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'lokasi', 'ttd', 'jam_datang', 'tanggal_datang', 'hari_datang', 'bulan_datang', 'tahun_datang', 'lokasi_pulang', 'jam_pulang', 'tanggal_pulang', 'hari_pulang', 'bulan_pulang', 'tahun_pulang', 'keterangan', 'foto', 'validasi', 'jam_validasi', 'validasi_by', 'status', 'projek_id', 'user_id', 'tukang_id', 'total_biaya_lembur', 'edit_by'
    ];
            
    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */
    public function getImageAttribute($image)
    {
        return asset('storage/absen_lembur/' . $image);
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