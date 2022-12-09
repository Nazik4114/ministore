<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Product $product)
    {
//        dd($product->categories);
        return new ProductResource($product);
    }

    public function all()
    {
        return new ProductCollection(Product::all());
    }

    public function store(Request $request)
    {
        $product=Product::create($request->all());
        return new ProductResource($product);
    }

    public function attachCategory(Product $product,Category $category)
    {

        $product->categories()->attach($category);
        return new ProductResource($product);

    }

}
