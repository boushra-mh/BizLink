<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
     use SoftDeletes;
    protected $fillable=['name','status','slug','icon'];
    protected $casts=['status'=>Status::class];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
