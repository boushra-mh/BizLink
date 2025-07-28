<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\HasActive;
use App\Traits\HasFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 

class City extends Model
{
    use SoftDeletes ,HasFilters ,HasActive;
protected $fillable=['name','status','state_id'];
protected $casts=['status'=>StatusEnum::class];
public function state()
{
    return $this->belongsTo(State::class);
}
public function providers()
{
    return $this->hasMany(Provider::class,);
}
}
