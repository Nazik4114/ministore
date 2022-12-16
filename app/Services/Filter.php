<?php

namespace App\Services;


class Filter
{
    protected $filters=[
        'category'=>CategoryFilter::class,
        'price'=>PriceFilter::class,
        'brand'=>BrandFilter::class,
    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance->filtered($query, $value);
        }

        return $query;
    }

    public function getFilters()
    {
        $array=[];
        foreach ($this->filters as $key=>$value)
        {
            $filter=new $this->filters[$key];
           $array[]=$filter->getFilters();
        }
        return $array;
    }

    public function receivedFilters()
    {
        return request()->only(array_keys($this->filters));
    }
}
