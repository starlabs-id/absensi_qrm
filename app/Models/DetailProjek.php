<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProjek extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'projek_id', 'uraian_pekerjaan', 'volume_kontrak', 'harga_satuan', 'volume_rencana', 'volume_sebelumnya', 'volume_pekerjaan_hari_ini', 'volume_dikerjakan', 'prestasi_keuangan_hari_ini', 'prestasi_fisik_hari_ini', 'tanggal', 'foto_1', 'foto_2', 'foto_3', 'foto_4', 'foto_5', 'foto_6', 'foto_7', 'foto_8', 'foto_9', 'foto_10', 'keterangan', 'edit_by'
    ];
            
    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */

    public function getImageAttribute($image)
    {
        return asset('storage/detail_projek/' . $image);
    }

    public function projek()
    {
        return $this->belongsTo(Projek::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}