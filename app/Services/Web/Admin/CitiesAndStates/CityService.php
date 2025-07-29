<?php
namespace App\Services\Web\Admin\CitiesAndStates;

use App\Enums\StatusEnum;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityService
{
    public function getCityById(City $city)
    {
        return $city;
    }

     public function getAll(Request $request)
{
    $query = City::query();

   
    if ($request->filled('name')) {
        $query->filterByName($request->input('name'));
    }

   
    if ($request->filled('status')) {
        $query->filterByStatus($request->input('status'));
    }


    if ($request->filled('state_id')) {
        $query->filterByRelation('state', 'id', $request->input('state_id'));
    }

    return $query->latest()->get();
}


    public function create(array $data)
    {
        $city = City::create([
            'name' => $data['name'],
            'state_id' => $data['state_id'],
            'status' => StatusEnum::ACTIVE->value
        ]);
        return $city;
    }

    public function update(array $data, City $city)
    {
        $city = $this->getCityById($city);
       
        $city->update([
            'name' => $data['name'],
            'state_id' => $data['state_id'],
            'status' => $data['status'] ?? $city->status
        ]);
        return $city;
    }

    public function delete(city $city)
    {
        $this->getcityById($city)->delete();
    }
}
