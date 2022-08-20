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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('order_id')->unique()->nullable();
            $table->string('slot')->nullable();
            $table->decimal('total_amount',10,2)->nullable();
            $table->string('order_status')->nullable();
            $table->string('assigned_workshop')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->default('pending');
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
        Schema::dropIfExists('orders');
    }
};
