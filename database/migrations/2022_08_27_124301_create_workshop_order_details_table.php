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
        Schema::create('workshop_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('workshop_order_id')->nullable();
            $table->string('type')->nullable();
            $table->string('value')->nullable();
            $table->string('quantity')->default(1);
            $table->string('amount')->default(0);
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
        Schema::dropIfExists('workshop_order_details');
    }
};
