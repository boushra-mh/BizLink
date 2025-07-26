<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Category extends Model implements HasMedia
{
     use SoftDeletes , InteractsWithMedia;
    protected $fillable=['name','status','description'];
    protected $casts=['status'=>StatusEnum::class];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
       public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category_images')->singleFile();
    }
}
