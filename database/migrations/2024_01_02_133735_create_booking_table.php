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
        Schema::create('booking', function (Blueprint $table) {
            $table->string('id_booking', 50)->primary();
            $table->string('id_customer');
            $table->string('id_order')->unique();
            $table->integer('user_id_mua');
            $table->string('name');
            $table->integer('makeup');
            $table->integer('type_makeup');
            $table->date('tanggal_booking')->nullable();
            $table->time('waktu_booking')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
