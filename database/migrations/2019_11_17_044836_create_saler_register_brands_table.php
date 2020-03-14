<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalerRegisterBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saler_register_brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('brand_id');
            $table->integer('saler_id')->default(0);
            $table->integer('approval_status')->default(0);
            $table->integer('aproved_by')->default(0);
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
        Schema::dropIfExists('saler_register_brands');
    }
}
