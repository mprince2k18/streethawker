<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userId');
            $table->string('fathersName');
            $table->string('mothersName');
            $table->string('NID');
            $table->timestamp('dateOfBirth');
            $table->string('nomenyName');
            $table->string('nomenyRelation');
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
        Schema::dropIfExists('vendor_infos');
    }
}
