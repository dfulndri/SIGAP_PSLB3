<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Level 1: Kategori (mis. Pengelolaan Sampah, Pengelolaan Limbah B3)
        Schema::create('master_kategori_pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();          // dipakai sistem, tidak berubah setelah dibuat
            $table->string('nama', 150);
            $table->string('ikon', 40)->default('bi-folder2-open'); // nama ikon Bootstrap Icons
            $table->string('warna', 7)->default('#273338');         // warna badge (hex)
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Level 2: Jenis Pengaduan (anak dari kategori)
        Schema::create('master_jenis_pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->constrained('master_kategori_pengaduan')
                ->cascadeOnDelete();
            $table->string('kode', 80)->unique();          // disimpan di pengaduan.jenis_aduan
            $table->string('nama', 200);
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_jenis_pengaduan');
        Schema::dropIfExists('master_kategori_pengaduan');
    }
};
