<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // BEGIN

      for ($i= 0 ; $i < 10; $i++) {
        DB::table('products')->insert([
            'user_id' => $i++,
            'product_name' => Str::random(6),
            'quantity' => rand(100,1000),
            'category'=>2,
            'sub_category'=>1,
            'brand'=>3,
            'product_price'=>rand(100,1000),
            'description'=>Str::words('Perfectly balanced, as all things should be.'),
            'point'=>rand(100,1000),
            'approval'=>1,
            'approvedby'=>1,
            'activation'=>1,
            'photo'=>'1.jpg'
        ]);
      }

      // END
    }
}
