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
        'nama_projek', 'status', 'pm', 'marketing', 'supervisor', 'volume', 'rencana_kerja', 'lokasi', 'owner', 'tanggal_mulai', 'tanggal_selesai', 'edit_by'
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