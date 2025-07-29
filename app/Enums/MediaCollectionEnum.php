<?php

namespace App\Enums;

enum MediaCollectionEnum:string
{
       case CATEGORY_IMAGE = 'category_images';
    case SUBCATEGORY_IMAGE = 'subcategory_images';
    case PROVIDER_LOGO = 'provider_logo';
    case PROVIDER_GALLERY = 'provider_gallery';
}
