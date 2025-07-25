<?php
namespace App\Enums;
enum RoleEnum:string
{
    case ADMIN='admin';
    case CUSTOMER='customer';
    case PROVIDER='provider';


    public function guard()
{
    return match($this)
    {
        self::ADMIN=>'admin',
        self::CUSTOMER =>'customer',
        self::PROVIDER =>'provider',
    };

}
}

