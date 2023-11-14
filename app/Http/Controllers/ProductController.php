<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $query = [];
        $products = Product::with('brand', 'category');
        if ($request->query()) {
            foreach ($request->query() as $key => $value) {
                if ($key == "search") {
                    $query[] = ["title", 'like', "%$value%"];
                } else if ($key == "brand" || $key == "category") {
                    $products->whereHas($key, function ($q) use ($value) {
                        $q->where('title', 'like', "%$value%");
                    });
                } else if (!Schema::hasColumn('products', $key) && ($key == "brand" || $key == "category")) {
                    continue;
                } else {
                    $query[] = [$key, '=', $value];
                }
            }
            $products = $products->where($query)->get();
            return new ProductCollection($products);
        } else {
            return new ProductCollection(Product::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request) {
        $validated = $request->validated();
        $product = Product::create($validated);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product) {
        $validated = $request->validated();
        $product->update($validated);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) {
        $product->delete();
        return response(['message' => 'deleted succesfully'], 200);
    }
}
