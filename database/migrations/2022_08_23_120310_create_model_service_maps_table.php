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
        Schema::create('model_service_maps', function (Blueprint $table) {
            $table->id();
            $table->string('model_id');
            $table->string('fuel_id');
            $table->string('service_id');
            $table->string('price');
            $table->string('discounted_price');
            $table->softDeletes();
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
        Schema::dropIfExists('model_service_maps');
    }
};
