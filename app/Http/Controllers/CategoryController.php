<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return new CategoryCollection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request) {
        //
        $validated = $request->validated();
        $category = Category::create($validated);
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category) {
        $validated = $request->validated();
        $category->update($validated);
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) {
        $category->delete();
        return new CategoryResource($category);
    }
}
