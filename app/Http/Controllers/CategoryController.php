<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        return new CategoryResource($category->load('products'));
    }

    public function all()
    {
        return new CategoryCollection(Category::all()->load('products'));
    }

    public function store(Request $request)
    {
        $category=Category::create($request->all());
        return new CategoryResource($category);
    }

    public function attachCategory(Product $product,Category $category)
    {
            $category->products()->attach($product->id);
            return new CategoryResource($category->load('products'));
    }

}
