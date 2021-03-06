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
        'projek_id', 'nama_pekerjaan', 'status', 'keterangan', 'lokasi', 'shift', 'jam', 'foto_1', 'foto_2', 'edit_by'
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