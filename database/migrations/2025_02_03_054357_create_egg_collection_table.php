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
        Schema::create('egg_collection', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_deleted')->default(false);
            $table->string('ps_no');
            $table->string('house_no');
            $table->date('production_date');
            $table->time('collection_time');
            $table->int('collected_qty');
            $table->unsignedBigIntegers('encoded_by')->nullable();
            $table->unsignedBigIntegers('modified_by')->nullable();
            $table->timestamps();

            $table->foreign('encoded_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('modified_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_collection');
    }
};
