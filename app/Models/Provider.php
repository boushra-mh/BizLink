<?php

namespace App\Models;
use app\Enums\ProviderStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
 

class Provider extends Model implements HasMedia
{
    use SoftDeletes ,InteractsWithMedia;
     protected $fillable = [
        'name', 'shop_name', 'description', 'status',
        'phone', 'whatsapp', 'facebook', 'instagram',
         'views', 'start_date', 'end_date', 'location'
    ];
   
    protected $casts = [
        'status' => ProviderStatusEnum::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    public function subCategory()
{
    return $this->belongsTo(SubCategory::class, );
}
public function city()
{
    return $this->belongsTo(City::class,);
}

    public function tags() {
        return $this->belongsToMany(Tag::class, 'provider_tag');
    }


    public function registerMediaCollections(): void {
        $this->addMediaCollection('provider_image')->singleFile();
        $this->addMediaCollection('provider_gallery');
    }

    public function offers() {
        return $this->hasMany(Offer::class);
    }


}
