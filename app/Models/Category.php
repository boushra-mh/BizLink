<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
     use SoftDeletes;
    protected $fillable=['name','status','slug','icon'];
    protected $casts=['status'=>StatusEnum::class];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
