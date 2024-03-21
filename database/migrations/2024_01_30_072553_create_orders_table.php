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
            $table->double('total');
            $table->tinyInteger('status')->default(0);
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('waiter_id')->constrained('waiters')->onDelete('cascade')->onUpdate('cascade');
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
