<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpecificationCollection;
use App\Models\Category;
use App\Models\Specification;
class SpecificationController extends Controller
{
    public function all(Category $category)
    {
        return new SpecificationCollection(Specification::query()->category($category)->dist()->get()) ;
    }

}
