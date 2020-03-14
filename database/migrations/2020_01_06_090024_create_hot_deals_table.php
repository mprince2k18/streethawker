<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hot_deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product');
            $table->integer('rate');
            $table->bigInteger('stock');
            $table->string('deadline');
            $table->string('deadlinetime');
            $table->string('newInfo');
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
        Schema::dropIfExists('hot_deals');
    }
}
