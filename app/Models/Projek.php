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
}