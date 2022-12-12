<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;
    protected $fillable=[ 'key', 'value' ];

    public function product()
    {
        return $this->belongsToMany(Product::class,'product_specification',);
    }
    public function scopeDist($query)
    {
        return $query->distinct()->select('key')->get();
    }
}
