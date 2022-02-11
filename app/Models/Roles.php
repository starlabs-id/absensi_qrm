<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $guard = [];
    protected $table = 'roles';
    protected $fillable = [
        'name', 'guard_name'
    ];
}
