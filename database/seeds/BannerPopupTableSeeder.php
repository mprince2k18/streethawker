<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BannerPopupTableSeeder extends Seeder
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
        DB::table('banner_popups')->insert([
            'banner_popup' => rand(10,100).'.jpg',
            'activation' => 1
        ]);
      }
      //END
    }
}
