<?php
namespace App\Enums;

enum CustomerPermissionEnum:string
{
    case VIEW_CATEGORIES='view_categories';
    case VIEW_PROVIDERS ='view_providers';
    case BOOK_SERVICE='book_service';
    case RATE_PROVIDER='rate_provider';
    case VIEW_OWN_PROFILE='view_own_profile';
    case UPDATE_OWN_PROFILE='update_own_profile';
    case UPGRADE_TO_PROVIDER='upgrade_to_provider';

    public function role()

    {
        return  'customer';

    }
}

