<?php

namespace App\Models;

use App\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasActive;
   
    public function providers()
{
    return $this->belongsToMany(Provider::class, 'provider_tag');
}
}
