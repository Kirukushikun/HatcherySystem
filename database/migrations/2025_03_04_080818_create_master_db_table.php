<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_db', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_deleted')->default(false);
            $table->unsignedInteger('batch_no');
            $table->unsignedInteger('current_step');
            $table->enum('status', ['in_progress', 'completed'])->nullable();
            $table->json('process_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_db');
    }
};
