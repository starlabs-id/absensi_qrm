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
        'projek_id'
    ];
            
    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */
}