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
}