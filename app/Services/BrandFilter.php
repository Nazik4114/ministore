<?php

namespace App\Services;

use App\Http\Resources\BrandResource;
use App\Models\Specification;

class BrandFilter extends BaseFilter
{
    protected $name='brand';

    protected $view='checkbox';

    public function filtered($query, $brand)
    {
        return $query->whereRelation('specifications', function($q)use($brand){
           $q->where('key','brand')->whereIn('value',explode(',',$brand)) ;
        });
    }

    public function getFilters()
    {
        return [
            'name'=>$this->name,
            'type'=>$this->view,
            'brands'=>[BrandResource::collection(Specification::brands()->get())],
        ];

    }
}
