<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tukang extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'lokasi', 'biaya_lembur', 'user_id', 'edit_by'
    ];
            
    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */

    public function projek()
    {
        return $this->belongsTo(Projek::class);
    }

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }

    public function absen_lembur()
    {
        return $this->hasMany(AbsenLembur::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}