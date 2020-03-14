<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userId');
            $table->integer('order_id');
            $table->string('orderTrackingId')->default('no_id');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->string('userName');
            $table->string('companyName');
            $table->longText('address');
            $table->string('zip');
            $table->string('email');
            $table->string('phone');
            $table->longText('orderNote');
            $table->integer('paymentType');
            $table->integer('status')->default(0);
            $table->integer('actionStatus')->default(0);
            $table->integer('dis');
            $table->integer('ship');
            $table->integer('sub');
            $table->integer('tot');
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
        Schema::dropIfExists('billing_order_details');
    }
}
