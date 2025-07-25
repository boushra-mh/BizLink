<?php

namespace App\Models;
use app\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 

class Provider extends Model
{
    use SoftDeletes;
    protected $fillable=['name','status','phone','whatsapp','facebook','instagram','location','description','image','sub_category_id'];
    protected $casts=['status'=>StatusEnum::class];
    public function subCategories()
{
    return $this->belongsToMany(SubCategory::class, 'provider_sub_category');
}


}
