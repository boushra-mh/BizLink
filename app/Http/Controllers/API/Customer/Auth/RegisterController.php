<?php

namespace App\Http\Controllers\API\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\Auth\RegisterRequest;
use App\Http\Resources\Api\Customer\Auth\RegisterResource;
use App\Services\CustomerService;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ResponceTrait;
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService=$customerService;
    }
     public function  register(RegisterRequest $request)
     {
        $customer=$this->customerService->register($request->validated());
        return $this->sendResponce(RegisterResource::make( $customer),
        __('Customer_Register'));

     }
}
