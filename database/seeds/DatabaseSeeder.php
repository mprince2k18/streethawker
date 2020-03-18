<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(SubCategoryTableSeeder::class);
        // $this->call(SliderBannerTableSeeder::class);
        // $this->call(BrandBannerTableSeeder::class);
        // $this->call(BannerPopupTableSeeder::class);
        // $this->call(LogoTableSeeder::class);
    }
}
