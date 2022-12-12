<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Specification;
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
            $spec=Specification::create([
                'key'=>$key,
                'value'=>$value],
            );
            $mas_id[]=$spec->id;
        }
//        dd($mas_id);
        $product->specifications()->attach($mas_id);
        return new ProductResource($product->load(['categories','specifications']));

    }
    public function filter(Request $request)
    {
        $products=Product::all();
        $fp=[];
        foreach ($products as $p)
        {
            if($this->check($p,$request->all()))
            {
//                dd($p);
                $fp[]=$p->load('specifications');
            }
        }
//
//        foreach ($request->all() as $key=>$value)
//        {
//        $product=$product->specifications->where($key,$value);
//        }
        return new ProductCollection($fp);
    }

    public function check(Product $product, $mas)
    {
        $flag=false;
        $spec=$product->specifications->toArray();
        foreach ($mas as $key=>$value) {
            $flag=false;
            foreach ($spec as $item) {
//                dd(array_key_exists($key, $item));
                if (strcmp($item['key'],$key)==0) {
                    if (strcmp($item['value'],$value) ==0) {
                        $flag=true;
                    } else {
                        return false;
                    }
                }
            }
        }
        if($flag==false)
        {
            return false;
        }
        else{
            return true;
        }

    }
}
