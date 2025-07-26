<?php

namespace App\Http\Controllers\Web\Admin\CategoriesAndSubCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\CategoriesAndSubCategories\CategoryRequest;
use App\Models\Category;
use App\Services\Web\Admin\CategoriesAndSubCategories\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categryService=$categoryService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= $this->categryService->getAll();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->categryService->create($request->validated());
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category=$this->categryService->show($id);
        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=$this->categryService->getCategoryById($id);
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $id)
    {
        $this->categryService->update($request->validated(),$id);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $id)
    {
        $this->categryService->delete($id);
          return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
