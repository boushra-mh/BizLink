<?php

namespace App\Enums;

enum ProviderPermissionEnum:string
{
      case VIEW_OWN_PROFILE = 'view_own_profile';
    case UPDATE_OWN_PROFILE = 'update_own_profile';
    case CREATE_OFFER = 'create_offer';
    case UPDATE_OFFER = 'update_offer';
    case VIEW_OWN_OFFERS = 'view_own_offers';
    case RECEIVE_BOOKINGS = 'receive_bookings';
    case UPDATE_BOOKING_STATUS = 'update_booking_status';
    case VIEW_RATINGS = 'view_ratings';
    case RESPOND_TO_RATINGS = 'respond_to_ratings';
    case VIEW_NOTIFICATIONS = 'view_notifications';
    case SEARCH = 'search';

    public function role()
    {
        return 'provider';
    }


}
