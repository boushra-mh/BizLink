<?php

namespace App\Http\Controllers\Web\Admin\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\ServiceProviders\StoreProviderRequest;
use App\Http\Requests\Web\Admin\ServiceProviders\UpdateProviderRequest;
use App\Services\Web\Admin\ServiceProviders\ProviderService;
use Illuminate\Http\Request;

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
        return view('admin.providers.create');
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
    public function edit(string $id)
    {
          $provider = $this->serviceProvider->getProviderById($id);
        return view('admin.providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderRequest $request, string $id)
    {
        $this->serviceProvider->edit($request->validated(),$id);
        return redirect()->route('admin.providers.index')->with('success', 'Provider updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->serviceProvider->delete($id);
        return redirect()->route('admin.providers.index')->with('success', 'Provider deleted successfully!');
    }
}
