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
        'lokasi', 'ttd', 'jam_datang', 'jam_pulang', 'tanggal', 'hari', 'bulan', 'tahun', 'keterangan', 'foto', 'validasi', 'jam_validasi', 'status', 'projek_id', 'user_id', 'tukang_id', 'volume_hari_ini', 'volume_opname', 'harga_satuan', 'opname_hari_ini', 'total_opname', 'persentase', 'edit_by'
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