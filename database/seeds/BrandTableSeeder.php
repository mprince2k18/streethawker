<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //BEGIN
      for ($i= 0 ; $i < 10; $i++) {
        DB::table('brands')->insert([
            'brand_name' =>Str::random(10),
            'activation' => 1,
            'request' => 1,
            'requestby' => 1,
            'approvedby' => 1,
            'photo' => rand(10,100).'.jpg'
        ]);
      }
      //END
    }
}
