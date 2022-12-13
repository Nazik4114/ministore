<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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
//        return $query->distinct()->select('key')->get();
        return $query->selectRaw('`key`,`value`, COUNT(`key`) as count')
            ->groupBy(['key','value']);

    }
    public function scopeCategory($query,Category $category)
    {
        $ids=[];
        foreach ($category->products as $product) {
            $ids[]=$product->id;
        }
//        return $query->distinct()->select('key')->get();
        return $query->whereRelation('product',function($q)use($ids){$q->whereIn('id',$ids);});

    }

}
