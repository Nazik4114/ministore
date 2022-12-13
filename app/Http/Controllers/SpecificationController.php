<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Specification;
class SpecificationController extends Controller
{
    public function all(Category $category)
    {
//        Product::query()->whereRelation('','','','')
//     return Specification::query()->dist()->get();
//        return Specification::query()->with(['product'=>function($query) use($category){
//            $query->with(['categories'=>function($q)use($category){
//                $q->where('id' , $category->id);
//            }]);
//    }])->get();

        return Specification::query()->category($category)->dist()->get();
    }
}
