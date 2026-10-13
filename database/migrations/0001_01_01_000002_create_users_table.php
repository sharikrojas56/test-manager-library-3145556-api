<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username', 120)->unique();
            $table->string('password_hash', 512);
            $table->string('role', 40); // 'admin' or 'librarian'
            $table->timestamps();
            
            // Domain-only constraint for now (T-18)
            // Will be moved to CHECK constraint: role IN ('admin', 'librarian')
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};