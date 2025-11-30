<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 20)->unique();
            $table->string('customer_name', 100);
            $table->string('customer_phone', 20);
            $table->string('phone_type', 100);
            $table->text('complaint');
            $table->string('photo', 255)->nullable();
            $table->date('estimated_arrival_date')->nullable();
            $table->string('status', 50)->default('Menunggu Konfirmasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};