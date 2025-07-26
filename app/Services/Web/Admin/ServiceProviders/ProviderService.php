<?php
namespace App\Services\Web\Admin\ServiceProviders;

use App\Enums\ProviderStatusEnum;
use App\Models\Provider;

class ProviderService
{

    public function getProviderById($id)
    {
        return Provider::findOrFail($id);
    }
    public function getAll()
    {
       return Provider::latest()->get();
    }

    public function create(array $data)
    {
        $provider = Provider::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'phone' => $data['phone'],
            'whatsapp' => $data['whatsapp'],
            'facebook' => $data['facebook'],
            'instagram' => $data['instagram'],
            'location' => $data['location'],
            'sub_category_id' => $data['sub_category_id'],
            'status' => ProviderStatusEnum::PENDING
        ]);
        return $provider;
    }

    public function edit(array $data ,$id)

    {
       $provider= $this->getProviderById($id);
       $provider->update($data);
       return $provider;

    }

    public function delete($id)
    {
        $this->getProviderById($id)->delete();
    }

}
