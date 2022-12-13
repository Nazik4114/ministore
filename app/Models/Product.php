<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[ 'title', 'description' ];
    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_category');
    }

    public function specifications()
    {
        return $this->belongsToMany(Specification::class,'product_specification');
    }
}
