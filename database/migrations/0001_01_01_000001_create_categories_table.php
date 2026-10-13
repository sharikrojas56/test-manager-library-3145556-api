<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 120)->unique();
            $table->timestamps();
        });

        // Seed the five fixed categories (literal UUIDs from spec)
        DB::table('categories')->insert([
            [
                'id' => '11111111-1111-4111-8111-111111111111',
                'name' => 'Novel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '22222222-2222-4222-8222-222222222222', 
                'name' => 'Science',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '33333333-3333-4333-8333-333333333333',
                'name' => 'Technology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '44444444-4444-4444-8444-444444444444',
                'name' => 'History',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '55555555-5555-4555-8555-555555555555',
                'name' => "Children's",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};