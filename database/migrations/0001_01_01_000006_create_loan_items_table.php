<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('loan_id')->constrained('loans')->onDelete('cascade');
            $table->foreignUuid('book_id')->constrained('books');
            $table->string('book_title', 250); // Frozen value
            $table->char('isbn', 13); // Frozen value
            $table->string('category_name', 120); // Frozen value (no FK on purpose - ADR-004)
            $table->timestamp('due_at');
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();
            
            // Constraints (engine marks)
            $table->unique(['loan_id', 'book_id']);
            
            // Indexes for access patterns
            $table->index(['book_id']); // Q3, Q7
            $table->index(['due_at'])->where('returned_at IS NULL'); // Q8 (overdue)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_items');
    }
};