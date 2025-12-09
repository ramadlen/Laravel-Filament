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
        Schema::create('suhus', function (Blueprint $table) {
            $table->id();
            $table->string('kelembapan');
            $table->float('suhu', 8, 2); 
            $table->dateTime('tanggal_dan_waktu_pencatatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suhus');
    }
};
