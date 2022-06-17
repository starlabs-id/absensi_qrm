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
        'tanggal', 'uraian_pekerjaan', 'status_pekerjaan', 'approval_app', 'komen_app', 'tanggal_approval_app', 'approval_ap1', 'komen_ap1', 'tanggal_approval_ap1', 'approval_pm', 'tanggal_approval_pm', 'edit_by', 'approval_pm_id', 'approval_app_id', 'approval_ap1_id'
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