<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_projek', 'kode_projek', 'area_projek', 'nomor_kontrak', 'tanggal_kontrak', 'judul_kontrak', 'nilai_kontrak', 'durasi_kontrak', 'lokasi', 'pemberi_kerja', 'pm', 'marketing', 'supervisor', 'rencana_kerja', 'owner', 'tanggal_mulai', 'tanggal_selesai', 'total_volume_kontrak', 'total_harga_satuan', 'total_volume_pekerjaan_sebelumnya', 'total_volume_pekerjaan_hari_ini', 'total_prestasi_keuangan', 'total_prestasi_fisik', 'status', 'edit_by'
    ];
            
    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */

     public function detail_projek()
     {
         return $this->hasMany(Projek::class);
     }

     public function absen()
     {
         return $this->hasMany(Absen::class);
     }

     public function absen_lembur()
     {
         return $this->hasMany(AbsenLembur::class);
     }

     public function tukang()
     {
         return $this->hasMany(Tukang::class);
     }

     public function users()
     {
         return $this->hasMany(User::class);
     }

     public function chat()
     {
         return $this->hasMany(Chat::class);
     }
}