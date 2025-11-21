<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kata', function (Blueprint $table) {
            $table->id();
            $table->string('id_kata')->unique();
            $table->string('id_sub')->nullable()->index();
            $table->enum('jenis_kata', ['utama', 'turunan']);
            $table->string('kategori_kata');
            $table->string('kata');
            $table->string('cara_baca')->nullable();
            $table->text('definisi')->nullable();
            $table->enum('status', ['Menunggu', 'Ditolak', 'Disetujui'])->default('Menunggu');
            $table->timestamps();
        });
        
        Schema::table('kata', function (Blueprint $table) {
            $table->foreign('id_sub')
                ->references('id_kata')
                ->on('kata')
                ->onDelete('set null');
        });
        
    }

    // public function down(): void
    // {
    //     Schema::dropIfExists('kata');
    // }
};
