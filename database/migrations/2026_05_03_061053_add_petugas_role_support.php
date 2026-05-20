<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Role 'petugas' sudah bisa disimpan di kolom role yang ada (varchar).
    // Migration ini hanya sebagai dokumentasi penambahan role baru.
    public function up(): void {}
    public function down(): void {}
};
