<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_field_of_practice', function (Blueprint $table) {
            $table->bigInteger('practice_id')->unsigned();
            $table->bigInteger('field_of_practice_id')->unsigned();
            $table->foreign('practice_id')->references('id')->on('practices');
            $table->foreign('field_of_practice_id')->references('id')->on('field_of_practice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practice_field_of_practice');
    }
};
