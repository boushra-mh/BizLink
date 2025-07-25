<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

class Customer extends Authenticatable
{
    use SoftDeletes ,HasRoles;
     protected $fillable=['first_name','last_name','phone','password','state_id','city_id','is_verified','is_active'];
}
