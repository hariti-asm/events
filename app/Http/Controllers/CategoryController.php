<?php

namespace App\Http\Controllers;

use App\Models\Category; 

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
   
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::create($validatedData);

        return redirect()->route('admin.index')->with('success', 'Category created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated(); 
    
        $category->update($validatedData);
    
        return redirect()->route('admin.index')->with('success', 'Category updated successfully.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.index')->with('success', 'Category deleted successfully.');
    }
    
}
