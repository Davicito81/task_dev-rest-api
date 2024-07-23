<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        
        /*Product::create([
            'title' => 'Samsung galaxy s10',
            'description' => 'Mobile Phone from',
            'category' => 'Phone',
            'state' => true,
        ]);*/

        DB::table('products')->insert([
            [
                'title' => 'Samsung galaxy s10',
                'description' => 'Mobile Phone from',
                'category' => 'Phone',
                'state' => true,
                'created_at' => now(), 
            ],[
                'title' => 'Apple iPhone 13',
                'description' => 'Apple mobile phone',
                'category' => 'Phone',
                'state' => true, 
                'created_at' => now(), 
            ],[
                'title' => 'Apple watch 8',
                'description' => 'Apple Watch 8',
                'category' => 'Smartwatch',
                'state' => true, 
                'created_at' => now(), 
            ],[
                'title' => 'Apple air pods',
                'description' => 'ANC headphones from apple',
                'category' => 'Headphone',
                'state' => true, 
                'created_at' => now(), 
            ],
        ]);
    }
}
