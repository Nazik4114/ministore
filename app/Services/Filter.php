<?php

namespace App\Services;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Faker\Provider\Biased;
use Illuminate\Http\Request;

class Filter
{
    protected $filters;
    public function __construct($filters)
    {
        $this->filters=$filters;
    }

    public function filter()
    {
        $products=Product::all();
        $fp=[];
        foreach ($products as $p)
        {
            if($this->check($p,$this->filters))
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
        return $fp;
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
