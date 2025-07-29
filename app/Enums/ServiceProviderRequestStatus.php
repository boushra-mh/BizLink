<?php

namespace App\Enums;

enum ServiceProviderRequestStatus:string
{
       case READ = 'read';
    case UNREAD = 'unread';
}
