<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    protected $guard = [];
    protected $table = 'permissions';
    protected $fillable = [
        'name', 'web'
    ];
}