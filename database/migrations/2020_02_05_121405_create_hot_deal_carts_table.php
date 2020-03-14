<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotDealCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hot_deal_carts', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('hotdeal_id');
          $table->ipAddress('customer_ip');
          $table->integer('product_quantity')->default(1);
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
        Schema::dropIfExists('hot_deal_carts');
    }
}
