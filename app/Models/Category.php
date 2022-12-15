<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['name'];
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_category');
    }
    public function scopeDist($query)
    {
        return $query->select('name')->withCount('products as count');

    }
}
