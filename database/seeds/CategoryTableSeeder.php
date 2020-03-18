<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
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
        DB::table('categories')->insert([
            'category_name' => Str::random(10),
            'category_photo' => rand(10,100).'.jpg',
            'category_big_photo' => rand(10,100).'.jpg',
            'activation' => 1,
            'aditional_information'=>Str::words('Perfectly balanced, as all things should be.')
        ]);
      }

      // END
    }
}
