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
        'projeck_id', 'tanggal', 'foto_1', 'foto_2', 'foto_3', 'foto_4', 'foto_5', 'foto_6', 'foto_7', 'foto_8', 'foto_9', 'foto_10', 'keterangan', 'uraian_pekerjaan', 'volume_rencana', 'volume_sebelumnya', 'volume_hari_ini', 'volume_opname', 'harga_satuan', 'opname_hari_ini', 'total_opname', 'persentase', 'edit_by'
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
}