<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class State extends Model
{
    use SoftDeletes;
protected $fillable=['name','status'];
protected $casts=['status'=>StatusEnum::class];
public function cities()
{
    return $this->hasMany(City::class);
}

}
