<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('member_id')->constrained('members');
            $table->foreignUuid('loaned_by_user_id')->constrained('users');
            $table->timestamp('loaned_at');
            $table->timestamps();
            
            // Index for access pattern Q6 (loans by range, status, member)
            $table->index(['loaned_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};