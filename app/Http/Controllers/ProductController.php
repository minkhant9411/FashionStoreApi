<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = [];
        $products = Product::with('brand', 'category');
        if ($request->query()) {

            // if ($request->has('author_name')) {
            //     $posts->whereHas('author', function ($query) use ($request) {
            //         $query->where('name', 'like', '%' . $request->input('author_name') . '%');
            //     });
            // }

            // // Filter by book date
            // if ($request->has('book_date')) {
            //     $posts->whereDate('book_date', $request->input('book_date'));
            // }

            // // Retrieve the filtered posts
            // $filteredPosts = $posts->get();




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
            $products = $products->where($query)->paginate(5);
            return new ProductCollection($products);
        } else {
            return new ProductCollection(Product::paginate(5));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create($validated);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response(['message' => 'deleted succesfully'], 200);
    }
}
