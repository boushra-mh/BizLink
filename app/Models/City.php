<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 

class City extends Model
{
    use SoftDeletes;
protected $fillable=['name','status','state_id'];
protected $casts=['status'=>StatusEnum::class];
public function state()
{
    return $this->belongsTo(State::class);
}
}
