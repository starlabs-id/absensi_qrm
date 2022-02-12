<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatDetail extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'chat_id', 'komentar', 'pengirim'
    ];
            
    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}