<?php

namespace App\Services;

use App\Models\Category;

class CategoryFilter
{
public function __invoke()
{
    function __invoke($query, Category $category)
    {
        return $query->whereHas('categories', function ($query) use ($category) {
            $query->where('id', $category->id);
        });
    }
}

}
