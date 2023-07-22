<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cus_id')->unsigned()->index()->nullable();
            $table->foreign('cus_id')->references('id')->on('customers');
            $table->bigInteger('ship_id')->unsigned()->index()->nullable();
            $table->foreign('ship_id')->references('id')->on('shippers');
            $table->enum('status',['Processing','Shipped','Delivered'])
            ->default('Processing');
            $table->bigInteger('pm_id')->unsigned()->index()->nullable();
            $table->foreign('pm_id')->references('id')->on('payment_methods');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
