<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SubCategory extends Model implements HasMedia
{
    use SoftDeletes , InteractsWithMedia;
      protected $fillable=['name','status','description','category_id'];
    protected $casts=['status'=>StatusEnum::class];
    public function category()
{
    return $this->belongsTo(Category::class);
}
public function providers()
{
    return $this->belongsToMany(Provider::class, 'provider_sub_category');
}
      public function registerMediaCollections(): void
    {
        $this->addMediaCollection('sub_category_images')->singleFile();
    }



}
