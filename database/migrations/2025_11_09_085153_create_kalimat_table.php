<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kalimat', function (Blueprint $table) {
            $table->id();
            $table->string('id_kalimat')->unique();
            $table->string('sub_id')->index();
            $table->text('kalimat');
            $table->text('arti_kalimat')->nullable();
            $table->enum('status', ['Menunggu', 'Ditolak', 'Disetujui'])
                  ->default('Menunggu');
            $table->timestamps();
        });

        Schema::table('kalimat', function (Blueprint $table) {
            $table->foreign('sub_id')
                  ->references('id_kata')
                  ->on('kata')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalimat');
    }
};
