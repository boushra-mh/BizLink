<?php

namespace App\Http\Controllers\Web\Admin\CategoriesAndSubCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\CategoriesAndSubCategories\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\Web\Admin\CategoriesAndSubCategories\SubCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;

class SubCategoryController extends Controller
{
    protected $subCategoryservice;
    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryservice=$subCategoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(HttpRequest $request)
    {
        $sub_categories=$this->subCategoryservice->getAll($request);
        return view('admin.sub_categories.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.sub_categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $this->subCategoryservice->create($request->validated());
           return redirect()->route('admin.sub_categories.index')->with('success', 'Sub_Category created successfully!');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sub_category=$this->subCategoryservice->show($id);
        return view('admin.sub_categories.show',compact('sub_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         
    $categories = Category::all();
        $sub_category=$this->subCategoryservice->getSubCategoryById($id);
        return view('admin.sub_categories.edit',compact('sub_category','categories'));

    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, SubCategory  $sub_category)
    {
        $this->subCategoryservice->update($request->validated(), $sub_category);
         return redirect()->route('admin.sub_categories.index')->with('success', 'Sub_Category updated successfully!');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory  $sub_category)
    {

        $this->subCategoryservice->delete( $sub_category);
         return redirect()->route('admin.sub_categories.index')->with('success', 'Sub_Category deleted successfully!');
        
    }
}
