<?php

namespace App\Services;

use App\Http\Resources\CategoryFilterCollection;
use App\Models\Category;

class CategoryFilter  extends BaseFilter
{
    protected $view='radiobutton';

    protected $name='category';

    public function filtered($query, $category)
    {
        return $query->whereRelation('categories','id','=', $category);
    }

    public function getFilters()
    {
        return [
            'name'=>$this->name,
            'type'=>$this->view,
            'filters'=>[ new CategoryFilterCollection(Category::dist()->get())]
        ];
    }

}
