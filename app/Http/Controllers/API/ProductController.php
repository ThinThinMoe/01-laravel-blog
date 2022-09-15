<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest('id')->get();
        return ProductResource::collection($products);
    }

    public function store(ProductStoreRequest $request)
    {
        return Product::create($request->only('name','price'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        if(!$product) {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }

        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        if(! $product) {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }
        $product->update($request->only('name','price'));
        return response()->json([], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(! $product) {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }
        $product->delete();
        return response()->json([], Response::HTTP_OK);
    }
}
