<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
      protected $fillable=['name','status','slug','category_id'];
    protected $casts=['status'=>Status::class];
    public function category()
{
    return $this->belongsTo(Category::class);
}
public function providers()
{
    return $this->belongsToMany(Provider::class, 'provider_sub_category');
}



}
