<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('book_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->timestamp('reserved_at')->useCurrent();
            $table->timestamp('returned_at')->nullable();
            $table->string('status')->default('active'); 
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('book_user');
    }
};