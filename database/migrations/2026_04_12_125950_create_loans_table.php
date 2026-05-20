<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id');
    $table->foreignId('book_id');

    $table->date('borrow_date');
    $table->date('return_date')->nullable();

    $table->string('status')->default('menunggu'); 
    // menunggu, dipinjam, ditolak, selesai

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};