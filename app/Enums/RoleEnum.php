<?php 
namespace App\Enums;
enum RoleEnum:string
{
    case ADMIN='admin';
    case CUSTOMER='customer';


    public function guard()
{
    return match($this)
    {
        self::ADMIN=>'admin',
        self::CUSTOMER =>'customer',
    };
    
}
}

