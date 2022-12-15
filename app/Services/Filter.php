<?php

namespace App\Services;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Faker\Provider\Biased;
use Illuminate\Http\Request;

class Filter
{
    protected $filter=[
        'category'=>CategoryFilter::class,
    ];

    protected $filters = [
        'price' => PriceFilter::class,
        'category' => CategoryFilter::class,
        'brand' => BrandFilter::class,
    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance($query, $value);
        }

        return $query;
    }


    public function receivedFilters()
    {
        return request()->only(array_keys($this->filters));
    }
}
