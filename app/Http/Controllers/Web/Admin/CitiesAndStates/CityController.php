<?php

namespace App\Http\Controllers\Web\Admin\CitiesAndStates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\CitiesAndStates\CityRequest;
use App\Models\State;
use App\Models\City;
use App\Services\Web\Admin\CitiesAndStates\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities = $this->cityService->getAll($request);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // جلب الولايات النشطة فقط لعرضها في Dropdown
        $activeStates = State::active()->get();
        return view('admin.cities.create', compact('activeStates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $this->cityService->create($request->validated());
        return redirect()->route('admin.cities.index')->with('success', 'City created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $city = $this->cityService->getCityById(City::findOrFail($id));
        return view('admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $activeStates = State::active()->get();
        return view('admin.cities.edit', compact('city', 'activeStates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $this->cityService->update($request->validated(), $city);
        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $this->cityService->delete($city);
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully!');
    }
}
