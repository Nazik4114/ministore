<?php

namespace App\Services;

use App\Http\Resources\CategoryFilterCollection;
use App\Models\Category;
use App\Models\Specification;

class PriceFilter extends BaseFilter
{
    protected $view='range';

    protected $name='price';

    public function filtered($query, $range)
    {
        $r=explode(',',$range);
        return $query->whereRelation('specifications',function($q)use($r){
            $q->where('key','price')->whereBetween('value',[(int)$r[0],(int)$r[1]]);
        });
    }

    public function getFilters()
    {
        return [
            'name'=>$this->name,
            'type'=>$this->view,
            'max'=>Specification::maxPrice(),
            'min'=>Specification::minPrice(),
        ];
    }

}
