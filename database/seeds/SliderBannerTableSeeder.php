<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SliderBannerTableSeeder extends Seeder
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
        DB::table('slider_backgrounds')->insert([
            'slider_background' => rand(10,100).'.jpg',
            'activation' => 1
        ]);
      }
      //END
    }
}
