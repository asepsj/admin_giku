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
        Schema::create('klinik_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klinik_id');
            $table->text('photo_path');

            $table->foreign('klinik_id')->references('id')->on('kliniks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klinik_photos');
    }
};
