<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userId');
            $table->string('address');
            $table->integer('zip');
            $table->string('phone');
            // $table->string('fathersName');
            // $table->string('mothersName');
            // $table->string('NID');
            // $table->date('dateOfBirth');
            // $table->string('nomenyName');
            // $table->string('nomenyRelation');
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
        Schema::dropIfExists('customer_infos');
    }
}
