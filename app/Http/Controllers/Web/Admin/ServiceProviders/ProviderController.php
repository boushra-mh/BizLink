<?php

namespace App\Http\Controllers\Web\Admin\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\ServiceProviders\StoreProviderRequest;
use App\Http\Requests\Web\Admin\ServiceProviders\UpdateProviderRequest;
use App\Models\City;
use App\Models\Provider;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Services\Web\Admin\ServiceProviders\ProviderService;


class ProviderController extends Controller
{
    protected $serviceProvider;

    public function __construct(ProviderService $providerService)
    {
        $this->serviceProvider=$providerService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers=$this->serviceProvider->getAll();
        return view('admin.providers.index',compact( 'providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
   
public function create()
{
    $subCategories = SubCategory::active()->get();
    $cities = City::active()->get();
    $tags = Tag::active()->get();

    return view('admin.providers.create', compact('subCategories', 'cities', 'tags'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProviderRequest $request)
    {
        $provider=$this->serviceProvider->create($request->validated());

        return redirect()->route('admin.providers.index')->with('success', 'Provider created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $provider = $this->serviceProvider->getById($id);

    $subCategories = SubCategory::active()->get();
    $cities = City::active()->get();
    $tags = Tag::active()->get();

    return view('admin.providers.edit', compact('provider', 'subCategories', 'cities', 'tags'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $this->serviceProvider->update($request->validated(),$provider);
        return redirect()->route('admin.providers.index')->with('success', 'Provider updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        $this->serviceProvider->delete($provider);
        return redirect()->route('admin.providers.index')->with('success', 'Provider deleted successfully!');
    }
}
