<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKerusakan extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_projeks', 'id_detail_projeks', 'nama_kerusakan', 'foto', 'harga', 'satuan', 'total_harga', 'volume', 'edit_by'
    ];
            
    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */

    public function users()
    {
        return $this->hasMany(User::class);
    }
}