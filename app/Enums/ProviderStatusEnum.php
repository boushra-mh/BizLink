<?php

namespace App\Enums;

enum ProviderStatusEnum:string
{
    case APPROVED ='approved';
    case CANCELED='canceled';
    case PENDING ='pending';

}
