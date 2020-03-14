<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(1);
            $table->string('product_name')->default('No Name');
            $table->integer('quantity')->default(0);
            $table->integer('category')->default(1);
            $table->integer('sub_category')->default(1);
            $table->integer('brand')->default(0);
            $table->integer('product_price')->default(00);
            $table->longText('description')->default('No Description Given');
            $table->integer('point')->default(0);
            $table->integer('approval')->default(0);
            $table->integer('approvedby')->default(0);
            $table->integer('activation')->default(1);
            $table->string('photo')->default('default.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
