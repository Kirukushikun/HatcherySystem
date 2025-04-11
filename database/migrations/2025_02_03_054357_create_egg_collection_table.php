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
            $table->json('house_no');
            $table->date('production_date');
            $table->time('collection_time');
            $table->integer('collected_qty');
            $table->string('driver_name')->nullable();
            $table->unsignedBigInteger('encoded_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamps();

            $table->foreign('encoded_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
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
