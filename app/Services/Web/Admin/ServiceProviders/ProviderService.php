<?php
namespace App\Services\Web\Admin\ServiceProviders;

use App\Models\Provider;

class ProviderService
{
    public function getAll()
    {
        return Provider::all();
    }

    public function create(array $data)
    {
        $provider=Provider::create([
            

        ]);
    }
}