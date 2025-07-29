<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\HasActive;
use App\Traits\HasFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
      use SoftDeletes, HasFilters ,HasActive;

    protected $fillable = ['name', 'status'];

    protected $casts = [
        'status' => StatusEnum::class,
    ];
   
    public function providers()
{
    return $this->belongsToMany(Provider::class, 'provider_tag');
}
}
