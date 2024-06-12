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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['billing', 'shipping']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('street_address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('postal_code')->nullable();
            $table->char('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
