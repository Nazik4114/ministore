<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryFilterCollection;
use App\Http\Resources\CategoryFilterResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Specification;
use App\Services\Filter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Product $product)
    {
//        dd($product->categories);
        return new ProductResource($product->load(['categories','specifications']));
    }

    public function all()
    {
        return new ProductCollection(Product::all()->load(['categories','specifications']));
    }

    public function store(Request $request)
    {
        $product=Product::create($request->all());
        return new ProductResource($product);
    }

    public function attachCategory(Product $product,Category $category)
    {

        $product->categories()->attach($category);
        return new ProductResource($product->load('categories'));

    }
    public function attachSpecifications(Product $product, Request $request)
    {
        $mas_id=[];
        foreach ($request->all() as $key=>$value)
        {
                $spec = Specification::create([
                    'key' => $key,
                    'value' => $value],
                );
                $mas_id[] = $spec->id;
            }
        $product->specifications()->attach($mas_id);
        return new ProductResource($product->load(['categories','specifications']));

    }
    public function filter(Filter $filter)
    {
        return new ProductCollection(Product::filter($filter)->get()->load('categories','specifications'));
    }

    public function getFilters(Filter $filter)
    {
        return $filter->getFilters();
    }
}
