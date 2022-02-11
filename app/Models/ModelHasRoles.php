<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHasRoles extends Model
{
    protected $guard = [];
    protected $table = 'model_has_roles';
}