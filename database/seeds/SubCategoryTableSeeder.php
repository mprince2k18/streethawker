<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i= 0 ; $i < 10; $i++) {
        DB::table('sub_categories')->insert([
            'sub_category_name' => Str::random(10),
            'categoryId' => $i++,
            'activation' => 1
        ]);
      }
    }
}
