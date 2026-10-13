<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 250);
            $table->string('author', 200);
            $table->char('isbn', 13);
            $table->foreignUuid('category_id')->constrained('categories');
            $table->integer('total_copies');
            $table->integer('available_copies');
            $table->string('cover_key', 512)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            
            // Constraints (engine marks from spec)
            $table->unique(['isbn'], 'idx_books_isbn_unique_active')
                ->where('deleted_at IS NULL');
            
            // CHECK constraints (engine marks)
            $table->check('total_copies >= 1'); // Will be ck_book_total_positive
            $table->check('available_copies >= 0 AND available_copies <= total_copies'); // ck_book_available_range
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};