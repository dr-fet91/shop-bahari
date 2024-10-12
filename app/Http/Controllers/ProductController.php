<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->filled('per_page') && is_numeric($request->input('per_page')) ? $request->input('per_page') : 10;
        $validSortByOptions = ['name', 'title', 'price', 'created_at', 'updated_at'];
        $sortBy = $request->filled('sortBy') && in_array($request->input('sortBy'), $validSortByOptions)
            ? $request->input('sortBy')
            : 'title';
        $validSortOrderOptions = ['ASC', 'DESC'];
        $sortOrder = $request->filled('sortOrder') && in_array($request->input('sortOrder'), $validSortOrderOptions)
            ? $request->input('sortOrder')
            : 'DESC';
        $search = $request->filled('search') ? $request->input('search') : '';
        $addType = $request->filled('add_type') && in_array($request->input('add_type'), ['sele', 'buy'])
            ? $request->input('add_type')
            : '';
        $productsQuery = Product::orderBy($sortBy, $sortOrder);
        if (!empty($search)) {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            });
        }
        if (!empty($addType)) {
            $productsQuery->where('add_type', $addType);
        }
        $products = $productsQuery->paginate($perPage);
        return new ProductCollection($products);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'message' => 'product create successfully',
            'data' => new ProductResource($product),
        ]);
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
        $product->update($request->all());

        return response()->json([
            'message' => 'product update successfully',
            'data' => new ProductResource($product),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'product delete successfully',
        ]);
    }
}
