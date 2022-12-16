<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\Specification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $spec1=Specification::create([
            'key'=>'brand',
            'value'=>'Apple',
        ]);
        $spec2=Specification::create([
            'key'=>'brand',
            'value'=>'Samsung',
        ]);
        $spec3=Specification::create([
            'key'=>'brand',
            'value'=>'Xiaomi',
        ]);
        $spec4=Specification::create([
            'key'=>'brand',
            'value'=>'Sony',
        ]);
        $brands=[$spec1,$spec2,$spec3,$spec4];
        Category::factory(4)->hasAttached(Product::factory(5)->hasAttached(Specification::factory(1)))->create();

        foreach (Product::all() as $p)
        {
            $p->specifications()->attach($brands[rand(0,3)]);
        }

    }
}
