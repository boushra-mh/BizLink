<?php
namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\InvalidLoginException;
use Spatie\Permission\Models\Role;

class CustomerService
{
    public function register(array $data): Customer
    {
        return DB::transaction(function () use ($data) {
            $customer = Customer::create([
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'phone'      => $data['phone'],
                'state_id'   => $data['state_id'],
                'city_id'    => $data['city_id'],
                'password'   => Hash::make($data['password']),
                'is_verified'=> false,
                'is_active'  => true,
            ]);

            $customer->assignRole(RoleEnum::CUSTOMER);
            DB::commit();

            // هنا ممكن ترسل رمز التحقق SMS أو email

            return $customer;
        });
    }

        public function login(array $data): ?Customer
{
    $customer = Customer::where('phone', $data['phone'])->first();

    if (!$customer || !Hash::check($data['password'], $customer->password)) {
      throw new InvalidLoginException(__('رقم الهاتف أو كلمة المرور غير صحيحة'));
    }

    if (!$customer->is_active) {
      
         throw new InvalidLoginException(__('الحساب غير مفعل، يرجى التواصل مع الدعم'));
    }

  
    $token = $customer->createToken('customer_token', ['customer'])->plainTextToken;


    $customer->access_token = $token;

    return $customer;
}

}
