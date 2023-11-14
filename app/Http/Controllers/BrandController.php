<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use App\Models\Brand;

class BrandController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return new BrandCollection(Brand::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request) {
        $validated = $request->validated();
        $brand = Brand::create($validated);
        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand) {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand) {
        $validated = $request->validated();
        $brand->update($validated);
        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand) {
        $brand->delete();
        return new BrandResource($brand);
    }
}
