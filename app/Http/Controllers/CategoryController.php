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
        Category::create($validated);
        return response(['message' => 'created successful'], 201);
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
        return response(['message' => 'updated successfull'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) {
        $category->delete();
        return response(['message' => 'deleted successful'], 200);
    }
}
