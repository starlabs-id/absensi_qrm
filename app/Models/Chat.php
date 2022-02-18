<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'projek_id', 'direktur_utama', 'superadmin', 'owner', 'direktur_teknik', 'admin_teknik', 'pm', 'marketing', 'gm', 'co_gm', 'supervisor'
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

    public function chat_detail()
    {
        return $this->hasMany(ChatDetail::class);
    }
}