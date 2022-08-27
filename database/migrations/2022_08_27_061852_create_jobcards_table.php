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
        Schema::create('jobcards', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('regno')->nullable();
            $table->string('odometer_reading')->nullable();
            $table->string('manufacturing_year')->nullable();
            $table->string('gender')->nullable();
            $table->string('mechanic_name')->nullable();
            $table->string('arrival_mode')->nullable();
            $table->string('walkin_date')->nullable();
            $table->string('walkin_time')->nullable();
            $table->string('cust_name')->nullable();
            $table->string('cust_phone')->nullable();
            $table->string('cust_email')->nullable();
            $table->string('cust_address')->nullable();
            $table->string('fuel_level')->nullable();
            $table->string('floor_mat')->nullable();
            $table->string('wheel_cap')->nullable();
            $table->string('head_rest')->nullable();
            $table->string('mud_flap')->nullable();
            $table->string('battery_id')->nullable();
            $table->string('interior_inventory')->nullable();
            $table->string('document')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('jobcards');
    }
};
